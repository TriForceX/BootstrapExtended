<?php
require_once AME_ROOT_DIR . '/extras/exportable-module.php';

/** @noinspection PhpUnused Actually used in menu-editor-core.php */
class ameMetaBoxEditor extends ameModule implements ameExportableModule {
	const OPTION_NAME = 'ws_ame_meta_boxes';
	const FORCE_REFRESH_PARAM = 'ame-force-meta-box-refresh';

	protected $tabSlug = 'metaboxes';
	protected $tabTitle = 'Meta Boxes';

	/**
	 * @var ameMetaBoxSettings
	 */
	private $settings = null;

	private $shouldRefreshMetaBoxes = false;
	private $hiddenBoxCache = array();

	public function __construct($menuEditor) {
		parent::__construct($menuEditor);

		if ( !$this->isEnabledForRequest() ) {
			return;
		}

		add_action('add_meta_boxes', array($this, 'addDelayedMetaBoxHook'), 10, 1);
		add_filter('default_hidden_meta_boxes', array($this, 'filterDefaultHiddenBoxes'), 10, 2);
		//Gutenberg support.
		add_action('enqueue_block_editor_assets', array($this, 'enqueueGutenbergScripts'), 200);

		add_action('admin_menu_editor-header', array($this, 'handleFormSubmission'), 10, 2);

		//Clear caches when switching to another site or user.
		add_action('switch_blog', array($this, 'clearCache'), 10, 0);
		add_action('set_current_user', array($this, 'clearCache'), 10, 0);
		add_action('updated_user_meta', array($this, 'clearCache'), 10, 0);
		add_action('deleted_user_meta', array($this, 'clearCache'), 10, 0);
	}

	protected function isEnabledForRequest() {
		return !is_network_admin();
	}

	public function addDelayedMetaBoxHook($postType) {
		/*
		 * Some plugins add their meta boxes using the "admin_head" action (example: WPML) or other non-standard hooks.
		 * Unfortunately, this means we can't reliably catch all boxes by using "add_meta_boxes" or "do_meta_boxes".
		 * We use the "in_admin_header" action instead because it runs after the meta box related actions and after most
		 * other header hooks.
		 *
		 * However, this workaround is not fully reliable because there are parts of WP admin that output meta boxes
		 * immediately after registering them. Examples:
		 *   /wp-admin/edit-form-comment.php
		 *   /wp-admin/edit-link-form.php
		 *
		 * Partial solution: Let's use the "in_admin_header" hook only on "Edit $CPT" pages.
		 */
		$latePriority = 2000;

		//Is the current page a post editing screen?
		$currentScreen = get_current_screen();
		if ( !empty($currentScreen) ) {
			if (
				isset($currentScreen->base)
				&& ($currentScreen->base === 'post')
				&& !empty($postType)
				&& !did_action('in_admin_header')
			) {
				add_action('in_admin_header', array($this, 'processMetaBoxes'), $latePriority, 0);
				return;
			}
		}

		add_action('add_meta_boxes_' . $postType, array($this, 'processMetaBoxes'), $latePriority, 0);
	}

	public function processMetaBoxes() {
		global $wp_meta_boxes;

		$currentScreen = get_current_screen();
		if ( empty($currentScreen) ) {
			return;
		}

		$currentUser = wp_get_current_user();

		//Get the box settings for the current screen.
		$metaBoxes = $this->getScreenSettings($currentScreen->id);
		//Update existing boxes, add new boxes, flag stored boxes that no longer exist.
		$changesDetected = $metaBoxes->merge(ameUtils::get($wp_meta_boxes, $currentScreen->id, array()));

		//If anything has changed, save the updated box collection.
		if ( $changesDetected && $this->userCanEditMetaBoxes() ) {
			//Remove wrapped meta boxes where the file no longer exists.
			foreach ($metaBoxes->getMissingWrappedBoxes() as $missingBox) {
				$callbackFileName = $missingBox->getCallbackFileName();
				if ( !empty($callbackFileName) && !is_file($callbackFileName) ) {
					$metaBoxes->remove($missingBox->getId());
				}
			}

			//Also update the default list of hidden boxes.
			$metaBoxes->setHiddenByDefault($this->getUnmodifiedDefaultHiddenBoxes($currentScreen));

			$this->saveSettings();
		}

		//Remove hidden boxes.
		foreach ($metaBoxes->getPresentBoxes() as $box) {
			if ( !$box->isAvailableTo($currentUser, $this->menuEditor) ) {
				remove_meta_box($box->getId(), $currentScreen, $box->getContext());
			}
		}
	}

	/**
	 * @param string $screenId
	 * @return ameMetaBoxCollection
	 */
	protected function getScreenSettings($screenId) {
		$this->loadSettings();

		if ( isset($this->settings[$screenId]) ) {
			return $this->settings[$screenId];
		}

		$collection = new ameMetaBoxCollection($screenId);
		$this->settings[$screenId] = $collection;
		return $collection;
	}

	/**
	 * Change the default list of hidden meta boxes.
	 *
	 * @param array $hidden
	 * @param WP_Screen $screen
	 * @return array
	 */
	public function filterDefaultHiddenBoxes($hidden, $screen) {
		if ( empty($screen) || !($screen instanceof WP_Screen) ) {
			return $hidden;
		}
		if ( isset($this->hiddenBoxCache[$screen->id]) ) {
			return $this->hiddenBoxCache[$screen->id];
		}

		$metaBoxes = $this->getScreenSettings($screen->id);

		static $isUpdateDone = false;
		if ( !$isUpdateDone ) {
			$changesDetected = $metaBoxes->setHiddenByDefault($hidden);
			if ( $changesDetected ) {
				$this->saveSettings();
			}
			$isUpdateDone = true;
		}

		$user = wp_get_current_user();
		$visible = array();

		foreach ($metaBoxes->getPresentBoxes() as $box) {
			if ( $box->isVisibleByDefaultFor($user, $this->menuEditor) ) {
				$visible[] = $box->getId();
			} else {
				$hidden[] = $box->getId();
			}
		}

		$hidden = array_unique(array_diff($hidden, $visible));

		//Note: It might be a good idea to cache intermediate results (i.e. only custom hidden & visible settings)
		//instead of the final result. Consider that if there are plugin compatibility issues.
		$this->hiddenBoxCache[$screen->id] = $hidden;

		return $hidden;
	}

	private function getUnmodifiedDefaultHiddenBoxes(WP_Screen $screen) {
		//This is a slightly modified excerpt from the get_hidden_meta_boxes() core function in screen.php.
		$hidden = array();
		if ( 'post' == $screen->base ) {
			if ( in_array($screen->post_type, array('post', 'page', 'attachment')) ) {
				$hidden = array(
					'slugdiv',
					'trackbacksdiv',
					'postcustom',
					'postexcerpt',
					'commentstatusdiv',
					'commentsdiv',
					'authordiv',
					'revisionsdiv',
				);
			} else {
				$hidden = array('slugdiv');
			}
		}
		return apply_filters('default_hidden_meta_boxes', $hidden, $screen);
	}

	public function userCanEditMetaBoxes() {
		return $this->menuEditor->current_user_can_edit_menu();
	}

	private function saveSettings() {
		$json = $this->settings->toJSON();
		$this->setScopedOption(self::OPTION_NAME, $json);
	}

	private function loadSettings() {
		if ( isset($this->settings) ) {
			return $this->settings;
		}

		$json = $this->getScopedOption(self::OPTION_NAME, null);

		if ( empty($json) ) {
			$this->settings = new ameMetaBoxSettings();
		} else {
			$this->settings = ameMetaBoxSettings::fromJSON($json);
		}

		return $this->settings;
	}

	public function exportSettings() {
		$this->loadSettings();
		if ( $this->settings->isEmpty() ) {
			return null;
		}
		return $this->settings->toArray();
	}

	public function importSettings($newSettings) {
		if ( empty($newSettings) || !is_array($newSettings) ) {
			return;
		}

		$settings = ameMetaBoxSettings::fromArray($newSettings);
		$settings->setFirstRefreshState(true);
		$this->settings = $settings;
		$this->saveSettings();
	}

	public function getExportOptionLabel() {
		return 'Meta boxes';
	}

	public function getExportOptionDescription() {
		return '';
	}

	public function enqueueTabScripts() {
		parent::enqueueTabScripts();
		$this->loadSettings();

		//Automatically refresh the list of available meta boxes.
		$query = $this->menuEditor->get_query_params();
		$this->shouldRefreshMetaBoxes = empty($query['ame-meta-box-refresh-done'])
			&& (
				$this->settings->isEmpty()
				|| (!empty($query[self::FORCE_REFRESH_PARAM]) && check_admin_referer(self::FORCE_REFRESH_PARAM))
				|| (!$this->settings->isFirstRefreshDone())
			);

		if ( $this->shouldRefreshMetaBoxes ) {
			$pagesWithMetaBoxes = array();
			if ( get_option('link_manager_enabled') ) {
				$pagesWithMetaBoxes[] = 'link-add.php';
			}
			$postTypes = get_post_types(array('public' => true, 'show_ui' => true), 'objects', 'or');
			foreach ($postTypes as $postType) {
				$pagesWithMetaBoxes[] = 'post-new.php?post_type=' . $postType->name;
			}

			//Include Media/attachments. This post type doesn't have a standard "new post" screen,
			//so lets use the edit URL of the most recently uploaded image instead.
			$attachments = get_posts(array(
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'numberposts'    => 1,
				'post_status'    => null,
				'post_parent'    => 'any',
			));
			if ( $attachments && !empty($attachments) ) {
				$firstAttachment = reset($attachments);
				$pagesWithMetaBoxes[] = get_edit_post_link($firstAttachment->ID, 'raw');
			}

			wp_enqueue_auto_versioned_script(
				'ame-refresh-meta-boxes',
				plugins_url('refresh-meta-boxes.js', __FILE__),
				array('jquery')
			);

			wp_localize_script(
				'ame-refresh-meta-boxes',
				'wsMetaBoxRefresherData',
				array(
					'editorUrl'          => $this->getTabUrl(array('ame-meta-box-refresh-done' => 1)),
					'pagesWithMetaBoxes' => $pagesWithMetaBoxes,
				)
			);
			return;
		}

		wp_register_auto_versioned_script(
			'ame-meta-box-editor',
			plugins_url('metabox-editor.js', __FILE__),
			array(
				'ame-lodash',
				'knockout',
				'ame-actor-selector',
				'jquery',
				'ame-actor-manager',
			)
		);

		wp_localize_script(
			'ame-meta-box-editor',
			'wsAmeMetaBoxEditorData',
			array(
				'settings'   => $this->settings->toArray(),
				'refreshUrl' => wp_nonce_url(
					$this->getTabUrl(array(
						self::FORCE_REFRESH_PARAM => 1,
						'ame-mb-random'           => rand(1, 10000),
					)),
					self::FORCE_REFRESH_PARAM
				),
			)
		);

		wp_enqueue_script('ame-meta-box-editor');

		wp_enqueue_auto_versioned_style(
			'ame-meta-box-editor-style',
			plugins_url('metabox-editor.css', __FILE__)
		);
	}

	public function handleFormSubmission($action, $post = array()) {
		//For debugging.
		if ( $action === 'ame_reset_meta_box_settings' && defined('WP_DEBUG') ) {
			$this->settings = new ameMetaBoxSettings();
			$this->saveSettings();
			return;
		}

		//Note: We don't need to check user permissions here because plugin core already did.
		if ( $action === 'ame_save_meta_boxes' ) {
			check_admin_referer($action);

			//Save settings.
			$settings = ameMetaBoxSettings::fromJSON($post['settings']);
			$settings->setFirstRefreshState(true);
			$this->settings = $settings;
			$this->saveSettings();

			wp_redirect($this->getTabUrl(array('updated' => 1)));
			exit;
		}
	}

	public function displaySettingsPage() {
		if ( $this->shouldRefreshMetaBoxes ) {
			if ( !$this->settings->isFirstRefreshDone() ) {
				//Let's update the initial refresh flag before the refresh actually happens.
				//This helps prevent an infinite loop when the initial refresh fails.
				$this->settings->setFirstRefreshState(true);
				$this->saveSettings();
			}
			$this->outputTemplate('box-refresh');
		} else {
			parent::displaySettingsPage();
		}
	}

	public function clearCache() {
		$this->hiddenBoxCache = array();
		$this->settings = null;
	}

	/**
	 * Add a script that will remove Gutenberg document panels that correspond to hidden meta boxes.
	 */
	public function enqueueGutenbergScripts() {
		$currentScreen = get_current_screen();
		if ( empty($currentScreen) ) {
			return;
		}
		$currentUser = wp_get_current_user();

		$boxesToPanels = array(
			'slugdiv'          => 'post-link',
			'postexcerpt'      => 'post-excerpt',
			'postimagediv'     => 'featured-image',
			'commentstatusdiv' => 'discussion-panel',
			'categorydiv'      => 'taxonomy-panel-category',
			'pageparentdiv'    => 'page-attributes',
		);

		$panelsToRemove = array();
		$metaBoxes = $this->getScreenSettings($currentScreen->id);
		$presentBoxes = $metaBoxes->getPresentBoxes();
		foreach ($presentBoxes as $box) {
			if ( $box->isAvailableTo($currentUser, $this->menuEditor) ) {
				continue;
			}

			//What's the panel name for this box?
			$boxId = $box->getId();
			if ( isset($boxesToPanels[$boxId]) ) {
				$panelsToRemove[] = $boxesToPanels[$boxId];
			} else if ( preg_match('/^tagsdiv-(?P<taxonomy>.++)$/', $boxId, $matches) ) {
				$panelsToRemove[] = 'taxonomy-panel-' . $matches['taxonomy'];
			}
			//We deliberately skip non-core boxes. For now, the remove_meta_box() call
			//in processMetaBoxes() seems to remove them effectively.
		}

		if ( empty($panelsToRemove) ) {
			return;
		}

		wp_enqueue_auto_versioned_script(
			'ame-hide-gutenberg-panels',
			plugins_url('hide-gutenberg-panels.js', __FILE__),
			array('wp-data', 'wp-blocks', 'wp-edit-post')
		);

		wp_localize_script(
			'ame-hide-gutenberg-panels',
			'wsAmeGutenbergPanelData',
			array(
				'panelsToRemove' => $panelsToRemove
			)
		);
	}
}
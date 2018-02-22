<?php

class ameMetaBoxEditor extends ameModule {
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
		add_action('add_meta_boxes_' . $postType, array($this, 'processMetaBoxes'), 2000, 0);
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

			//$this->dashboardWidgets->siteComponentHash = $this->generateCompontentHash();
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
		//Save per site or site-wide based on plugin configuration.
		$json = $this->settings->toJSON();
		if ( $this->menuEditor->get_plugin_option('menu_config_scope') === 'site' ) {
			update_option(self::OPTION_NAME, $json);
		} else {
			WPMenuEditor::atomic_update_site_option(self::OPTION_NAME, $json);
		}
	}

	private function loadSettings() {
		if ( isset($this->settings) ) {
			return $this->settings;
		}

		$scope = $this->menuEditor->get_plugin_option('menu_config_scope');
		$json = null;

		if ( $scope === 'site' ) {
			$json = get_option(self::OPTION_NAME, null);
		} else {
			$json = get_site_option(self::OPTION_NAME, null);
		}

		if ( empty($json) ) {
			$this->settings = new ameMetaBoxSettings();
		} else {
			$this->settings = ameMetaBoxSettings::fromJSON($json);
		}

		return $this->settings;
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
			$this->settings = $settings;
			$this->saveSettings();

			wp_redirect($this->getTabUrl(array('updated' => 1)));
			exit;
		}
	}

	public function displaySettingsPage() {
		if ( $this->shouldRefreshMetaBoxes ) {
			$this->outputTemplate('box-refresh');
		} else {
			parent::displaySettingsPage();
		}
	}

	public function clearCache() {
		$this->hiddenBoxCache = array();
		$this->settings = null;
	}

}
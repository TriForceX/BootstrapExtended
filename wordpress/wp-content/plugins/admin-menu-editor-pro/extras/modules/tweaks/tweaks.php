<?php

/*
 * Idea: Show tweaks as options in menu properties, e.g. in a "Tweaks" section styled like the collapsible
 * property sheets in Delphi.
 */

require_once __DIR__ . '/ameBaseTweak.php';
require_once __DIR__ . '/ameHideSelectorTweak.php';
require_once __DIR__ . '/ameHideSidebarTweak.php';
require_once __DIR__ . '/ameHideSidebarWidgetTweak.php';
require_once __DIR__ . '/ameDelegatedTweak.php';
require_once __DIR__ . '/ameTinyMceButtonManager.php';

/** @noinspection PhpUnused The class is actually used in extras.php */

class ameTweakManager extends amePersistentModule {
	const APPLY_TWEAK_AUTO = 'auto';
	const APPLY_TWEAK_MANUALLY = 'manual';

	protected $tabSlug = 'tweaks';
	protected $tabTitle = 'Tweaks';
	protected $optionName = 'ws_ame_tweak_settings';

	protected $settingsFormAction = 'ame-save-tweak-settings';

	/**
	 * @var ameBaseTweak[]
	 */
	private $tweaks = array();

	/**
	 * @var ameBaseTweak[]
	 */
	private $pendingTweaks = array();

	/**
	 * @var ameBaseTweak[]
	 */
	private $postponedTweaks = array();

	/**
	 * @var ameTweakSection[]
	 */
	private $sections = array();

	private $editorButtonManager;

	public function __construct($menuEditor) {
		parent::__construct($menuEditor);

		add_action('init', array($this, 'onInit'), PHP_INT_MAX - 1000);

		//We need to process widgets after they've been registered (usually priority 10)
		//but before WordPress has populated the $wp_registered_widgets global (priority 95 or 100).
		add_action('widgets_init', array($this, 'processSidebarWidgets'), 50);
		//Sidebars are simpler: we can just use a really late priority.
		add_action('widgets_init', array($this, 'processSidebars'), 1000);

		$this->editorButtonManager = new ameTinyMceButtonManager();
	}

	public function onInit() {
		$this->addSection('general', 'General');
		$this->registerTweaks();

		$tweaksToProcess = $this->pendingTweaks;
		$this->pendingTweaks = array();
		$this->processTweaks($tweaksToProcess);
	}

	private function registerTweaks() {
		$tweakData = require(__DIR__ . '/default-tweaks.php');

		foreach (ameUtils::get($tweakData, 'sections', array()) as $id => $section) {
			$this->addSection($id, ameUtils::get($section, 'label', $id), ameUtils::get($section, 'priority', 10));
		}

		foreach (ameUtils::get($tweakData, 'tweaks', array()) as $id => $properties) {
			if ( isset($properties['selector']) ) {
				$tweak = new ameHideSelectorTweak(
					$id,
					isset($properties['label']) ? $properties['label'] : null,
					$properties['selector']
				);

				if ( isset($properties['parent']) ) {
					$tweak->setParentId($properties['parent']);
				}
				if ( isset($properties['section']) ) {
					$tweak->setSectionId($properties['section']);
				}
				if ( isset($properties['screens']) ) {
					$tweak->setScreens($properties['screens']);
				}

				$this->addTweak($tweak);
			} else {
				throw new LogicException('Unknown tweak type in default-tweaks.php for tweak "' . $id . '"');
			}
		}

		do_action('admin-menu-editor-register_tweaks', $this);
	}

	/**
	 * @param ameBaseTweak $tweak
	 * @param string $applicationMode
	 */
	public function addTweak($tweak, $applicationMode = self::APPLY_TWEAK_AUTO) {
		$this->tweaks[$tweak->getId()] = $tweak;
		if ( $applicationMode === self::APPLY_TWEAK_AUTO ) {
			$this->pendingTweaks[$tweak->getId()] = $tweak;
		}
	}

	/**
	 * @param ameBaseTweak[] $tweaks
	 */
	protected function processTweaks($tweaks) {
		$settings = ameUtils::get($this->loadSettings(), 'tweaks');

		$currentUser = wp_get_current_user();
		$roles = $this->menuEditor->get_user_roles($currentUser);
		$isSuperAdmin = is_multisite() && is_super_admin($currentUser->ID);

		foreach ($tweaks as $tweak) {
			if ( empty($settings[$tweak->getId()]) ) {
				continue; //This tweak is not enabled for anyone.
			}

			$enabledForActor = ameUtils::get($settings, array($tweak->getId(), 'enabledForActor'), array());
			if ( !$this->appliesToUser($enabledForActor, $currentUser, $roles, $isSuperAdmin) ) {
				continue;
			}

			if ( $tweak->hasScreenFilter() ) {
				if ( !did_action('current_screen') ) {
					$this->postponedTweaks[$tweak->getId()] = $tweak;
					continue;
				} else if ( !$tweak->isEnabledForCurrentScreen() ) {
					continue;
				}
			}

			$tweak->apply();
		}

		if ( !empty($this->postponedTweaks) ) {
			add_action('current_screen', array($this, 'processPostponedTweaks'), 10, 1);
		}
	}

	/**
	 * @param array $enabledForActor
	 * @param WP_User $user
	 * @param array $roles
	 * @param bool $isSuperAdmin
	 * @return bool
	 */
	private function appliesToUser($enabledForActor, $user, $roles, $isSuperAdmin = false) {
		//User-specific settings have priority over everything else.
		$userActor = 'user:' . $user->user_login;
		if ( isset($enabledForActor[$userActor]) ) {
			return $enabledForActor[$userActor];
		}

		//The "Super Admin" flag has priority over regular roles.
		if ( $isSuperAdmin && isset($enabledForActor['special:super_admin']) ) {
			return $enabledForActor['special:super_admin'];
		}

		//If it's enabled for any role, it's enabled for the user.
		foreach ($roles as $role) {
			if ( !empty($enabledForActor['role:' . $role]) ) {
				return true;
			}
		}

		//By default, all tweaks are disabled.
		return false;
	}

	/**
	 * @param WP_Screen $screen
	 */
	public function processPostponedTweaks($screen = null) {
		if ( empty($screen) && function_exists('get_current_screen') ) {
			$screen = get_current_screen();
		}
		$screenId = isset($screen, $screen->id) ? $screen->id : null;

		foreach ($this->postponedTweaks as $id => $tweak) {
			if ( !$tweak->isEnabledForScreen($screenId) ) {
				continue;
			}
			$tweak->apply();
		}

		$this->postponedTweaks = array();
	}

	public function processSidebarWidgets() {
		global $wp_widget_factory;
		global $pagenow;
		if ( !isset($wp_widget_factory, $wp_widget_factory->widgets) || !is_array($wp_widget_factory->widgets) ) {
			return;
		}

		$widgetTweaks = array();
		foreach ($wp_widget_factory->widgets as $id => $widget) {
			$tweak = new ameHideSidebarWidgetTweak($widget);
			$widgetTweaks[$tweak->getId()] = $tweak;
		}

		//Sort the tweaks in alphabetic order.
		uasort(
			$widgetTweaks,
			/**
			 * @param ameBaseTweak $a
			 * @param ameBaseTweak $b
			 * @return int
			 */
			function ($a, $b) {
				return strnatcasecmp($a->getLabel(), $b->getLabel());
			}
		);

		foreach ($widgetTweaks as $tweak) {
			$this->addTweak($tweak, self::APPLY_TWEAK_MANUALLY);
		}

		if ( is_admin() && ($pagenow === 'widgets.php') ) {
			$this->processTweaks($widgetTweaks);
		}
	}

	public function processSidebars() {
		global $wp_registered_sidebars;
		global $pagenow;
		if ( !isset($wp_registered_sidebars) || !is_array($wp_registered_sidebars) ) {
			return;
		}

		$sidebarTweaks = array();
		foreach ($wp_registered_sidebars as $id => $sidebar) {
			$tweak = new ameHideSidebarTweak($sidebar);
			$this->addTweak($tweak, self::APPLY_TWEAK_MANUALLY);
			$sidebarTweaks[$tweak->getId()] = $tweak;
		}

		if ( is_admin() && ($pagenow === 'widgets.php') ) {
			$this->processTweaks($sidebarTweaks);
		}
	}

	public function addSection($id, $label, $priority = null) {
		$section = new ameTweakSection($id, $label);
		if ( $priority !== null ) {
			$section->setPriority($priority);
		}
		$this->sections[$section->getId()] = $section;
	}

	protected function getTemplateVariables($templateName) {
		$variables = parent::getTemplateVariables($templateName);
		$variables['tweaks'] = $this->tweaks;
		return $variables;
	}

	public function enqueueTabScripts() {
		wp_register_auto_versioned_script(
			'ame-tweak-manager',
			plugins_url('tweak-manager.js', __FILE__),
			array(
				'ame-lodash',
				'knockout',
				'ame-actor-selector',
				'jquery-json',
				'jquery-cookie',
			)
		);
		wp_enqueue_script('ame-tweak-manager');

		//Reselect the same actor.
		$query = $this->menuEditor->get_query_params();
		$selectedActor = null;
		if ( isset($query['selected_actor']) ) {
			$selectedActor = strval($query['selected_actor']);
		}

		$scriptData = $this->getScriptData();
		$scriptData['selectedActor'] = $selectedActor;
		wp_localize_script('ame-tweak-manager', 'wsTweakManagerData', $scriptData);
	}

	protected function getScriptData() {
		$settings = ameUtils::get($this->loadSettings(), 'tweaks', array());

		$tweakData = array();
		foreach ($this->tweaks as $id => $tweak) {
			$item = array(
				'id'        => $id,
				'label'     => $tweak->getLabel(),
				'parentId'  => $tweak->getParentId(),
				'sectionId' => $tweak->getSectionId(),
			);
			$item = array_merge(ameUtils::get($settings, $id, array()), $item);
			$tweakData[] = $item;
		}

		$sectionData = array();
		foreach ($this->sections as $section) {
			$sectionData[] = array(
				'id'       => $section->getId(),
				'label'    => $section->getLabel(),
				'priority' => $section->getPriority(),
			);
		}

		return array(
			'tweaks'       => $tweakData,
			'sections'     => $sectionData,
			'isProVersion' => $this->menuEditor->is_pro_version(),
		);
	}

	public function enqueueTabStyles() {
		parent::enqueueTabStyles();
		wp_enqueue_auto_versioned_style(
			'ame-tweak-manager-css',
			plugins_url('tweaks.css', __FILE__)
		);
	}

	public function handleSettingsForm($post = array()) {
		parent::handleSettingsForm($post);

		/** @noinspection PhpComposerExtensionStubsInspection */
		$submittedSettings = json_decode($post['settings'], true);

		//To save space, filter out tweaks that are not enabled for anyone and have no other settings.
		//Most tweaks only have "id" and "enabledForActor" properties.
		$basicProperties = array('id' => true, 'enabledForActor' => true);
		$submittedSettings['tweaks'] = array_filter(
			$submittedSettings['tweaks'],
			function ($settings) use ($basicProperties) {
				if ( !empty($settings['enabledForActor']) ) {
					return true;
				}
				$additionalProperties = array_diff_key($settings, $basicProperties);
				return !empty($additionalProperties);
			}
		);

		$this->settings['tweaks'] = $submittedSettings['tweaks'];
		$this->saveSettings();

		$params = array('updated' => 1);
		if ( !empty($post['selected_actor']) ) {
			$params['selected_actor'] = strval($post['selected_actor']);
		}

		wp_redirect($this->getTabUrl($params));
		exit;
	}
}

class ameTweakSection {
	private $id;
	private $label;

	private $priority = 0;

	public function __construct($id, $label) {
		$this->id = $id;
		$this->label = $label;
	}

	public function getId() {
		return $this->id;
	}

	public function getLabel() {
		return $this->label;
	}

	public function getPriority() {
		return $this->priority;
	}

	public function setPriority($priority) {
		$this->priority = $priority;
		return $this;
	}
}

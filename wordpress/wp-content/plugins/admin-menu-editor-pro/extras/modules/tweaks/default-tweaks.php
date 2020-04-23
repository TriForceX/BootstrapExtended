<?php
return array(
	'sections' => array(
		'profile'         => array('label' => 'Hide Profile Fields', 'priority' => 80),
		'sidebar-widgets' => array('label' => 'Hide Sidebar Widgets', 'priority' => 100),
		'sidebars'        => array('label' => 'Hide Sidebars', 'priority' => 120),
	),

	'tweaks' => array(
		'hide-screen-meta-links' => array(
			'label'    => 'Hide screen meta links',
			'selector' => '#screen-meta-links',
		),
		'hide-screen-options'    => array(
			'label'    => 'Hide the "Screen Options" button',
			'selector' => '#screen-options-link-wrap',
			'parent'   => 'hide-screen-meta-links',
		),
		'hide-help-panel'        => array(
			'label'    => 'Hide the "Help" button',
			'selector' => '#contextual-help-link-wrap',
			'parent'   => 'hide-screen-meta-links',
		),
		'hide-all-admin-notices' => array(
			'label'    => 'Hide ALL admin notices',
			'selector' => '.wrap .notice, .wrap .updated',
		),

		'hide-profile-visual-editor'         => array(
			'label'    => 'Visual Editor',
			'selector' => 'tr.user-rich-editing-wrap',
			'section'  => 'profile',
			'screens'  => array('profile'),
		),
		'hide-profile-syntax-higlighting'    => array(
			'label'    => 'Syntax Highlighting',
			'selector' => 'tr.user-syntax-highlighting-wrap',
			'section'  => 'profile',
			'screens'  => array('profile'),
		),
		'hide-profile-color-scheme-selector' => array(
			'label'    => 'Admin Color Scheme',
			'selector' => 'tr.user-admin-color-wrap',
			'section'  => 'profile',
			'screens'  => array('profile'),
		),
		'hide-profile-toolbar-toggle'        => array(
			'label'    => 'Toolbar',
			'selector' => 'tr.show-admin-bar.user-admin-bar-front-wrap',
			'section'  => 'profile',
			'screens'  => array('profile'),
		),
	),
);
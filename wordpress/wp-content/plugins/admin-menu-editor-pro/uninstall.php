<?php

/**
 * @author W-Shadow 
 * @copyright 2012
 *
 * The uninstallation script.
 */

if( defined( 'ABSPATH') && defined('WP_UNINSTALL_PLUGIN') ) {

	//Remove the plugin's settings
	delete_option('ws_menu_editor_pro');
	if ( function_exists('delete_site_option') ){
		delete_site_option('ws_menu_editor_pro');

		//Remove the "automatic license activation failed" flag. Most sites won't have this.
		delete_site_option('wslm_auto_activation_failed-admin-menu-editor-pro');
	}
	//Remove update metadata
	delete_option('ame_pro_external_updates');

    //Remove hint visibility flags
    if ( function_exists('delete_metadata') ) {
        delete_metadata('user', 0, 'ame_show_hints', '', true);
    }

    //Remove meta box settings.
	delete_option('ws_ame_meta_boxes');
	if ( function_exists('delete_site_option') ) {
		delete_site_option('ws_ame_meta_boxes');
	}

	//Call the uninstaller for the "highlight new menus" module.
	$highlighterUninstaller = dirname(__FILE__) . '/modules/highlight-new-menus/uninstall.php';
	if ( file_exists($highlighterUninstaller) ) {
		include (dirname(__FILE__) . '/modules/highlight-new-menus/uninstall.php');
	}

	//Remove license data (if any).
	if ( file_exists(dirname(__FILE__) . '/extras.php') ) {
		require_once dirname(__FILE__) . '/extras.php';
		if ( isset($ameProLicenseManager) ) {
			$ameProLicenseManager->unlicenseThisSite();
		}
	}
}
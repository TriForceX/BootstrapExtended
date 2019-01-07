<?php
/*
Plugin Name: WP Migrate DB Pro
Plugin URI: https://deliciousbrains.com/wp-migrate-db-pro/
Description: Export, push, and pull to migrate your WordPress databases.
Author: Delicious Brains
Version: 1.8.4
Author URI: https://deliciousbrains.com
Network: True
Text Domain: wp-migrate-db
Domain Path: /languages/
*/

// Copyright (c) 2013 Delicious Brains. All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************

//Manual update
define('WPMDB_LICENCE', 1);

set_site_transient('wpmdb_dbrains_api_down', __('<strong>Manually updated</strong>. Take a look on the main plugin file if you want disable or use a real license.', 'websitebase'), 0);
set_site_transient('wpmdb_upgrade_data', __('<strong>Manually updated</strong>. Take a look on the main plugin file if you want disable or use a real license.', 'websitebase'), 0);

if(get_option('template')=='websitebase')
{ 
	add_action('admin_footer', function(){ ?>
	<script type="text/javascript">
	jQuery(function($){
		if($('#wpmdb-main #migrate-form').length > 0)
		{
			var wpmigrateForm 		= $('#wpmdb-main #migrate-form');
			var wpmigrateOldUrl 	= wpmigrateForm.find('.step-two #find-and-replace-sort #old-url');
			var wpmigrateNewUrl 	= wpmigrateForm.find('.step-two #find-and-replace-sort #new-url');
			var wpmigrateNewPath 	= wpmigrateForm.find('.step-two #find-and-replace-sort #new-path');
			var wpmigrateContent	= wpmigrateForm.find('.step-two');
			var wpmigrateAlert 		= '<?php _e('Due to you are using <strong>Website Base</strong> theme, remember to prepend <strong>http</strong> or <strong>https</strong> to your <i>Local & Production</i> URL', 'websitebase'); ?>';

			wpmigrateContent.prepend('<div class="notification-message warning-notice inline-message">'+wpmigrateAlert+'</div>');
			wpmigrateNewPath.attr('placeholder', 'New file path or URL');

			if(!(wpmigrateOldUrl.val().indexOf(window.location.protocol) >= 0))
			{
				wpmigrateOldUrl.val(window.location.protocol+wpmigrateOldUrl.val());
			}

			wpmigrateNewUrl.blur(function(e){
				if(!(wpmigrateNewUrl.val().indexOf('http://') >= 0 || wpmigrateNewUrl.val().indexOf('https://') >= 0))
				{
					wpmigrateNewUrl.val(window.location.protocol+'//'+wpmigrateNewUrl.val());
				}
			});
		}
	});
	</script>
	<? });
}

$GLOBALS['wpmdb_meta']['wp-migrate-db-pro']['version'] = '1.8.4';
$GLOBALS['wpmdb_meta']['wp-migrate-db-pro']['folder']  = basename( plugin_dir_path( __FILE__ ) );
$GLOBALS['wpmdb_meta']['wp-migrate-db-pro']['abspath'] = dirname( __FILE__ );

if ( version_compare( phpversion(), '5.4', '>' ) ) {
	require_once __DIR__ . '/class/autoload.php';
}

if ( ! class_exists( 'WPMDB_Utils' ) ) {
	require dirname( __FILE__ ) . '/class/wpmdb-utils.php';
}

/**
 * once all plugins are loaded, load up the rest of this plugin
 *
 * @return boolean
 */
function wp_migrate_db_pro_loaded() {

	// load if it is wp-cli, so that version update will show in wp-cli
	if ( defined( 'WP_CLI' ) && WP_CLI ) {
		wp_migrate_db_pro();

		return true;
	}

	// exit quickly unless: standalone admin; one of our AJAX calls
	if ( ! is_admin() || ( is_multisite() && ! current_user_can( 'manage_network_options' ) && ! WPMDB_Utils::is_ajax() ) ) {
		return false;
	}

	wp_migrate_db_pro();

	return true;
}

add_action( 'plugins_loaded', 'wp_migrate_db_pro_loaded' );

/**
 * Populate the $wpmdbpro global with an instance of the WPMDBPro class and return it.
 *
 * @return WPMDBPro The one true global instance of the WPMDBPro class.
 */
function wp_migrate_db_pro() {
	global $wpmdbpro;

	if ( ! is_null( $wpmdbpro ) ) {
		return $wpmdbpro;
	}

	$abspath = dirname( __FILE__ );

	require_once $abspath . '/class/wpmdb-base.php';
	require_once $abspath . '/class/wpmdbpro-addon.php';
	require_once $abspath . '/class/wpmdb.php';
	require_once $abspath . '/class/wpmdb-replace.php';
	require_once $abspath . '/class/wpmdbpro-import.php';
	require_once $abspath . '/class/wpmdbpro.php';
	require_once $abspath . '/class/wpmdb-sanitize.php';
	require_once $abspath . '/class/wpmdb-migration-state.php';
	require_once $abspath . '/class/wpmdb-filesystem.php';
	require_once $abspath . '/class/wpmdb-compatibility-plugin-manager.php';
	require_once $abspath . '/class/wpmdb-beta-manager.php';

	$wpmdbpro = new WPMDBPro( __FILE__ );

	// Remove the compatibility plugin when the plugin is deactivated
	register_deactivation_hook( __FILE__, 'wpmdb_pro_remove_mu_plugin' );

	return $wpmdbpro;
}

function wpmdb_pro_cli_loaded() {
	// register with wp-cli if it's running, and command hasn't already been defined elsewhere
	if ( defined( 'WP_CLI' ) && WP_CLI && ! class_exists( 'WPMDB_Command' ) ) {
		require_once dirname( __FILE__ ) . '/class/wpmdbpro-command.php';
	}
}

add_action( 'plugins_loaded', 'wpmdb_pro_cli_loaded', 20 );

function wpmdb_pro_cli() {
	global $wpmdbpro_cli;

	if ( ! is_null( $wpmdbpro_cli ) ) {
		return $wpmdbpro_cli;
	}

	if ( function_exists( 'wp_migrate_db_pro' ) ) {
		wp_migrate_db_pro();
	} else {
		return false;
	}
	do_action( 'wp_migrate_db_pro_cli_before_load' );

	require_once dirname( __FILE__ ) . '/class/wpmdbpro-cli-export.php';
	$wpmdbpro_cli = new WPMDBPro_CLI_Export( __FILE__ );

	do_action( 'wp_migrate_db_pro_cli_after_load' );

	return $wpmdbpro_cli;
}

add_action( 'activated_plugin', array( 'WPMDB_Utils', 'deactivate_other_instances' ) );

function wpmdb_pro_remove_mu_plugin() {
	do_action( 'wp_migrate_db_remove_compatibility_plugin' );
}

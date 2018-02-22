<?php
/**
 * Reset all plugin configuration (as opposed to resetting just the custom menu).
 */

delete_site_option('ws_menu_editor_pro');
delete_option('ws_menu_editor_pro');

delete_site_option('ws_menu_editor');
delete_option('ws_menu_editor');

delete_site_option('ws_ame_plugin_visibility');
delete_option('ws_ame_plugin_visibility');
delete_site_option('ws_ame_hide_pv_notice');
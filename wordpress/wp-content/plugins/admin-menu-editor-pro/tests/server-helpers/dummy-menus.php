<?php
/**
 * This test helper creates a bunch of admin menus in different locations.
 * Useful for testing the editor's ability to move/copy/add plugin menus.
 */

add_action('admin_menu', function() {
	add_options_page(
		'Dummy Settings',
		'Dummy Settings',
		'read',
		'dummy-settings',
		'amt_output_page'
	);

	add_comments_page(
		'Dummy Comments',
		'Dummy Comments',
		'read',
		'dummy-comments',
		'amt_output_page'
	);

	add_menu_page(
		'Dummy Top Menu',
		'Dummy Top Menu',
		'read',
		'dummy-top-menu',
		'amt_output_page'
	);

	add_submenu_page(
		'dummy-top-menu',
		'Dummy Submenu #1',
		'Dummy Submenu #1',
		'read',
		'dummy-submenu-1',
		'amt_output_page'
	);

	add_submenu_page(
		'dummy-top-menu',
		'Dummy Submenu #2',
		'Dummy Submenu #2',
		'read',
		'dummy-submenu-2',
		'amt_output_page'
	);

	//A menu with hard-coded role requirements.
	add_submenu_page(
		'dummy-top-menu',
		'Administrator Required',
		'Administrator Required',
		'administrator',
		'dummy-submenu-3-a',
		'amt_output_page'
	);

	add_dashboard_page(
		'Dummy Dashboard',
		'Dummy Dashboard',
		'read',
		'dummy-dashboard-page',
		'amt_output_page'
	);

	//A top-level menu with no submenus.
	add_menu_page(
		'The Dummy',
		'The Dummy',
		'read',
		'dummy-menu-with-no-items',
		'amt_output_page'
	);

	//A top-level menu with no hook callback!
	add_menu_page(
		'No Hook',
		'No Hook',
		'read',
		'dummy-menu-with-no-hook',
		null,
		'dashicons-dismiss'
	);

	add_submenu_page(
		'dummy-menu-with-no-hook',
		'NH Submenu #1',
		'NH Submenu #1',
		'read',
		'dummy-nh-submenu-1',
		function() {
			amt_output_page('nh-submenu-1-content');
		}
	);

	add_submenu_page(
		'dummy-menu-with-no-hook',
		'NH Submenu #2',
		'NH Submenu #2',
		'read',
		'dummy-nh-submenu-2',
		'amt_output_page'
	);

	//A submenu with special character(s) in the slug. Tests query parameter encoding.
	add_options_page(
		'Special Slug',
		'Special Slug',
		'read',
		'dummy/special-characters-in-slug.php',
		'amt_output_page'
	);

	//Add a page to a parent menu that includes a query parameter (edit.php?post_type=page)
	add_pages_page(
		'Pages Submenu',
		'Pages Submenu',
		'read',
		'dummy-pages-submenu',
		'amt_output_page'
	);

	//A top level menu with no slug! Surprisingly, it works as long as it has at least one submenu.
	add_menu_page(
		'No Slug',
		'No Slug',
		'read',
		'',
		'amt_output_page',
		'dashicons-dismiss',
		50
	);

	add_submenu_page(
		'',
		'Submenu With Slug',
		'Submenu With Slug',
		'read',
		'parent-has-no-slug',
		'amt_output_page'
	);
});

function amt_output_page($content_id = 'ame-test-page-content') {
	printf(
		'<span id="%s">This is a dummy page.</span>',
		htmlentities($content_id)
	);
}
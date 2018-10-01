=== Anything Order by Terms ===
Contributors: briar
Donate link: http://briar.guru/donate/
Tags: admin, custom, drag and drop, menu_order, order, page, post, rearrange, reorder, sort, taxonomy, term_order
Requires at least: 4.7
Tested up to: 4.9.8
Stable tag: 1.3.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to arrange any post types and terms with drag and drop. Save post order for each term.


== Description ==

This plugin allows you to arrange any post types and terms with simple drag and drop within the builtin list table on administration screen. Save post order for each term.

= Features =
* Support for any post types and taxonomies.
* Multiple selection is available.
* Capabilities aware. 'edit_others_posts' for post. 'manage_terms' for taxonomy.
* No additional column in builtin tables.
* No additional table in database.
* Save post order for each term.
* Woocommerce and Polylang compability.

== Installation ==

1. Upload 'anything-order-by-terms' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= I don't want some post types to be sortable. =
Uncheck the "Order" option in "Show on screen" section on [Screen Options](http://codex.wordpress.org/Administration_Screens#Screen_Options) tab to disable sorting.

= I don't want terms or post to be sortable. =
Use [filter](https://developer.wordpress.org/reference/functions/add_filter/). Place in you theme's function.php file `add_filter('Anything_Order/do_order/Post', '__return_false');` or `add_filter('Anything_Order/do_order/Taxonomy', '__return_false');`.

= How do I reset the order? =
Select the "Reset Order" option in [bulk actions](https://codex.wordpress.org/Posts_Screen#Actions) select and click "Apply".

= How do I select multiple items? =
Ctrl(or Command on OS X)+Click toggle selection state of current item. Shift+Click select items between first selected item on the list and current item.


== Screenshots ==

1. Enable/Disable arrangement with drag and drop on "Screen Options" tab. Reset bulk action.
2. Dragging items. Also support custom post type like Woocommerce product.
3. You can select multiple items by Ctrl(or Command on OS X)+Click.


== Changelog ==

= 1.3.2 - 2018-10-01 =
* Fixed - Update author site link.

= 1.3.1 - 2018-27-09 =
* Fixed - Bulk actions did not work in post view.

= 1.3.1 - 2018-27-09 =
* Fixed - Bulk actions did not work in post view.

= 1.3.0 - 2018-18-04 =
* Changed - Wordpress 4.9.5 and Woocommerce 3.3.5 compability.
* Changed - Disable Woocommerce term ordering in favour plugin methods.
* Changed - Reset order init by bulk action select instead screen options link.
* Fixed - Save ordering post by term when use filter select in admin area.


== Upgrade Notice ==

The current version of Anything Order requires WordPress 4.7 or higher. If you use older version of WordPress, you need to upgrade WordPress first.
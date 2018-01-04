=== Anything Order by Terms ===
Contributors: briar
Donate link: http://briar.site/donate/
Tags: admin, custom, drag and drop, menu_order, order, page, post, rearrange, reorder, sort, taxonomy, term_order
Requires at least: 4.4
Tested up to: 4.8.1
Stable tag: 1.2.2
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
Click the "Reset" link next to "Order" option on [Screen Options](http://codex.wordpress.org/Administration_Screens#Screen_Options) tab.

= How do I select multiple items? =
Ctrl(or Command on OS X)+Click toggle selection state of current item. Shift+Click select items between first selected item on the list and current item.


== Screenshots ==

1. Enable/Disable arrangement with drag and drop on "Screen Options" tab.
2. Dragging items. Also support custom post type like Woocommerce product.
3. You can select multiple items by Ctrl(or Command on OS X)+Click.


== Changelog ==

= 1.2.2 =
* Enhancement - Woocommerce 3.1 compability.
* Bugfix - Minor.

= 1.2.1 =
* Enhancement - Wordpress 4.8 and Woocommerce 3.0 compability.

= 1.2.0 =
* Enhancement - Wordpress 4.7 compability.
* Enhancement - Terms order saved in `termmeta` table instead `term_relationships`.
* Feature - Add disabled order filter (`Anything_Order/do_order/Post` and `Anything_Order/do_order/Taxonomy`).
* Bugfix - Polylang and Woocommerce compability.

= 1.1.6 =
 - Mobile view.

= 1.1.0 =
* Feature - Save post order for each term.

= 1.0.0 =
* Initial Release


== Upgrade Notice ==

The current version of Anything Order requires WordPress 4.4 or higher. If you use older version of WordPress, you need to upgrade WordPress first.
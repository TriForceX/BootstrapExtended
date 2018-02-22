=== Admin Menu Editor Pro ===
Contributors: whiteshadow
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=A6P9S6CE3SRSW
Tags: admin, dashboard, menu, security, wpmu
Requires at least: 4.1
Tested up to: 4.9.1
Stable tag: 2.6.2

Lets you directly edit the WordPress admin menu. You can re-order, hide or rename existing menus, add custom menus and more.

== Description ==
Pro version of the Admin Menu Editor plugin. Lets you manually edit the Dashboard menu. You can reorder the menus, show/hide specific items, change access rights, and more. 

[Get the latest version here.](http://adminmenueditor.com/updates/)

**Pro Version Features**

- Import/export custom menus.
- Set menu items to open in a new window or IFrame.
- Improved, role-based menu permissions interface.
- Use shortcodes in menu fields.
- Create menus accessible only to a specific user (by setting extra capability to "user:username").

**Other Features**

- Change menu title, access rights, URL and more. 
- Create custom menus.
- Sort items using a simple drag & drop interface.
- Move items to a different submenus.
- Hide any menu or submenu item.
- Supports WordPress MultiSite/WPMU.

**Requirements**

- WordPress 4.1 or later

_For maximum compatibility and security, using a modern web browser such as Firefox, Opera, Chrome or Safari is recommended. Certain advanced features (e.g. menu import) may not work reliably or at all in Internet Explorer and other outdated browsers._

**Credits**

This plugin uses some icons from the ["Silk" icon set](http://fortawesome.github.io/Font-Awesome/) by Mark James. These icons are licensed under the [Creative Commons Attribution 3.0 License](http://creativecommons.org/licenses/by/3.0/).

== Installation ==

_If you already have the free version of Admin Menu Editor installed, deactivate it before installing the Pro version._

**Normal installation**

1. Download the admin-menu-editor-pro.zip file to your computer.
1. Unzip the file.
1. Upload the `admin-menu-editor-pro` directory to your `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

That's it. You can access the the menu editor by going to _Settings -> Menu Editor Pro_. The plugin will automatically load your current menu configuration the first time you run it.

**WP MultiSite installation**

If you have WordPress set up in multisite ("Network") mode, you can also install Admin Menu Editor as a global plugin. This will enable you to edit the Dashboard menu for all sites and users at once.

1. Download the admin-menu-editor-pro.zip file to your computer.
1. Unzip the file.
1. Create a new directory named `mu-plugins` in your site's `wp-content` directory (unless it already exists).
1. Upload the `admin-menu-editor-pro` directory to `/wp-content/mu-plugins/`.
1. Move `admin-menu-editor-mu.php` from `admin-menu-editor-pro/includes` to `/wp-content/mu-plugins/`.

Plugins installed in the `mu-plugins` directory are treated as "always on", so you don't need to explicitly activate the menu editor. Just go to _Settings -> Menu Editor_ and start customizing your admin menu :)

_Notes_

- Instead of installing Admin Menu Editor in `mu-plugins`, you can also install it normally and then activate it globally via "Network Activate". However, this will make the plugin visible to normal users when it is inactive (e.g. during upgrades).
- When Admin Menu Editor is installed in `mu-plugins` or activated via "Network Activate", only the "super admin" user can access the menu editor page. Other users will see the customized Dashboard menu, but be unable to edit it.
- It is currently not possible to install Admin Menu Editor as both a normal and global plugin on the same site.

== Notes ==
Here are some usage tips and other things that can be good to know when using the menu editor : 

- WordPress uses the concept of [roles and capabilities](http://codex.wordpress.org/Roles_and_Capabilities "An overview of roles and capabilities") to manage access rights. Each Dashboard menu item has an associated capability setting, and only the users that possess that capability can see and use that menu item.

- "Hidden" menus are invisible to everyone - including the administrator - but they can still be accessed via the direct page URL. To make a menu inaccessible to certain users, edit its permissions.

- If you delete any of the default menus they will reappear after saving. This is by design. To get rid of a menu for good, either hide it or set it's access rights to a higher level.

== Changelog ==

[Get the latest version here.](http://adminmenueditor.com/updates/)

= 2.6.2 =
##### Added
* Added an `[ame-count-bubble]` shortcode. When used in a menu title, it takes the number bubble from the default menu title and displays it in the custom title. A "bubble" is the small number in a colored circle that appears on some menu items, like "Dashboard -> Updates (3)", "Comments (12)", or "WooCommerce -> Orders (5)".

##### Fixed
* Fixed a PHP 7.2 compatibility issue that caused this warning to show up on the menu editor page: "count(): Parameter must be an array or an object that implements Countable in menu-editor-core.php".
* Fixed a JavaScript error "cannot read property 'replace' of null" in the "Meta Boxes" tab that would show up if another plugin added a meta box without a valid title. 
* Fixed a JavaScript error "actor is null" when trying to save dashboard widget settings that contain user-specific permissions for nonexistent users. This typically happened when importing settings from another site.
* Fixed a conflict with Ultra WordPress Admin 7.4 that made it impossible to hide plugins.

##### Changed
* Tested with WP 4.9.4 and 5.0-alpha.

= 2.6.1 (2018-01-07) =
##### Added
* Added a list of basic tutorials to the menu editor screen.

##### Fixed
* Fixed a bug where menu items that use meta capabilities would have the "hidden from everyone" icon even if there were not actually hidden.
* Fixed incorrect version numbers in the "can't import settings from a newer version" error message.
* Fixed a bug that could cause some network admin menus to be highlighted as if they were new.
* Fixed a conflict with WP Courseware 4.1.2 where activating AME would cause a lot of extra menu items to show up unexpectedly.

##### Changed
* The plugin will display a warning if you try to hide the "Slug" metabox. Due to a known bug in WordPress, hiding this box can prevent you from changing the post permalink.
* Replaced the green puzzle-piece icon that was used to mark new items with an icon that just says "new".
* Tested with 4.9.1.

= 2.6 (2017-11-09) =
##### Fixed
* Added a workaround for a buggy "defer_parsing_of_js" code snippet that some users have added to their functions.php. This snippet produces invalid HTML code, which used to break the menu editor.
* Fixed a bug that caused WP-CLI to behave as if there were no installed plugins and no available updates.
* Fixed the "Tags" menu showing up as inaccessible.
* Fixed missing color labels in WordPress 4.9.
* Fixed a PHP warning that appeared when using this plugin together with WooCommerce or YITH WooCommerce Gift Cards and running PHP 7.1.
* Fixed a bug that prevented some capability changes from being applied.
* Fixed a bug where submenu items would not inherit FontAwesome icons from their parent menu.

##### Added
* You can now edit the network admin menu. The settings page is in the network admin, under "Settings -> Menu Editor Pro". Note that you still need to go to a site dashboard to edit the regular admin menu.
* The "Embed WP page" feature now works with private pages and posts, not just public pages.
* Added the ability to hide the special "Welcome" widget.

##### Changed
* Minor performance improvements.
* Tested with WP 4.8.3 and 4.9-RC2.

= 2.5.1 (2017-06-09) =
##### Fixed
* Fixed a WP-CLI compatibility issue where some CLI commands would fail with a fatal error: "Call to a member function check_current_user_access() on null".
* Fixed a couple of UI layout issues that affected RTL sites.
* Fixed a conflict with WP Nag Hide that prevented the "Open in": "New window" setting from working.
* Fixed an oversight that could cause a fatal error if a theme or plugin was using magic methods (i.e. __call and __callStatic) for hook callbacks.
* Fixed a CSS issue where, when changing the menu icon, certain Dashicons wouldn't properly replace the original icon.

= 2.5 (2017-06-05) =
##### Added
* You can edit plugin names and descriptions through the "Plugins" tab. This only changes how plugins are displayed on the "Plugins" page. It doesn't affect plugin files on disk.
* Added "Meta Boxes" tab. It lets you hide meta boxes and custom fields from roles and users. 
* Added an option to highlight new menu items. This feature is off by default. You can enable it in the "Settings" tab.
* Added an option to compress menu data that the plugin stores in the database. This significantly reduces the size of the relevant database entries, but it also adds some decompression overhead to every admin page load. You can enable this feature in the "Settings" tab.

##### Fixed
* Added a compatibility workaround for the Divi Training plugin. The hidden menu items that it adds to the "Dashboard" menu should no longer show up when you activate AME.
* Added a workaround that improves compatibility with plugins that set their menu icons using CSS. Previously, there were situations where users were not able to change menu icons because the plugin that created the menu item used CSS to override the normal icon. AME now adds an extra stylesheet that overrides icons with !important.
* Fixed an old bug where sorting menu items would put all separators at the top. Now they'll stay near their preceding menu item.
* Fixed incorrect shadows on custom screen options links.
* Fixed a couple of UI layout issues that were caused by bugs in other plugins.
* Fixed a rare issue where hiding the admin bar would leave behind empty space.

##### Changed
* Minor performance optimizations.
* When you use the "A-Z" button to sort top level menus, it also sorts submenu items. To avoid compatibility issues, the first item of each submenu stays in its original position.
* Automatically reset plugin access if the only allowed user no longer exists. This should cut down on the number of users who accidentally lock themselves out by setting "Who can access the plugin" to "Only the current user" and then later deleting that user account.

= 2.4.3 (2017-01-05) =
* Added a workaround for WooCommerce 2.6.8 to display the number of new orders in the "Orders" menu title.
* Tested with WP 4.7 and 4.8-alpha.

= 2.4.2 (2016-10-21) =
##### Added
* Added a way to completely hide the admin menu and the Toolbar (a.k.a Admin Bar) from specific roles or users.
* You can now copy menu permissions from one user to another with the "Copy permissions" toolbar button. Note that this button is hidden by default. To reveal it, click the rightmost button that looks like a double down arrow.

##### Fixed
* Fixed a bug where opening and closing the properties of a new menu item would set "extra capability" to "read".
* The "Welcome to All in One SEO Pack" menu item no longer shows up after activating the menu editor.
* Fixed an inconsequential "403 Forbidden" error in Chrome dev toools that was caused by Chrome trying and failing to load source maps for certain CSS & JS files.

= 2.4.1 (2016-08-29) =
* The plugin now remembers the last selected menu item and re-selects it after you save changes.
* Fixed a layout issue where menus with very long titles would appear incorrectly in the menu editor.
* When you change the menu title, the window title will also be changed to match it. You can still edit the window title separately if necessary.
* Moved the "Icon URL" field up and moved "Window title" down.

= 2.4 (2016-08-15) =
* Added Font Awesome icons.
* Added a "Users" tab that lets you hide individual users. Hidden users don't show up on the "All Users" page and they can't be edited or deleted by normal users. However, they can still show up in other parts of the WP admin (e.g. as post authors), and their content is not specially protected.
* Added more detailed permission error messages. You can turn them off in the "Settings" tab by changing "Error verbosity level" to "Low".
* Fixed the "Cancel" button in the "Select Visible Users" dialog not working when the "Plugins" tab is open.
* Tested up to WP 4.6.

= 2.3.1 (2016-06-16) =
* Allow the activation of license keys that no longer have access to updates. Previously activation could fail, which was confusing and made some users think that their key was invalid. Now "expired" keys can be properly activated (though they still don't get plugin updates).

= 2.3 (2016-06-11) =
* Added the "Plugins" tab. It lets you hide specific plugins from other users. Note that this only affects the list on the "Plugins" page and tasks like editing plugin files, but it doesn't affect the admin menu. If you hide a plugin, its menu items will still show up (assuming the user has the required permissions).
* Fixed the role/user list in the "Permissions" popup. Now it should show all selected users, not just the current user.
* Fixed wp-cli integration.

= 2.2.3 (2016-05-22) =
* Fixed a bug where selecting a role and then creating a new menu item could render most of the admin menu inaccessible to all other roles. This bug was introduced in version 2.2.2.

= 2.2.2 (2016-05-11) =
##### Fixed
* Fixed a bug that made menu items "jump" slightly to the left when you start to drag them.
* Fixed a bug that caused menu items with the required capability "administrator" to appear unchecked (= hidden) for the Administrator role. This also applies to other roles.
* Fixed a Multisite-specific bug where temporarily switching to another site using the switch_to_blog() function could result in the user having the wrong permissions.

##### Changed
* When saving settings, the plugin will compress the menu data before sending it to the server. This reduces the chances of exceeding request size limits that are imposed by some hosting companies.
* Tested up to WordPress 4.5.2.

= 2.2.1 (2016-04-16) =
##### Fixed
* Fixed a bug where typing in the search box in the "Choose Visible Users" dialog didn't do anything. Now it will actually search the list of registered users. This bug was introduced in version 2.2.
* Fixed a bug that prevented CPT permissions from working. This bug was also introduced in version 2.2.
* Fixed a backwards-compatibility bug related to the Ninja Forms plugin.
* Fixed a bug in the "Modern" editor theme that caused the "embed WordPress page" panel to appear underneath the selected menu item, making it near-impossible to see the panel.

##### Changed
* You can dismiss the "Settings saved" notification by clicking the "x" button.

= 2.2 =
##### Added
* Added a "Colors" button that lets you set the default color scheme for all admin menus at once. 
* Added a few more menu icons.
* Added basic support for the special "customize" and "delete_site" meta capabilities.

##### Fixed
* Fixed a "deprecated constructor" warning on sites running PHP 7.
* Fixed a bug that prevented menu items with an empty slug (i.e. no URL) from showing up.
* Fixed a bug where collapsing submenu properties would flag the "Icon URL" field as having a custom value even if you hadn't actually changed it.
* Fixed a rare WPML conflict that sometimes caused the admin menu to use a mix of different languages.
* Improved compatibility with buggy plugins and themes that throw JavaScript errors in their DOM-ready handlers.
* Renamed jquery.cookie.js to jquery.biscuit.js as a workaround for servers with overly aggressive ModSecurity configuration. Apparently, some servers block access to any URL that contains the text ".cookie".
* Added a compatibility workaround for the DW Question & Answer plugin. The hidden "Welcome", "Changelog" and "Credits" menu items should no longer show up when you activate AME.
* Added locking to reduce the risk of triggering a race condition when saving menu settings.

##### Changed
* Added tabs to the settings page: "Admin Menu" and "Settings". These tabs replace the heading buttons that were previously used to switch between the menu editor and general plugin settings.
* Tested up to WordPress 4.5-RC1.

= 2.1 =
##### Added
* Added a new editor colour scheme that makes the menu editor look more like other WordPress admin pages (e.g. Appearance -> Menus). You can enable it through the plugin settings page.
* New menu items that are added by other plugins will now show up in the same relative position as they would be in the default admin menu. Alternatively, they can be displayed at the bottom of the menu. You can configure this in plugin settings.

##### Fixed
* Fixed JavaScript error "_.empty is not a function".
* Improved compatibility with IP Geo Block.
* Fixed a layout issue where starting to drag one menu item would cause some other items to move around or change size very slightly. 
* Fixed a misleading tooltip. 

##### Changed
* Tested up to WordPress 4.4-RC1.
* Show an error message if an update fails due to license problems (expired key, key not activated, etc). Previously updates done through the "Dashboard -> Updates" pages would fail with a vague download error, and inline updates would hang at "Updating..." indefinitely.

= 2.0 =
##### Added
* Added "Choose users..." link that lets you select which users will show up in the menu editor. This makes it easier to change menu permissions for specific users.
* Added "Hide all submenu items when this item is hidden" setting. Normally, a top level menu stays visible as long as it has at least one accessible submenu item (that's just how WordPress works). You can use this setting to override that, forcing all submenu items to stay hidden if the user doesn't have access to the parent menu. Note that this can break plugins that rely on the default WordPress behaviour, so use with care.
* Added "Frame height" field. You can manually set the height of `<iframe>` elements that the plugin generates for menu items configured to open in a frame. Leave it empty to calculate the height automatically (the default).
* Improved support for custom post types. You can now change individual CPT permissions like "edit [content]", "edit other user's [content]", "delete private [content]", and so on without having to install additional plugins. To access these settings, select a menu item that points to a CPT and click the "Edit..." button next to the "Permissions" field.
* Added "Hide and prevent access" toolbar button. When the "All" option is selected in the list of roles, this button will hide the selected menu from everyone except the currently logged-in user (and Super Admin on Multisite). Basically, it's a shortcut for clicking on each role and unchecking the menu, then enabling the menu for your own account. When a specific role is selected, the button will just hide the selected menu from that role - the equivalent of toggling the menu checkbox.
* Added basic WP-CLI support. Run `wp help admin-menu-editor` for a list of available commands.
* Added "Apply to All" button to the color scheme screen. 
* You can save color presets.
* Added "Keep this menu open" checkbox. As the name implies, this setting keeps a top level menu expanded even if it is not the current menu.
* Added a way to embed a page or post in the WordPess admin. Set "Target page" to "Embed WP page", then pick a page from the "Embedded page ID" dropdown. You can also use the "Custom" tab to select a CPT item or to pick a page from another site of a Multisite network.
* You can define an `AME_LICENSE_KEY` constant in `wp-config.php` to set your license key. The plugin will attempt to automatically activate that key the next time an administrator visits the Dashboard. It will only try that *once* - if the key is incorerect or something else goes wrong, you'll have to activate your key manually.
* Added sort buttons to the top level menu toolbar. Click the down chevron button to display them.
* Added an arrow that points from the current submenu to the currently selected parent menu. This might help new users understand that the left column shows top level menus and the right column shows the corresponding submenu(s).

##### Fixed
* Role names no longer move around when you click them.
* No longer reserve space for submenu icons when the items with icons are not actually visible. 
* Fixed a rare bug where the menu editor would crash if one of the menu items had a `null` menu title. Technically, it's not valid to set the title to `null`, but it turns out that some plugins do that anyway.
* Fixed another rare bug where certain valid colors would be treated as "no color selected".
* Top level menus that have an empty title ("", an empty string) are no longer treated as separators.
* The "page heading" setting now works properly on pages that use `<h1>` headings.
* Made all text fields and dropdowns the same height. 
* All fields have consistent vertical margins.
* Fixed a number of layout bugs that could cause field labels to show up in the wrong place or get wrapped/broken in half when another plugin changed the default font or input size.
* Fixed a minor layout bug that caused the "expand menu properties" arrow to move down slightly when holding down the mouse button.
* Fixed a minor bug that could cause toolbar buttons to change size or position if another plugin happens to override the default link and image CSS.
* Added a workaround for plugins that create "Welcome", "What's New" or "Getting Started" menu items and then hide those items in a non-standard way. Now (some of) these items will no longer show up unnecessarily.
* Fixed a bug that mostly affected mobile devices and made it impossible to expand a top level menu when its "target page" was set to "None".
* Improved compatibility with buggy plugins that unintentionally corrupt the list of users' roles by misusing `array_shift`.
* Fixed a URL parsing bug that caused AME to mix up the "Customize", "Header" and "Background" menu items in some configurations.

##### Changed
* Increased minimum required WordPress version to 4.1.
* In the "Permissions" dialog, moved the "enabled" checkbox to the left side of the list of roles. 
* Un-deprecated the "Show/Hide" button, renamed it to "Hide without preventing access" and improved its compatibility with other features. Now it supports per-role settings. Changed the icon from a grey puzzle piece to a rectangle with a dashed border.
* Made the plugin more resilient to JavaScript crashes caused by other plugins.
* Use `<h1>` headings for admin pages in WordPress 4.2 and above.
* The plugin will remember the last few site URLs it has been activated on and automatically load the appropriate license details if the URL changes. This only works when all of the sites share the same WordPress database. 
* The default submenu icon now matches the parent icon.
* Changed the wording of a bunch of tooltips.
* Made the "delete" button appear disabled when the selected menu item can't be deleted.
* Moved the "new separator" button so that it's next to the "new menu" button.  
* Ran out of space in the toolbar, moved a few buttons to the second row. Click the new last button in the toolbar ("down chevron") to show or hide the second row.
* Changed the close icon of plugin dialogs to a plain white "X".
* Increased tooltip text size.
* Optimization: Removed emoji scripts from the menu editor page. WordPress emoji implementation can significantly slow down JavaScript-heavy plugins because it tracks all DOM changes via MutationObserver.
* Tested up to WordPress 4.4-beta3.

= 1.99 =
* Fixed a `TypeError: invalid 'in' operand a` error that caused compatibility issues with WordPress 4.3.
* Fixed a bug where the current menu item wouldn't get highlighted if its URL included %-encoded query parameters.
* Fixed a bug in menu URL generation that could cause problems when moving a plugin menu from "Posts", "Pages" or a CPT to another menu. The URL of the menu item got changed in a way that could break some plugins.
* Fixed a .htaccess compatiblility issue with with Apache 2.3+.
* Fixed a layout issue that caused the "reset to default" button for the "Color scheme" field to show up in the wrong place.
* Fixed an incorrect directory name in an error message.
* The "Links" menu will no longer show up in the editor unless explicitly enabled. As of WP 3.5, the "Links" menu still exists in WordPress core but is inaccessible because the Links Manager is disabled by default.
* Slightly improved menu item drag-and-drop. You can now drop top level menus anywhere in the submenu box. Previously you had to drop them in a specific, fixed spot. Also, when dragging a submenu item to the top level, a placeholder box will show up to indicate where you can drop the item.
* Tested with WordPress 4.3.

= 1.98 =
* Tested up to WordPress 4.2.
* Fixed a tab layout issue in the license information screen.

= 1.97 =
* Reduced export file size by about 50%. Slightly reduced database space usage.
* Trying to delete a non-custom menu item will now trigger a warning dialog that offers to hide the item instead. In general, it's impossible to permanently delete menus created by WordPress itself or other plugins (without editing their source code, that is).
* Improved the algorithm used to calculate iframe height. Now it's less likely that pages set to "Open in: Frame" will have an unnecessary scrollbar.
* Added a workaround for a bug in W3 Total Cache 0.9.4.1 that could cause menu permissions to stop working properly when the CDN or New Relic modules were activated.
* Fixed a plugin conflict where certain menu items didn't show up in the editor because the plugin that created them used a very low priority.
* Significantly improved sanitization of menu properties. 
* Renamed the "Choose Icon" button to "Media Library".
* Minor compatibility improvements.
* Tested up to WordPress 4.2-alpha.

= 1.96 =
* Added a "Copy permissions" button. It lets you copy all menu permissions from one role to another.
* Fixed a bug that allowed Administrators to bypass custom permissions for the "Appearance -> Customize" menu item.
* Fixed a regression in the menu highlighting algorithm.
* Fixed an "array to string conversion" notice caused by passing array data in the query string. 
* Fixed menu scrolling occasionally not working when the user moved an item from one menu to another, much larger menu (e.g. having 20+ submenu items).
* Fixed a bug where moving a submenu item from a plugin menu that doesn't have a hook callback (i.e. an unusable menu serving as a placeholder) to a different menu would corrupt the menu item URL.
* Added more detailed error reporting for situations when uploading a menu fails due to a server-side error.
* Switching between tabs in the "License" pop-up no longer requires JavaScript. In rare cases, JS-based tab switching could stop working due to bugs in other plugins.
* Fixed a few minor bugs in the "License" pop-up.

= 1.95 =
* The plugin now automatically removes consecutive submenu separators on display. This fixes an issue with multiple separators "bunching up" when the menus that they would usually separate are invisible due to role permissions.
* Fixed "Appearance -> Customize" always showing up as "new" and ignoring custom settings.
* Fixed a WooCommerce 2.2.1+ compatibility issue that caused a superfluous "WooCommerce -> WooCommerce" submenu item to show up. Normally this item is invisible.
* Fixed a bug where the plugin would fail to determine the current menu if the user tries to add a new item of a custom post type that doesn't have an "Add New" menu. Now it highlights the CPT parent menu instead.
* Fixed a very obscure bug where certain old versions of PHP would crash if another plugin created a menu item using an absolute file name as the slug while AME was active. The crash was due to a known bug in PHP and only affected Windows systems with open_basedir enabled.
* Added more debugging information for situations where the plugin can't save menu settings due to server configuration problems.
* Other minor fixes and optimizations.

= 1.94 =
* Added experimental support for submenu icons. By default, submenu items start out with no icons. You can manually add an icon to each item, configure the plugin to show default icons for all items, or turn off this feature entirely.
* Added two new shortcodes: [wp-logout-url] and [wp-user-display-name].
* Added a "Logout" option to the "Target page" dropdown.
* Added a special target page option: "< None >". It makes the selected menu item unclickable.
* Added a "permissions modified" status icon. It will appear on menu items that have custom permissions for the selected role or user.
* Added a new menu editor colour scheme that's similar to the default WordPress admin colour scheme. Click the "Settings" button next to the menu editor page title to switch colour schemes.
* Added a warning that explains that non-custom menus can't be deleted and should be hidden instead. Previously the plugin would let the user delete a menu, then automatically restore it on the next page reload.
* Fixed strange boxes showing up in the icon selector in Internet Explorer.
* Fixed duplicate top level menus mysteriously disappearing. Now the plugin will properly warn the user that all top level menus must have unique URLs.
* Fixed an obscure bug where changing the "Target page" from the default setting to "Custom" and back would occasionally make some menu properties suddenly show up as modified for no apparent reason.
* Fixed submenu separators being invisible in WP 4.0-beta.
* Fixed incorrect submenu item height and margins in WP 4.0-beta.
* Fixed a minor layout bug where items with no title would be smaller than other items.
* Fixed combo-box dropdown button height for WP 3.9.x.
* Fixed the selected_actor query parameter not being URL-encoded. 
* Added a workaround for a bug in WordPress Mu Domain Mapping 0.5.4.3.
* Added a workaround for the very unusual situation where the "user_has_cap" filter is called without a capability.
* Fixed duplicates of bbPress menu items showing up.
* Increased import file size limit from 512 KB to 5 MB.
* Added better error reporting for failed imports.
* Changed the default custom menu icon to the generic "cogwheel" icon from Dashicons.
* Other small UI changes.
* Raised minimum requirements to WordPress 3.8 or later. This is mainly due to the increased reliance on Dashicons as menu icons.

= 1.93 =
* Added a large number of menu icons based on the Dashicons icon font.
* Added a way to change the color scheme of individual top level menus.
* Added a "page heading" menu setting. 
* Fixed default menu icons not showing up in WP 3.9.
* Fixed a rare "$link.attr(...) is undefined" JS error.
* Fixed a bug where a hidden submenu page with a URL like "options-general.php?page=something" would still be accessible via "admin.php?page=something".
* Update notifications now work even when the plugin installed in `mu-plugins`. However, updates still need to be uploaded manually because WordPress does not support automatic updates for MU plugins.
* Tested with WordPress 3.9-beta3.
* Increased minimum requirements to WordPress 3.5 or later.

= 1.92 =
* Tested with WordPress 3.8.
* Fixed several minor UI/layout issues related to the new 3.8 admin style.
* Fixed a bug where moving an item to a plugin menu and then deactivating that plugin would cause the moved item to disappear.
* Fixed deleted submenus not being restored if their original parent menu is no longer available.
* Fixed a rare glitch where submenu separators added by certain other plugins would sometimes disappear.
* Fixed a conflict with Shopp 1.2.9.
* Fixed: Opening the "Permissions" window for a menu item that does not have an extra capability and then clicking "Save Changes" in the window and the main editor screen (without making any changes) no longer adds a new extra capability equal to the required capability. 
* Made the plugin treat "users.php" and "profile.php" as the same parent menu. This fixes situations where it would be impossible to hide a "Users" submenu item from roles that don't have access to the "Users" menu and instead get a "Profile" menu.
* Added extra logging for situations where a menu item is hidden because a higher-priority item with the same URL is also hidden. 
* Further performance improvements.

= 1.91 =
* Added a number of small performance optimizations.
* Added an admin notice that explains how to get to the menu editor page.
* The plugin will now display an "are you sure?" dialog if you try to hide "Dashboard -> Home". Hiding this menu item can prevent people from logging in unless you also change what page they are redirected to upon login.
* Deprecated the "Show/Hide" toolbar button. Use role permissions or custom capabilities instead. You can still enable the button through the settings page if you need it.
* Fixed: Opening a modal dialog like "Permissions" or "Import menu" will now properly grey out the rest of the page.
* Tested with WordPress 3.7.1 and 3.8-alpha.

= 1.90 =
* Added a new settings page that lets you choose whether admin menu settings are per-site or network-wide, as well as specify who can access the plugin. To access this page, go to "Settings -> Menu Editor Pro" and click the small "Settings" link next to the page title.
* Added an option to hide the plugin from the list of installed plugins.
* Added a way to show/hide advanced menu options through the settings page in addition to the "Screen Options" panel.
* Added a "Show menu access checks" option to make debugging menu permissions easier.
* Added a "toggle all menus for the selected role" button.
* Added partial WPML support. Now you can translate custom menu titles with WPML.
* Replaced a number of toolbar icons with GPL-compatible alternatives so that they're consistent with the free version.
* The plugin will now display an error if you try to activate it when another version of it is already active.
* Fixed a bug where the capability drop-down list would briefly show up and then immediately disappear.

= 1.83 =
* Fixed an "invalid argument" warning caused by the plugin sometimes failing to retrieve a user's roles.
* Fixed a rare issue where the user would be unable to make a sub-menu item visible if a top-level menu with the same URL was hidden (e.g. hide "Posts", show "Posts -> All Posts" in another menu). Creating duplicate menus is still not recommended.
* Fixed a conflict with some CSS/JS auto-versioning schemes that could prevent the user from saving the menu.

= 1.82 =
* Added an "Upgrade or renew license" link to the license information screen.
* Added license expiration date (if applicable) to the license information screen.
* Fixed plugin updates not showing up in ManageWP.
* Fixed a rare bug where the icon selector would appear at the bottom of the page instead of next to the icon button.
* Fixed incorrect icon alignment and checkboxes showing up in the wrong place when using the MP6 admin UI.
* Removed "site token" from the license information screen.

= 1.81 =
* Added a workaround for a bug in BackupBuddy that would cause Admin Menu Editor Pro to check for updates much more often than it's supposed to.

= 1.80 =
* Added an icon drop-down that lets you pick one of the default WordPress menu icons or upload your own through the media library.
* The editor will now automatically re-select the last selected role after saving a menu.
* You can hold Ctrl while moving a menu item from a submenu to a top-level menu (or vice versa) to copy instead of moving.
* Changed the way permission checkboxes are displayed for menus that have some visible and some hidden items.
* Switched to a different, more subtle submenu separator style.
* Moved the "Icon URL" field below the "CSS classes" field.
* Made the "broken editor permissions" error message more helpful.
* Fixed menus with custom icons sometimes displaying two overlapping icons.
* Fixed the "Window title" setting not working for anything except custom menus.
* Fixed a hard-to-identify bug where one user would get "$(...).ajaxForm is not a function" errors all the time.
* Fixed compatibility issues with Ultimate TinyMCE.

= 1.70 =
* Added the ability to create menu separators in submenus.
* Fixed a bug where the height of the IFrame element generated for menus set to display in a frame would be limited to 300px (WP 3.5).
* Fixed a rare "call to a member function function get_virtual_caps() on a non-object" error.
* Fixed a couple of layout glitches that would make the editor sidebar display incorrectly in WP 3.5.
* Fixed: Ensure that the correct menu item gets highlighted when adding a new item of a custom post type, even if there's no "Add New {Thing}" entry in the admin menu. This fixes the bug where clicking the "Add New" button in WooCommerce -> Coupons would highlight the Posts -> Add New menu.
* Other minor fixes.
* Tested on WordPress 3.5 (RC6).

= 1.60 =
* Added a number of small optimizations. On some systems menu output time is reduced by almost 30%.
* Fixed a couple of PHP warnings caused by a bug in the custom update checker.
* Fixed a conflict with plugins that use an old version of the custom update checker.
* Changed how the plugin treats situations where multiple menu items have the same URL. Now either all of them will show up in the final menu or none will. However, it's still best to keep your menu free from duplicate items to avoid ambiguity.

= 1.50 =
* Added support for fully automatic plugin upgrades. You will need to enter a license key to enable this feature.
* Existing users will get a license key when they download this version. New users will get one in their purchase confirmation email.
* Added a "Check for updates" link to the plugin's entry in the "Plugins" page.

= 1.40 =
* Added a new way to view and set per-role permissions. There's now a role selector at the top of the menu editor page, and selecting a role grays out any menu items that role can't access. You can also change menu permissions for the currently selected role via checkboxes in menu titles.
* Added a warning to menus that are only accessible by a specific role due to hardcoded restrictions in the plugin(s) responsible for those menus.
* Added a warning if saving the menu would make it impossible for the current user to access the menu editor. This doesn't catch 100% of configuration problems, but should help.
* Re-added the ability to reset permissions to default. 
* Fixed incompatibility with Ozh's Admin Drop Down Menu.
* Fixed: Going to http://example.com/wp-admin/ now expands and highlights Dashboard -> Home as the current menu. Previously it didn't highlight any menus for that URL.
* Fixed: Newly created items sometimes didn't reflect the actual menu settings. This was a problem when loading the default menu or undoing changes.
* Fixed: When displaying a menu, remove all duplicate separators, not just every other one.
* Fixed: Only consider Super Admins when in multisite mode. On single-install sites, they're just identical to normal administrators.
* Fixed: If the currently open menu page has been moved to a different parent, clicking it's original parent menu would briefly flash the submenu as if it was currently active.
* Make the capability that's required to use the plugin user-configurable (via the "admin_menu_editor_capability" filter).
* When adding a new menu, sub-menu or separator, insert them after the currently selected item instead of at the end of the list.
* Only display the survey notice on the editor page, and let the user disable it by adding a `never-display-surveys.txt` file to the plugin folder.

= 1.30 =
* Added a new user survey. The link only shows up after you've used the plugin for a few days.
* Fixed a bug where menus that by default require a specific role (e.g. "administrator") and not a normal capability would become inaccessible immediately after activating the plugin.
* Fixed the wrong menu to being expanded/highlighted sometimes.
* Fixed a deprecated function notice.
* Fixed compatibility issues with sites using SSL.
* Fixed a number of complex bugs related to moved menu items.

= 1.20 =
* Revamped the permissions interface. Now you can directly select the roles that should or shouldn't be able to access a menu instead of trying to find a capability that matches your requirements. You can still set the capability if you want.
* Added a "Target page" field that lets you select what page a menu item should link to. This is less error-prone than entering the URL manually. Of course, if you *do* want to use custom URL, you can select "Custom" and type in your own URL.
* Fixed a bug that would cause certain menu items to not be highlighted properly if they've been moved to a different top-level menu.
* Made it possible to move a sub-menu item to the top level and vice versa. Drag the item in question to the very end of the (sub-)menu and drop it on the yellow rectangle that will appear.
* You can now cut & paste menu items between the sub-menus and the top level menu.
* You can now use "not:capability", "capability1,capability2", "capability1+capability2" and other advanced syntax in the capability field.
* Added a new menu export format. Old exported menus should still work.
* Items that point to missing menu pages (e.g. a page belonging to a plugin that has been deactivated) are automatically removed. Previously, they would still show up in the editor until you removed them manually.
* All custom menus now use the same set of defaults.
* Custom menus (i.e. menus with custom URLs) can no longer use defaults associated with default menus.

= 1.16 =
* Removed the "Feedback" button. You can still provide feedback via email or the contact form, of course.

= 1.15 =
* Fixed a PHP warning when no custom menu exists (yet).

= 1.14 =
* Fixed menu export not working when WP_DEBUG is set to True.
* Fixed the updater's cron hook not being removed when the plugin is deactivated.
* Fixed updates not showing up in some situations.
* Fixed the "Feedback" button not responding to mouse clicks in some browsers.
* Enforce the custom menu order by using the 'menu_order' filter. Fixes Jetpack menu not staying put.
* Fixed "Feedback" button style to be consistent with other WP screen meta buttons.
* You can now copy/paste as many menu separators as you like without worrying about some of them mysteriously disappearing on save.
* Fixed a long-standing copying related bug where copied menus would all still refer to the same JS object instance.
* Added ALT attributes to the toolbar icon images.
* Removed the "Custom" checkbox. In retrospect, all it did was confuse people.
* Made it impossible to edit separator properties.
* Removed the deprecated "level_X" capabilities from the "Required capability" dropdown. You can still type them in manually if you want.

= 1.13 =
* Tested for WordPress 3.2 compatibility.

= 1.12 =
* Fixed a "failed to decode input" error that would show up when saving the menu.

= 1.11 = 
* WordPress 3.1.3 compatibility. Should also be compatible with the upcoming 3.2.
* Fixed spurious slashes sometimes showing up in menus.
* Fixed a fatal error concerning "Services_JSON".

= 1.1 = 
* WordPress 3.1 compatibility.
* Added the ability to drag & drop a menu item to a different menu.
* You can now set the "Required capability" to a username. Syntax: "user:john_smith".
* Added a drop-down list of Dashboard pages to the "File" box.
* When the menu editor is opened, the first top-level menu is now automatically selected and it's submenu displayed. Hopefully, this will make the UI slightly easier to understand for first-time users.
* All corners rounded on the "expand" link when not expanded.
* By popular request, the "Menu Editor" menu entry can be hidden again.

== Upgrade Notice ==

= 1.94 =
Added support for submenu icons, two new menu URL options ("Logout" and "None"), better error reporting, and a new menu editor colour scheme. Fixed several UI layout bugs, plugin conflicts and issues with importing large JSON files.
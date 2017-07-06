=== Easy Image Gallery ===
Contributors: devrix, nofearinc
Tags: image gallery, image, galleries, simple, easy, devrix
Requires at least: 3.5
Tested up to: 4.7.1
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily create an image gallery on your posts, pages or any custom post type

== Description ==

There comes a time when you need more flexibility than the standard WP gallery offers, That's when this plugin steps in. This plugin's goal is to make it easy to create a gallery and place it wherever you need. A perfect example would be to create a product gallery for an ecommerce website and then have the flexibility to position it where you wanted to match your theme's design.

This plugin allows you to easily create an image gallery on any post, page or custom post type. Images are can be added and previewed from the metabox. Images can be re-ordered by drag and drop.

Features:

1. Drag and drop re-ordering
1. Add gallery to any post, page or custom post type
1. If more than one image is added to the gallery, the images become grouped in the lightbox so you can easily view the next one
1. CSS and JS are only loaded on pages where needed
1. Images link to larger versions (can be turned off)
1. Fully Localized (translation ready) with .mo and .po files
1. Add multiple images to the gallery at once
1. Uses the thumbnail size specified in Settings -> Media
1. Custom webfont icon for hover effect
1. Uses the new WP 3.5+ media manager for a familiar and intuitive way to add your images
1. WordPress 4.7 Ready

= Usage =

Galleries are automatically appended to the bottom of your post/page unless you use the shortcode below. Using the shortcode will give you finer control over placement within the content area. Plugin settings are located under Settings -> Media

= Shortcode Usage =

Use the following shortcode anywhere in the content area to display the gallery

	[easy_image_gallery]

= Template Tag Usage =

The following template tag is available to display the gallery

	if( function_exists( 'easy_image_gallery' ) ) {
		echo easy_image_gallery();
	}

If you use the template tag above, you will need remove the default content filter:

remove_filter( 'the_content', 'easy_image_gallery_append_to_content' );

= Developer Friendly =

1. Modify the gallery HTML using filters
1. Developed with WP Coding Standards
1. Easily add your preferred lightbox script via hooks and filters
1. Easily unhook CSS and add your own styling
1. Pass in a different image size for the thumbnails via filter
1. Minimalistic markup and styling

**Stay up to date**

*Become a fan on Facebook*
[https://www.facebook.com/DevriXLtd](https://www.facebook.com/DevriXLtd "Facebook Devrix")
[https://www.facebook.com/DevriXShop]
(https://www.facebook.com/DevriXLtd "Facebook Devrix Shop")

*Follow us on Twitter*
[https://twitter.com/wpdevrix](https://twitter.com/wpdevrix"Twitter")

== Installation ==

1. Upload the entire `easy-image-gallery` folder to the `/wp-content/plugins/` directory, or just upload the ZIP package via 'Plugins > Add New > Upload' in your WP Admin
1. Activate Easy Image Gallery from the 'Plugins' page in WordPress
1. Configure the plugin's settings from Settings -> Media
1. Create a gallery on any post or page from the added 'Image Gallery' metabox.

== Screenshots ==

1. The plugin's simple configuration screen. Any existing custom post types will appear here
1. The plugin's simple metabox that is added to the publish/edit screens
1. WordPress 3.5's new media manager is launched when you click "Add gallery images". You can select multiple images to insert into the gallery
1. The plugin's Image Gallery metabox after images have been inserted and the post has been saved
1. The front-end of the website showing the gallery which has been automatically appended to the content
1. Clicking on an image launches the lightbox. Here it's shown with prettyPhoto

== Frequently Asked Questions ==

= fancyBox looks different after upgrading to 1.1 =

This plugin mistakenly had fancyBox 2 included. Non-GPL software is not allowed on the WordPress repo (fancyBox 2 is licensed under Creative Commons). It has now been replaced with fancyBox 1, which is GPL compatible. If you'd like to add fancyBox 2 back into the plugin, simply [download this free plugin](http://sumobi.com/shop/easy-image-gallery-extend/ "Extend Easy Image Gallery with additional lightboxes")

= Where are the plugin's settings? =

In your WordPress admin under Settings -> Media

= How can I add another Lightbox script to the plugin? =

[Read This](http://sumobi.com/how-to-add-any-lightbox-script-to-the-easy-image-gallery-plugin "How to add another lightbox script to Easy Image Gallery") or [download this free plugin](http://sumobi.com/shop/easy-image-gallery-extend/ "Extend Easy Image Gallery with additional lightboxes") to add Colorbox and fancyBox 2

= How can I use a different thumbnail size for each post type? =

[Read This](http://sumobi.com/different-thumbnail-sizes-for-each-post-type-with-easy-image-gallery/ "Different thumbnail sizes for each post type with Easy Image Gallery")

== Upgrade Notice ==
The plugin ownership was transferred to DevriX. There are no functionality changes. We are going to work on a few version, adding some nice feature in the near feature, stay tuned! :)

== Changelog ==

= 1.2.1 =
* Release date - January 31, 2017.
* Removing Fancybox 2.0 due to license constraints, back to 1.3.4

= 1.2 =
* Release date - Release date - January 26, 2017.
* The plugin ownership was transferred to DevriX. We are going to maintain and update the plugin for now on :)

= 1.1.5 =
* Update Easy Image Gallery author

= 1.1.4 =
* Tweak: Updated French translations, props fxbenard

= 1.1.3 =
* Tweak: Added text domain to plugin headers in accordance with new translation system

= 1.1.2 =
* Fix: Added esc_attr to title attribute. Captions that included quotes were getting cut off.
* Fix: Updated PrettyPhoto JavaScript file to v3.1.6

= 1.1.1 =
* Fix: Missing slash on path to CSS file when plugin's CSS is overridden from a child theme

= 1.1 =
* Tweak: fancybox 2 has been replaced with fancybox 1, as non GPL software is not allowed on the WP repo (fancyBox 2 is license under Creative Commons).

= 1.0.6 =
* Fix: Settings link on plugins page
* Fix PHP notice on Settings -> Media page
* Tweak: removed unneeded function

= 1.0.5 =

* Tweak: The plugin's options page has been moved to settings -> media
* Tweak: Renamed the 'thumbnail_image_size' filter name to be 'easy_image_gallery_thumbnail_image_size' so it's unique to the plugin
* Tweak: Renamed the 'linked_image_size' filter name to be 'easy_image_gallery_linked_image_size' so it's unique to the plugin

= 1.0.4 =

* Fix: Images now use the image's caption rather than title field
* New: Styling for image placeholder as images are being dragged

= 1.0.3 =

* Fix: jQuery script that calls light box was being loaded when there were no gallery images

= 1.0.2 =

* Tweak: Improved loading of scripts

= 1.0.1 =

* Tweak: Images now link to the "large" image size by default, rather than the original image
* Tweak: Removed "remove" links underneath each image and added a [-] on hover to be consistent with WordPress' media manager styling
* New: linked_image_size filter for specifying which image size the thumbnails should link to
* New: 2 new filters added for overriding the JS for prettyPhoto and fancyBox. easy_image_gallery_prettyphoto_js and easy_image_gallery_fancybox_js

= 1.0 =

* Initial release

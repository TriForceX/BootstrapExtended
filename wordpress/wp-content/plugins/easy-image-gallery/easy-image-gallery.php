<?php
/*
Plugin Name: Easy Image Gallery
Plugin URI: http://devrix.com/
Description: An easy to use image gallery with drag & drop re-ordering
Version: 1.2.1
Author: DevriX
Author URI: http://devrix.com/
Text Domain: easy-image-gallery
License: GPL-2.0+
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Easy_Image_Gallery' ) ) {

	/**
	 * PHP5 constructor method.
	 *
	 * @since 1.0
	*/
	class Easy_Image_Gallery {

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
			add_action( 'plugins_loaded', array( $this, 'constants' ));
			add_action( 'plugins_loaded', array( $this, 'includes' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'easy_image_gallery_plugin_action_links' );
		}


		/**
		 * Internationalization
		 *
		 * @since 1.0
		*/
		public function load_textdomain() {
			load_plugin_textdomain( 'easy-image-gallery', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}


		/**
		 * Constants
		 *
		 * @since 1.0
		*/
		public function constants() {

			if ( !defined( 'EASY_IMAGE_GALLERY_DIR' ) )
				define( 'EASY_IMAGE_GALLERY_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

			if ( !defined( 'EASY_IMAGE_GALLERY_URL' ) )
			    define( 'EASY_IMAGE_GALLERY_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

			if ( ! defined( 'EASY_IMAGE_GALLERY_VERSION' ) )
			    define( 'EASY_IMAGE_GALLERY_VERSION', '1.2' );

			if ( ! defined( 'EASY_IMAGE_GALLERY_INCLUDES' ) )
			    define( 'EASY_IMAGE_GALLERY_INCLUDES', EASY_IMAGE_GALLERY_DIR . trailingslashit( 'includes' ) );

		}

		/**
		* Loads the initial files needed by the plugin.
		*
		* @since 1.0
		*/
		public function includes() {

			require_once( EASY_IMAGE_GALLERY_INCLUDES . 'template-functions.php' );
			require_once( EASY_IMAGE_GALLERY_INCLUDES . 'scripts.php' );
			require_once( EASY_IMAGE_GALLERY_INCLUDES . 'metabox.php' );
			require_once( EASY_IMAGE_GALLERY_INCLUDES . 'admin-page.php' );

		}

	}
}

$easy_image_gallery = new Easy_Image_Gallery();

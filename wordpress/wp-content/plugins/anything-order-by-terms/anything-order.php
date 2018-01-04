<?php

/*
	Plugin Name: Anything Order by Terms
	Plugin URI: http://wordpress.org/plugins/anything-order-by-terms/
	Description: This plugin allows you to arrange any post types and taxonomies with drag and drop. Save post order for each term.
	Author: briar
	Author URI: http://briar.site/
	Text Domain: any-order
	Domain Path: /languages
	Version: 1.2.2
	License: GPL version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'Anything_Order' ) ) {

	/**
	 * Reorder any post types and taxonomies with drag and drop.
	 *
	 * @since 1.0
	 */
	class Anything_Order {

		/**
		 * Holds the singleton instance of this class.
		 *
		 * @since 1.0.0
		 *
		 * @var object
		 */
		private static $instance = null;

		/**
		 * Singleton.
		 *
		 * @since 1.0.0
		 *
		 * @return object
		 */
		final public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor. Includes Anythig Order modules.
		 *
		 * @since 1.0.0
		 */
		protected function __construct() {
			load_plugin_textdomain( 'any-order', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

			include_once 'modules/base/class.php';
			include_once 'modules/post/class.php';
			include_once 'modules/taxonomy/class.php';

		}

	}

	add_action( 'plugins_loaded', array( 'Anything_Order', 'get_instance' ) );
}

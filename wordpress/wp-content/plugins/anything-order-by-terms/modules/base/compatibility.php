<?php
/**
 * Compatibility class.
 *
 * @since 1.3
 */

class Anything_Order_Compatibility {

	public function __construct() {
		$this->woocommerce();

	}

	protected function woocommerce() {

		//Disable WC sort product category
		add_filter( 'woocommerce_sortable_taxonomies', '__return_empty_array' );

		//Remove term ordering assets
		add_filter( 'admin_enqueue_scripts', array( $this, 'woocommerce_assets' ), 100 );
	}

	public function woocommerce_assets() {
		wp_dequeue_script( 'woocommerce_term_ordering' );
	}

}

new Anything_Order_Compatibility();
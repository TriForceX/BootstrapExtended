<?php
/*
 * @package Anything_Order
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) || ! defined( 'WP_UNINSTALL_PLUGIN') ) {
    exit();  // silence is golden
}

global $wpdb;

if ( ! is_multisite() ) {
    $wpdb->delete( $wpdb->term_relationships, array( 'object_id' => 0 ) );

} else {
    $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
    foreach ( $blog_ids as $blog_id ) {
        switch_to_blog( $blog_id );
        $wpdb->delete( $wpdb->term_relationships, array( 'object_id' => 0 ) );
    }
    restore_current_blog();
}

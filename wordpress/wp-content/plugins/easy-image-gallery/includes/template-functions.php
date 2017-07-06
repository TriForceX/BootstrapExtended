<?php
/**
 * Template functions
 *
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.


/**
 * Is gallery
 *
 * @since 1.0
 * @return boolean
 */
function easy_image_gallery_is_gallery() {

	$attachment_ids = get_post_meta( get_the_ID(), '_easy_image_gallery', true );

	if ( $attachment_ids ) {
		return true;
	}

	return false;
}


/**
 * Check the current post for the existence of a short code
 *
 * @since 1.0
 * @return boolean
 */
function easy_image_gallery_has_shortcode( $shortcode = '' ) {
	global $post;

	// false because we have to search through the post content first
	$found = false;

	// if no short code was provided, return false
	if ( !$shortcode ) {
		return $found;
	}

	if (  is_object( $post ) && stripos( $post->post_content, '[' . $shortcode ) !== false ) {
		// we have found the short code
		$found = true;
	}

	// return our final results
	return $found;
}


/**
 * Setup Lightbox array
 *
 * @since 1.0
 * @return array
 */
function easy_image_gallery_lightbox() {

	$lightboxes = array(
		'fancybox' => __( 'fancyBox', 'easy-image-gallery' ),
		'prettyphoto' => __( 'prettyPhoto', 'easy-image-gallery' ),
	);

	return apply_filters( 'easy_image_gallery_lightbox', $lightboxes );

}

/**
 * Get lightbox from settings
 *
 * @since 1.0
 * @return string
 */

if ( !function_exists( 'easy_image_gallery_get_lightbox' ) ) :
	function easy_image_gallery_get_lightbox() {

		$settings = (array) get_option( 'easy-image-gallery' );

		// set fancybox as default for when the settings page hasn't been saved
		$lightbox = isset( $settings['lightbox'] ) ? esc_attr( $settings['lightbox'] ) : 'prettyphoto';

		return $lightbox;

	}
endif;


/**
 * Returns the correct rel attribute for the anchor links
 *
 * @since 1.0
 * @return string
 */

function easy_image_gallery_lightbox_rel() {

	$lightbox = easy_image_gallery_get_lightbox();

	switch ( $lightbox ) {

	case 'prettyphoto':

		$rel = 'prettyPhoto';

		break;

	case 'fancybox':

		$rel = 'fancybox';

	default:

		$rel = 'prettyPhoto';

		break;
	}

	return $rel;
}


/**
 * Has linked images
 *
 * @since 1.0
 * @return boolean true
 */
function easy_image_gallery_has_linked_images() {

	$link_images = get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true );

	if ( 'on' == $link_images )
		return true;
}


/**
 * Get list of post types for populating the checkboxes on the admin page
 *
 * @since 1.0
 * @return array
 */
function easy_image_gallery_get_post_types() {

	$args = array(
		'public' => true
	);

	$post_types = array_map( 'ucfirst', get_post_types( $args ) );

	// remove attachment
	unset( $post_types[ 'attachment' ] );

	return apply_filters( 'easy_image_gallery_get_post_types', $post_types );

}

/**
 * Retrieve the allowed post types from the option row
 * Defaults to post and page when the settings have not been saved
 *
 * @return array
 * @since 1.0
*/
function easy_image_gallery_allowed_post_types() {
	
	$defaults['post_types']['post'] = 'on';
	$defaults['post_types']['page'] = 'on';

	// get the allowed post type from the DB
	$settings = ( array ) get_option( 'easy-image-gallery', $defaults );
	$post_types = isset( $settings['post_types'] ) ? $settings['post_types'] : '';

	// post types don't exist, bail
	if ( ! $post_types )
		return;

	return $post_types;

}


/**
 * Is the currently viewed post type allowed?
 * For use on the front-end when loading scripts etc
 *
 * @since 1.0
 * @return boolean
 */
function easy_image_gallery_allowed_post_type() {

	// post and page defaults
	$defaults['post_types']['post'] = 'on';
	$defaults['post_types']['page'] = 'on';

	// get currently viewed post type
	$post_type = ( string ) get_post_type();

	//echo $post_type; exit; // download

	// get the allowed post type from the DB
	$settings = ( array ) get_option( 'easy-image-gallery', $defaults );
	$post_types = isset( $settings['post_types'] ) ? $settings['post_types'] : '';

	// post types don't exist, bail
	if ( ! $post_types )
		return;

	// check the two against each other
	if ( array_key_exists( $post_type, $post_types ) )
		return true;
}


/**
 * Retrieve attachment IDs
 *
 * @since 1.0
 * @return string
 */
function easy_image_gallery_get_image_ids() {
	global $post;

	if( ! isset( $post->ID) )
		return;

	$attachment_ids = get_post_meta( $post->ID, '_easy_image_gallery', true );
	$attachment_ids = explode( ',', $attachment_ids );

	return array_filter( $attachment_ids );
}


/**
 * Shortcode
 *
 * @since 1.0
 */

function easy_image_gallery_shortcode() {

	// return early if the post type is not allowed to have a gallery
	if ( ! easy_image_gallery_allowed_post_type() )
		return;

	return easy_image_gallery();
}
add_shortcode( 'easy_image_gallery', 'easy_image_gallery_shortcode' );


/**
 * Count number of images in array
 *
 * @since 1.0
 * @return integer
 */
function easy_image_gallery_count_images() {

	$images = get_post_meta( get_the_ID(), '_easy_image_gallery', true );
	$images = explode( ',', $images );

	$number = count( $images );

	return $number;
}


/**
 * Output gallery
 *
 * @since 1.0
 */
function easy_image_gallery() {

	$attachment_ids = easy_image_gallery_get_image_ids();

	global $post;

	if ( $attachment_ids ) { ?>

    <?php

		$has_gallery_images = get_post_meta( get_the_ID(), '_easy_image_gallery', true );

		if ( !$has_gallery_images )
			return;

		// convert string into array
		$has_gallery_images = explode( ',', get_post_meta( get_the_ID(), '_easy_image_gallery', true ) );

		// clean the array (remove empty values)
		$has_gallery_images = array_filter( $has_gallery_images );

		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'feature' );
		$image_title = esc_attr( get_the_title( get_post_thumbnail_id( $post->ID ) ) );

		// css classes array
		$classes = array();

		// thumbnail count
		$classes[] = $has_gallery_images ? 'thumbnails-' . easy_image_gallery_count_images() : '';

		// linked images
		$classes[] = easy_image_gallery_has_linked_images() ? 'linked' : '';

		$classes = implode( ' ', $classes );

		ob_start();
?>

    <ul class="image-gallery <?php echo $classes; ?>">
    <?php
		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'popup' );

			// get original image
			$image_link	= wp_get_attachment_image_src( $attachment_id, apply_filters( 'easy_image_gallery_linked_image_size', 'large' ) );
			$image_link	= $image_link[0];	

			$image = wp_get_attachment_image( $attachment_id, apply_filters( 'easy_image_gallery_thumbnail_image_size', 'thumbnail' ), '', array( 'alt' => trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ) ) );

			$image_caption = get_post( $attachment_id )->post_excerpt ? esc_attr( get_post( $attachment_id )->post_excerpt ) : '';

			$image_class = esc_attr( implode( ' ', $classes ) );

			$lightbox = easy_image_gallery_get_lightbox();

			$rel = easy_image_gallery_count_images() > 1 ? 'rel="'. $lightbox .'[group]"' : 'rel="'. $lightbox .'"';

			if ( easy_image_gallery_has_linked_images() )
				$html = sprintf( '<li><a %s href="%s" class="%s" title="%s"><i class="icon-view"></i><span class="overlay"></span>%s</a></li>', $rel, $image_link, $image_class, $image_caption, $image );
			else
				$html = sprintf( '<li>%s</li>', $image );

			echo apply_filters( 'easy_image_gallery_html', $html, $rel, $image_link, $image_class, $image_caption, $image, $attachment_id, $post->ID );
		}
?>
    </ul>

    <?php
		$gallery = ob_get_clean();

		return apply_filters( 'easy_image_gallery', $gallery );
	?>

    <?php }
}

/**
 * Append gallery images to page automatically
 *
 * @since 1.0
 */
function easy_image_gallery_append_to_content( $content ) {

	if ( is_singular() && is_main_query() && easy_image_gallery_allowed_post_type() ) {
		$new_content = easy_image_gallery();
		$content .= $new_content;
	}

	return $content;

}
add_filter( 'the_content', 'easy_image_gallery_append_to_content' );


/**
 * Remove the_content filter if shortcode is detected on page
 *
 * @since 1.0
 */
function easy_image_gallery_template_redirect() {

	if ( easy_image_gallery_has_shortcode( 'easy_image_gallery' ) )
		remove_filter( 'the_content', 'easy_image_gallery_append_to_content' );

}
add_action( 'template_redirect', 'easy_image_gallery_template_redirect' );

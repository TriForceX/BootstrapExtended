<?php

/**
 * Post order.
 *
 * @since 1.0
 */
class Anything_Order_Post extends Anything_Order_Base {

	/**
	 * @var string Current term slug
	 *
	 * @since 1.2.1
	 */
	protected $term;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		parent::__construct( array(
			'pagenow'       => 'edit',
			'objectnow'     => 'typenow',
			'inline_editor' => 'inlineEditPost',
			'query_var'     => 'post_type',
		) );

		add_filter( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
	}

	/**
	 * Hook: add hook for modify orderby clause on admin screen and the public site. Add different hook based on current term.
	 *
	 * @since 1.0.0
	 * @see WP_Query::get_posts()
	 *
	 * @param WP_Query &$q The WP_Query instance (passed by reference).
	 */
	public function pre_get_posts( &$q ) {

		$this->term = $this->get_current_term( $q );

		// Run if not term in query
		add_filter( 'posts_orderby', array( $this, 'posts_orderby' ) );

		// Run if term in query
		add_filter( 'posts_fields', array( $this, 'posts_fields' ) );
		add_filter( 'posts_join', array( $this, 'posts_join' ) );
		add_filter( 'posts_orderby', array( $this, 'posts_orderby_term' ) );


	}

	/**
	 * Hook: Modify order by clause for not tax page (for example shop page or listing all product in admin).
	 *
	 * @since 1.0.0
	 * @see WP_Query::get_posts()
	 *
	 * @param string $orderby Order by clause.
	 *
	 * @return string
	 */
	public function posts_orderby( $orderby ) {
		global $wpdb;
		if ( $this->do_order()
		     && ! $this->term
		     && false === strpos( $orderby, 'menu_order' )
		) {
			$orderby = "$wpdb->posts.menu_order ASC,$orderby";
		}

		return $orderby;
	}

	/**
	 * Hook: Modify select clause.
	 *
	 * @since 1.0.0
	 * @see WP_Query::get_posts()
	 *
	 * @param string $fields Selected post fields.
	 *
	 * @return string
	 */
	public function posts_fields( $fields ) {
		if ( $this->do_order() && $this->term ) {
			$fields .= ', CAST(m1.meta_value AS UNSIGNED) AS post_order_int';
		}

		return $fields;
	}

	/**
	 * Hook: Modify join clause.
	 *
	 * @since 1.0.0
	 * @see WP_Query::get_posts()
	 *
	 * @param string $join Joined tables.
	 *
	 * @return string
	 */
	public function posts_join( $join ) {
		global $wpdb;

		if ( $this->do_order() && $this->term ) {

			$join .= " LEFT JOIN $wpdb->postmeta m1 ON
         ({$wpdb->posts}.ID = m1.post_id AND m1.meta_key = '_order_{$this->term}')";

		}

		return $join;
	}

	/**
	 * Hook: Modify orderby clause for tax page.
	 *
	 * @since 1.0.0
	 * @see WP_Query::get_posts()
	 *
	 * @param string $orderby Orderby clause.
	 *
	 * @return string
	 */
	public function posts_orderby_term( $orderby ) {

		if ( $this->do_order() && $this->term ) {
			$orderby = "COALESCE(post_order_int, ~0) ASC,$orderby";
		}

		return $orderby;
	}

	/**
	 * Capability for ordering.
	 *
	 * @since 1.0.0
	 */
	protected function cap() {
		$post_type_object = get_post_type_object( $GLOBALS[ $this->objectnow ] );

		if ( ! $post_type_object ) {
			wp_die( __( 'Invalid post type', 'any-order' ) );
		}

		return $post_type_object->cap->edit_others_posts;
	}

	/**
	 * Manage a column for ordering.
	 *
	 * @since 1.0.0
	 *
	 * @param object $screen Current screen.
	 */
	protected function manage_column( $screen ) {
		add_filter( "manage_{$screen->post_type}_posts_columns", array( $this, 'get_columns' ) );
		add_action( "manage_{$screen->post_type}_posts_custom_column", array( $this, 'render_column' ), 10, 2 );
	}

	/**
	 * Hook: Render a column for ordering.
	 *
	 * @since 1.0.0
	 */
	public function render_column( $column_name, $post_id ) {

		if ( 'anything-order' == $column_name ) {

			$post       = get_post( $post_id );
			$post_order = $post->menu_order;

			echo $this->_render_column( $post_id, $post_order );
		}
	}

	/**
	 * Update order.
	 *
	 * @since 1.0.0
	 *
	 * @param array $ids Object IDs to update order.
	 * @param int $order The number to start ordering.
	 * @param string $objectnow Current screen object name.
	 * @param string $term Edited term on admin screen.
	 *
	 * @return bool Set order or reset?
	 */
	protected function _update( $ids, $order, $objectnow, $term ) {
		global $wpdb;
		if ( empty( $ids ) ) {
			if ( empty( $term ) ) {
				$wpdb->update(
					$wpdb->posts, array( 'menu_order' => 0 ), array( 'post_type' => $objectnow )
				);
			} else {
				delete_post_meta_by_key( "_order_$term" );
			}

			return false;
		} else {
			if ( empty( $term ) ) {
				foreach ( $ids as $id ) {
					if ( 0 < $id ) {
						$wpdb->update(
							$wpdb->posts, array( 'menu_order' => $order ++ ), array( 'ID' => $id )
						);
					}
				}
			} else {
				foreach ( $ids as $id ) {
					if ( 0 < $id ) {
						update_post_meta( $id, "_order_$term", $order ++ );
					}
				}
			}
		}

		return true;
	}

}

new Anything_Order_Post();

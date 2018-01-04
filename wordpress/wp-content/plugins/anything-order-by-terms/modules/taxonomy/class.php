<?php
/**
 * Taxonomy order.
 *
 * @since 1.0
 */
class Anything_Order_Taxonomy extends Anything_Order_Base
{
    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        parent::__construct(array(
            'pagenow' => 'edit-tags',
            'objectnow' => 'taxnow',
            'inline_editor' => 'inlineEditTax',
            'query_var' => 'taxonomy',
        ));

        add_filter('terms_clauses', array($this, 'terms_clauses'), 10, 2);

    }

     /**
      * Filter the terms query SQL clauses.
      *
      * @since 1.0.0
      * @see get_terms()
      *
      * @param array        $pieces     Terms query SQL clauses.
      * @param array $taxonomies An array of taxonomies.
      */
     public function terms_clauses($pieces, $taxonomies)
     {
        global $wpdb;


        $taxonomy = $taxonomies[0];
	    $taxonomy_object = get_taxonomy( $taxonomy );

	  //  var_dump($taxonomy);

            if ( $this->do_order()
                 && $taxonomy_object
                 && $taxonomy_object->show_ui
            ) {
	            $pieces['fields' ] .= ', CAST(ant_tm.meta_value AS UNSIGNED) AS term_order_int';
	            $pieces['join'   ] .= " LEFT JOIN {$wpdb->termmeta} AS ant_tm ON (t.term_id = ant_tm.term_id AND ant_tm.meta_key = '_order_{$taxonomy}') ";

	            $orderby = 'ORDER BY COALESCE(term_order_int, ~0) ASC';

	            if ( $pieces['orderby'] ) {
		            $pieces['orderby'] = str_replace( 'ORDER BY', $orderby . ',', $pieces['orderby'] );
	            } else {
		            $pieces['orderby'] = $orderby;
		            $pieces['order'] = '';
	            }

            }

	     return $pieces;
     }

    /**
     * Capability for ordering.
     *
     * @since 1.0.0
     */
    protected function cap()
    {
        $tax = get_taxonomy($GLOBALS[$this->objectnow]);

        if (!$tax) {
            wp_die(__('Invalid taxonomy', 'any-order'));
        }

        return $tax->cap->manage_terms;
    }

    /**
     * Manage a column for ordering.
     *
     * @since 1.0.0
     *
     * @param object $screen Current screen.
     */
    protected function manage_column($screen)
    {
       add_filter("manage_{$screen->id}_columns", array($this, 'get_columns'));
       add_filter("manage_{$screen->taxonomy}_custom_column", array($this, 'render_column'), 10, 3);
    }

    /**
     * Hook: Render a column for ordering.
     *
     * @since 1.0.0
     */
    public function render_column( $output, $column_name, $term_id )
    {
    	if ('anything-order' == $column_name) {
		    $term_order =  get_term_meta($term_id, "_order_{$GLOBALS['taxnow']}", true) ;

    		$output = $this->_render_column($term_id, $term_order);
	    }

	    return $output;

    }

    /**
     * Update order.
     *
     * @since 1.0.0
     *
     * @param array  $ids       Object IDs to update order.
     * @param int    $order     The number to start ordering.
     * @param string $objectnow Current screen object name.
     *
     * @return bool True if updated. False if reset.
     */
    protected function _update($ids, $order, $objectnow, $term)
    {
	    if (empty($ids)) {

		    delete_metadata( 'term', null, "_order_$objectnow", '', true );

	    	return false;
	    } else {

		    foreach ( $ids as $id ) {
			    if ( 0 < $id ) {
				    update_term_meta( $id, "_order_$objectnow", $order ++ );
			    }
		    }

	    	return true;
	    }
    }
}

new Anything_Order_Taxonomy();

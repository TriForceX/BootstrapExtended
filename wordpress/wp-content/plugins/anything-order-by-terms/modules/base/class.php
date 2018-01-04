<?php
/**
 * Base class.
 *
 * @since 1.0
 */
abstract class Anything_Order_Base
{
    /**
     * ID or name of this class.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $name = '';

    /**
     * Page now (not include '.php').
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $pagenow = '';

    /**
     * Global variable name of current screen object.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $objectnow = '';


    /**
     * Name of the inline editor.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $inline_editor = '';

    /**
     * Query variable.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $query_var = '';

    /**
     * Error object.
     *
     * @since 1.0.0
     *
     * @var WP_Error
     */
    protected $error = null;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    protected function __construct($args = array())
    {
        $class = get_class($this);
        $keys = array_keys(get_class_vars($class));

        foreach ($keys as $key) {
            if (isset($args[ $key ])) {
                $this->$key = $args[ $key ];
            }
        }

        $this->name = str_replace('Anything_Order_', '', $class);

        if (!empty($this->pagenow)) {
            add_action("admin_print_styles-{$this->pagenow}.php", array($this, 'admin_print_styles'));
            add_action("admin_print_scripts-{$this->pagenow}.php", array($this, 'admin_print_scripts'));
        }

        add_action('admin_init', array($this, 'set_current_screen'));
        add_action('current_screen', array($this, 'current_screen'));

        add_action("wp_ajax_Anything_Order/update/{$this->name}", array($this, 'update'));
    }

	/**
	 * Order enable on front or on admin page unset order set via $_GET var.
	 *
	 * @since 1.2.0
	 *
	 * @return bool Is enable ordering?
	 */
	protected function do_order() {
    	return apply_filters("Anything_Order/do_order/{$this->name}",
		    !is_admin()
		    || (is_admin()
		        && !isset($_GET['orderby'])
		    )
	    );
    }


    /**
     * Get an ID for the class.
     *
     * @since 1.0.0
     *
     * @return string
     */
    protected function get_id($suffix = '')
    {
        $id = strtolower(get_class($this));

        if (!empty($suffix)) {
            $id .= "_$suffix";
        }

        return $id;
    }

    /**
     * Hook: Set current screen.
     *
     * @since 1.0.0
     */
    public function set_current_screen()
    {
        if (defined('DOING_AJAX') && isset($_POST['screen_id'])) {
            convert_to_screen($_POST['screen_id'])->set_current_screen();
        }
    }

    /**
     * Hook: Add hooks depend on current screen.
     *
     * @since 1.0.0
     *
     * @param object $screen Current screen.
     */
    public function current_screen($screen)
    {
	    if (!apply_filters("Anything_Order/do_order/{$this->name}", true)) {
		    return;
	    }

        if (get_current_screen()->base != $this->pagenow) {
            return;
        }

        if (!current_user_can(apply_filters("Anything_Order/cap/{$this->name}", $this->cap(), $screen))) {
            return;
        }

        $this->manage_column($screen);
    }

    /**
     * Capability for ordering.
     *
     * @since 1.0.0
     */
    abstract protected function cap();

    /**
     * Manage a column for ordering.
     *
     * @since 1.0.0
     *
     * @param object $screen Current screen.
     */
    abstract protected function manage_column($screen);

    /**
     * Hook: Prepend a column for ordering to columns.
     *
     * @since 1.0.0
     */
    public function get_columns($columns)
    {
        $title = sprintf(
            '<a href="%1$s">'.
            '<span class="dashicons dashicons-sort"></span>'.
            '</a>'.
            '<span class="title">%2$s</span>'.
            '<span class="anything-order-actions"><a class="reset">%3$s</a></span>',
            esc_url($this->get_url()),
            esc_html__('Order', 'any-order'),
            esc_html__('Reset', 'any-order')
        );

        return array('anything-order' => $title) + $columns;
    }


    /**
     * Retirive HTML for a column.
     *
     * @since 1.0.0
     */
    protected function _render_column( $id, $order)
    {
        return sprintf(
	        '<span class="hidden anything-order-id">%1$s</span>'.
	        '<span class="hidden anything-order-order">%2$s</span>',
	        absint( $id ),
	        absint( $order )
        );
    }

    /**
     * Retrieve the url of an admin page.
     *
     * @since 1.0.0
     */
    protected function get_url()
    {
        return add_query_arg($this->query_var, $GLOBALS[$this->objectnow], admin_url("{$this->pagenow}.php"));
    }


	/**
	 * Retrieve term on admin or front page from WP_Tax_Query.
	 *
	 * @since 1.1.6
	 *
	 * @param $q WP_Query Current or global instance.
	 *
	 * @see WP_Tax_Query
	 * @see $wp_query
	 *
	 * @return string Term on admin or front page.
	 */
	protected function get_current_term( $q = null) {
		global $wp_query;

		$term = '';

		$q = !is_null( $q ) ? $q : $wp_query;

	    $queries = !empty($q->tax_query) ? $q->tax_query->queries : '';

	    if ( !empty($queries) && !empty($queries[0]['taxonomy'])) {
	    	$taxonomy = $queries[0]['taxonomy'];

	    	$taxonomy_object = get_taxonomy( $taxonomy );

	    	// Only if term have ui. Example language taxonomy Polylang.
	    	if ($taxonomy_object && $taxonomy_object->show_ui ) {
			    $term = $queries[0]['terms'][0];
		    }
	    }

	    return $term;
    }


    /**
     * Hook: Enqueue styles.
     *
     * @since 1.0.0
     */
    public function admin_print_styles()
    {
        wp_enqueue_style($this->get_id('style'), plugin_dir_url(__FILE__).'style.css', array(), false, 'all');
    }

    /**
     * Hook: Enqueue scripts.
     *
     * @since 1.0.0
     */
    public function admin_print_scripts()
    {
	    global $wp_query;

        wp_enqueue_script($this->get_id('script'), plugin_dir_url(__FILE__).'script.js', array('jquery-ui-sortable'), false, true);

        $params = apply_filters("Anything_Order/ajax_params/{$this->name}", array(
            '_ajax_nonce' => wp_create_nonce("Anything_Order/update/{$this->name}"),
            'action' => "Anything_Order/update/{$this->name}",
            'inline' => $this->inline_editor,
            'objectnow' => $GLOBALS[$this->objectnow],
			'term' => $this->get_current_term()
        ));

        $texts = array(
            'confirmReset' => __("Are you sure you want to reset order?\n 'Cancel' to stop, 'OK' to reset.", 'any-order'),
        );

        wp_localize_script($this->get_id('script'), 'anythingOrder', array(
            'params' => $params,
            'texts' => $texts,
        ));
    }

    /**
     * Hook: Update order.
     *
     * @since 1.0.0
     */
    final public function update()
    {
        check_ajax_referer("Anything_Order/update/{$this->name}");

        $this->error = new WP_Error();

        $ids = isset($_POST['ids'])
                   ? array_filter(array_map('intval', explode(',', $_POST['ids'])))
                   : array();
        $order = isset($_POST['order']) ? intval($_POST['order']) : 0;
        $objectnow = isset($_POST['objectnow']) ? $_POST['objectnow'] : '';
        $term = isset($_POST['term']) ? $_POST['term'] : '';

        if (!$order) {
            $this->error->add(
                'invalid_order',
                __('Invalid ordering number is posted.', 'any-order')
            );
        }

        $msgs = $this->error->get_error_messages();

        if (empty($msgs)) {
            $redirect = $this->_update($ids, $order, $objectnow, $term)
                      ? ''
                      : $this->get_url();

            echo json_encode(array(
                'status' => 'success',
                'redirect' => $redirect
            ));
        } else {
            echo json_encode(array(
                'status' => 'error',
                'message' => implode('<br>', $msgs),
            ));
        }

        wp_die();
    }

    /**
     * Update order.
     *
     * @since 1.0.0
     *
     * @param array  $ids       Object IDs to update order.
     * @param int    $order     The number to start ordering.
     * @param string $objectnow Current screen object name.
     * @param string $term Edited term on admin screen.
     * @param string $taxonomy Edited taxonomy on admin screen.
     *
     * @return bool True if updated. False if reset.
     */
    abstract protected function _update($ids, $order, $objectnow, $term);
}

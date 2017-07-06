<?php
/*
Plugin Name: Advanced Order
Description: Плагин добавляет функционал для сортировки записей и таксономий, как встроенных так и произвольных.
Version: 2.0
Author: c0ns0l3
*/

if ( ! function_exists( 'add_filter' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit();
}
global $a_order;
$a_order = new AdvancedOrder();

if (!defined('A_ORDER_URL')) define( 'A_ORDER_URL', plugins_url('', __FILE__) );
if (!defined('A_ORDER_DIR')) define( 'A_ORDER_DIR', plugin_dir_path(__FILE__) );


/**
 * Class ADK_TermsOrder
 */


class AdvancedOrder {

    protected $plugin_name = 'Advanced Order';
    private $plugin_options = array(
        'taxonomies_proceed'    => null,
        'posts_proceed'         => null,
        'debug_column'          => null,
        'notice_suppress'       => false
    );

    /**
     * Переменные для изменения
     */
    private $order_meta_value_terms = 'term_order';
    private $oder_term_override_defaults = true;


    public function __construct () {
        $this->plugin_options = $this->get_options();

        register_activation_hook(   __FILE__,   array(&$this,'plugin_activation')       );
        register_deactivation_hook( __FILE__,   array(&$this,'plugin_deactivation')     );
        register_uninstall_hook(    __FILE__,   array(&$this,'plugin_uninstall')        );

        /**
         * @see register_admin_hooks
         */
        add_action('admin_init',array(&$this,'register_admin_hooks'));
        /**
         * @see register_global_hooks
         */
        add_action('init',      array(&$this,'register_global_hooks'));
        /**
         * @see wp_admin_menu_settings
         */
        add_action('admin_menu',array(&$this,'wp_admin_menu_settings'));
        /**
         * @see wp_admin_notices
         */
        add_action('admin_notices', array(&$this,'wp_admin_notices'));
    }

    public function plugin_activation() {}
    public function plugin_deactivation() {}
    public function plugin_uninstall() {
        if( ! defined('WP_UNINSTALL_PLUGIN') )
            exit;
    }

    /**
     * Возвращает настройки плагина
     * @return mixed|void
     */
    private function get_options() {
        return get_option('advanced_order',array(
            'taxonomies_proceed' => array(),
            'posts_proceed' => array(),
            'notice_suppress' => false
        ));

    }
    /**
     * Коллбеки для Админки
     */
    public function register_admin_hooks() {
        $this->admin_require_css_js();
        $this->admin_manage_columns();


        /**
         * @see wp_terms_clause
         */
        add_filter( 'terms_clauses', array(&$this,'wp_terms_clause'),10, 3 );
        /**
         * @see wp_update_order
         */
        add_action( 'wp_ajax_a_order/update_order', array( &$this, 'wp_update_order' ) );

        /**
         * @see wp_disable_notice
         */
        add_action('wp_ajax_a_order/disable_notice', array(&$this, 'wp_disable_notice'));

        /**
         * @see wp_plugin_action_links
         */
        add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( &$this, 'wp_plugin_action_links') );



    }


    /**
     * Коллбеки Глобальные
     */
    public function register_global_hooks() {
        if($this->oder_term_override_defaults) {
            /**
             * @see wp_terms_clause
             */
            add_filter('terms_clauses', array(&$this, 'wp_terms_clause'), 10, 3);
        }

        /**
         * @see wp_pre_get_posts
         */
        add_action ('pre_get_posts',array(&$this,'wp_pre_get_posts'), 100, 1);
        /**
         * @see wp_create_term
         */
        add_action('created_term', array(&$this, 'wp_create_term'), 100, 3 );
        /**
         * @see wp_delete_term
         */
        add_filter('delete_term',  array(&$this, 'wp_delete_term'), 100, 4 );
        /**
         * @see wp_insert_post_data
         */
        add_action('wp_insert_post_data', array(&$this, 'wp_insert_post_data'), 100, 2);
    }


    /**
     * Изменение сортировки для записей
     *
     * @see register_global_hooks
     * @param $wp_query
     * @return mixed
     */
    public function wp_pre_get_posts ($wp_query) {
        /**
         * Проверка на настроенные типы записей
         */



        if ( $wp_query->query_vars['post_type'] != null && in_array( $wp_query->query_vars['post_type'], $this->plugin_options['posts_proceed'] ) ) {

            if (! $wp_query->query_vars['orderby'] || $wp_query->query_vars['orderby'] == 'date') {
                $wp_query->query_vars['orderby'] = 'menu_order';
                $wp_query->query_vars['order'] = 'desc';
                return $wp_query;
            }

        }



        return $wp_query;
    }

    /**
     * Обработка сортировки ТЕРМОВ
     *
     * @param $pieces
     * @param $taxonomies
     * @param $args
     * @return mixed
     */
    public function wp_terms_clause ( $pieces , $taxonomies, $args ) {
        //TODO: Добавить проверку по нужным нам таксономиям (опции)
        global $wpdb;

        if(
            preg_match( '/^count(\*)/is', $pieces['fields'])
            ||
            $pieces['fields'] == 'COUNT(*)'
        )   return $pieces;


        $pieces['join'] .= " LEFT OUTER JOIN $wpdb->termmeta tm
                                    ON t.term_id = tm.term_id
                                    AND tm.meta_key = '{$this->order_meta_value_terms}'
                               ";

        $pieces['fields'] .= ", CAST(tm.meta_value AS UNSIGNED) AS tm_order";

        if (is_admin() && function_exists('get_current_screen') ) {
            if( $_GET['orderby'] != 'name'
                &&
                get_current_screen()
            ) {
                $pieces['orderby'] = str_replace('t.name','tm_order',$pieces['orderby']);
                $pieces['order'] = 'DESC';
            }
        } else {
            $pieces['orderby'] = str_replace('t.name','tm_order',$pieces['orderby']);
            $pieces['order'] = 'DESC';
        }


        return $pieces;
    }

    /**
     * @see __construct
     * Добавление настроек страницы
     */
    public function wp_admin_menu_settings () {
        add_options_page(__('Настйроки для ').$this->plugin_name, $this->plugin_name, 'manage_options', 'advanced-order', array(&$this,'wp_admin_menu_content') );
    }

    /**
     * Загрузка шаблона страницы настроек
     * @see wp_admin_menu_settings
     */
    public function  wp_admin_menu_content () {
        include_once(A_ORDER_DIR.'/options.php');
    }

    /**
     * Добавляем ссылку на "настройки" плагина в список плагинов
     * @param $links
     * @return array
     */
    public function wp_plugin_action_links( $links ) {
        $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=advanced-order') ) .'">'.__('Настройки').'</a>';
        return $links;
    }

    /**
     * Вывод оповещения о не настроенном плагине
     */
    public function wp_admin_notices() {
        $options = $this->get_options();
        $screen = get_current_screen();

        if ( $options['notice_suppress'] == true)
            return;
        if ($screen->id == 'settings_page_advanced-order')
            return;

        if ( count($options['posts_proceed']) || count($options['taxonomies_proceed']))
            return;

        ?>
        <div class="notice notice-warning is-dismissible advanced-order-notice">
            <h3>Advanced Order</h3>
            <p><strong>Внимание!</strong> Вы не настроили типы записей или таксономий для включения сортировки.</p>
            <p>Пожалуйста перейдите в <a href="<?= esc_url(get_admin_url(null, 'options-general.php?page=advanced-order')) ?>">настройки плагина</a> для их активации.</p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>
        <?php
    }

    /**
     * AJAX подавление оповещение о том, что не настроен плагин
     */
    public function wp_disable_notice() {
        $options = $this->get_options();
        $options['notice_suppress'] = true;
        update_option('advanced_order',$options);
        die();
    }
    /**
     * Подключение JS и CSS в Админку
     * @see register_admin_hooks
     */
    private function admin_require_css_js () {
        //TODO: Добавить проверку по нужным нам таксономиям (опции)
        wp_enqueue_script( 'advanced_order-js', A_ORDER_URL.'/js/advanced_order.app.js', array( 'jquery','jquery-ui-sortable' ), null, true );
        wp_localize_script( 'advanced_order-js', 'A_ORDER_JS', array (
            'a_order_nonce' => wp_create_nonce('a_order-nonce_reorder')
        ) );
        wp_enqueue_style ( 'advanced_order-css',    A_ORDER_URL.'/css/advanced_order.css', array(), null );
    }


    /**
     * Фильтр добавляющий колонки
     * и отработки данных в ячейках
     * @see register_admin_hooks
     */
    private function admin_manage_columns() {
        foreach ($this->wp_get_taxonomies() as $taxonomy => $object) {
            if (! in_array( $taxonomy, $this->plugin_options['taxonomies_proceed'])) continue;
            /**
             * @see admin_manage_columns_add
             */
            add_filter('manage_edit-'.$taxonomy.'_columns' ,            array(&$this,'admin_manage_columns_add'),1000);
            /**
             * @see admin_manage_columns_taxonomy_content
             */
            add_action('manage_'.$taxonomy.'_custom_column',            array(&$this,'admin_manage_columns_taxonomy_content'),10, 3 );
        }

        foreach ($this->wp_get_post_types() as $post_type=>$object) {
            if (! in_array( $post_type, $this->plugin_options['posts_proceed'])) continue;
            /**
             * @see admin_manage_columns_add
             */
            add_filter('manage_'.$post_type.'_posts_columns' ,          array(&$this,'admin_manage_columns_add'),1000);
            /**
             * @see admin_manage_columns_post_content
             */
            add_action('manage_'.$post_type.'_posts_custom_column',     array(&$this,'admin_manage_columns_post_content'),10, 2 );

        }
    }

    /**
     * Сам фильтр к колонкам
     * @see admin_manage_columns
     * @param $columns
     * @return array
     */
    public function admin_manage_columns_add ($columns) {
        $columns_start_cb = array_splice($columns,0,1);
        $columns_insert = array ('a_order_drag' => '#');
        $columns = array_merge($columns_start_cb,$columns_insert,$columns);
        $columns['a_order_order'] = '# order';
        return $columns;
    }


    /**
     * Отработка данных в ячейках
     * @see admin_manage_columns
     * @param $r
     * @param $column_name
     * @param $term_id
     */
    public function admin_manage_columns_taxonomy_content($r,$column_name,$term_id) {
        /** @tm_order tm_order $ */
        $term = get_term_by('id',$term_id,get_current_screen()->taxonomy);
        switch ( $column_name ) {
            case 'a_order_drag':
                echo "<div id='a_order_drag-$term->tm_order' class='dashicons dashicons-sort'></div>";
                break;
            case 'a_order_order':
                echo "<p># $term->tm_order</p>";
            default:
                break;
        }
    }

    /**
     * @see admin_manage_columns
     */
    public function admin_manage_columns_post_content ( $column_name, $post_ID ) {
        switch ( $column_name ) {
            case 'a_order_drag':
                $post = get_post($post_ID);
                ?><div id="a_order_drag-<?=$post->menu_order?>" class="dashicons dashicons-sort"></div><?php
                break;
            case 'a_order_order':
                $post = get_post($post_ID);
                echo "<p># $post->menu_order</p>";
            default:
                break;
        }
    }
    /**
     * @see register_global_hooks
     * @param $term_id
     * @param $tt_id
     * @param $taxonomy
     */
    public function wp_create_term($term_id, $tt_id, $taxonomy) {
        $this->cache(false);
        $max = $this->get_max_term_order( $taxonomy );
        add_term_meta($term_id, $this->order_meta_value_terms, $max+1, true);
        $this->cache(true);
    }

    /**
     * @see register_global_hooks
     * @param $term
     * @param $tt_id
     * @param $taxonomy
     * @param $deleted_term
     */
    public function wp_delete_term( $term, $tt_id, $taxonomy, $deleted_term ) {
        delete_term_meta($term, $this->order_meta_value_terms);
    }

    /**
     * @see register_global_hooks
     * @param $data
     * @param $postarr
     * @return mixed
     */
    public function wp_insert_post_data($data, $postarr) {


        if ($data['post_type'] && !in_array($data['post_type'],$this->plugin_options['posts_proceed'])) {
            return $data;
        }


        if( !in_array( $data['post_status'], array('publish', 'pending', 'draft', 'private', 'future') ) )
            return $data;

        if($data['menu_order'] == 0) {
            $max_order = $this->get_max_post_order($data['post_type']);
            $data['menu_order'] = $max_order+1;
        }
        return $data;
    }

    /**
     * @see register_admin_hooks
     */
    public function wp_update_order() {

        /**
         * a_order_taxonomy         -
         * a_order_order_id_data    -
         * a_order_order_data       -
         */

        /**
         * $order_object - объекты, в которых менять сортировку
         * $order_value  - на какие значение менять
         */


        $nonce = check_ajax_referer('a_order-nonce_reorder','security',false);
        if (! $nonce || ! current_user_can('edit_posts')) {
            $this->ajax_error('security deny');
        }

        $order_object = '';
        parse_str($_REQUEST['a_order_order_id_data'], $order_object);
        $order_value = json_decode( str_replace( 'a_order_drag-', '', wp_unslash( $_REQUEST['a_order_order_data'] ) ) );



        if ($order_object['tag']) {
            $order_object = $order_object['tag'];
            $order_type = 'tag';
        } else {
            $order_object = $order_object['post'];
            $order_type = 'post';
        }



        $_order_value = $order_value;
        rsort ($order_value);

        switch ($order_type) {
            case 'tag':
                    $terms = get_terms($_REQUEST['a_order_taxonomy'],array (
                        'hide_empty'=> false,
                        'include' => $order_object
                    ));
                    if (count($terms) != count($order_object))
                        return;

                    foreach ($order_object as $id=>$object) {
                        $this->cache(false);
                        update_term_meta($object,$this->order_meta_value_terms,$order_value[$id]);
                        $this->cache(true);
                    }
                break;
            case 'post':
                global $wpdb;
                foreach ($order_object as $id=>$object) {
                    $sql = "UPDATE $wpdb->posts SET menu_order = %d WHERE ID = %d";
                    $sql = $wpdb->prepare($sql, $order_value[$id], $object);

                    $this->cache(false);
                    $wpdb->get_col ($sql);
                    $this->cache(true);
                }

                break;
        }
        die(json_encode(new stdClass()));

    }

    /**
     * Возврат сообщения об ошибке во время AJAX запроса
     * @param null $msg
     */
    private function ajax_error($msg = null) {
        die(json_encode(
                array (
                    'error' => $msg
                )
            )
        );
    }

    /**
     * Получаем маскимальное число для сортировки в термах
     * @param $taxonomy
     * @return int|null|string
     */
    private function get_max_term_order($taxonomy) {
        global $wpdb;
        $this->cache(false);
        $max_order = $wpdb->get_var("SELECT MAX(CAST(tm.meta_value AS UNSIGNED))
                                        FROM $wpdb->terms t
                                          INNER JOIN $wpdb->term_taxonomy tt
                                            ON t.term_id = tt.term_id
                                          LEFT OUTER JOIN $wpdb->termmeta tm
                                            ON t.term_id = tm.term_id
                                            AND tm.meta_key = '{$this->order_meta_value_terms}'
                                        WHERE tt.taxonomy IN ('$taxonomy')
        ");

        $this->cache(true);
        if($max_order) return $max_order;
        return 0;
    }

    /**
     * Получаем максимальное число для сортирвки в постах
     * @param $post_type
     * @return int|null|string
     */
    private function get_max_post_order($post_type) {
        global $wpdb;
        $this->cache(false);
        $max_order = $wpdb->get_var("
                SELECT
                  MAX($wpdb->posts.menu_order) AS max_order
                FROM $wpdb->posts
                  WHERE $wpdb->posts.post_type = '$post_type'
                AND post_status IN ('publish', 'pending', 'draft', 'private', 'future')
        ");
        $this->cache(true);
        if($max_order) return $max_order;
        return 0;
    }

    /**
     * Получаем все таксномии
     * @return array
     */
    private function wp_get_taxonomies() {
        $taxanomies = get_taxonomies( array (
            'public' => true
        ), 'objects' );
        unset($taxanomies['post_format']);
        return $taxanomies;
    }

    /**
     * Получаем фильтрованный список всех типаов записей
     * @return array [@object]
     */
    public function wp_get_post_types() {
        $post_types = get_post_types( array (
            'public' => true

        ), 'objects' );
        unset($post_types['attachment']);
        return $post_types;
    }

    /**
     * Получаем список термов, в которых нету сортировки
     * используется при включении плагина и настройках его
     * @param $taxonomy
     * @return array|null|object
     */
    private function wp_get_unordered_terms($taxonomy) {
        global $wpdb;

        $sql = "SELECT
                  t.term_id
                FROM $wpdb->terms t
                  INNER JOIN $wpdb->term_taxonomy tt
                    ON t.term_id = tt.term_id
                  LEFT OUTER JOIN $wpdb->termmeta tm
                    ON t.term_id = tm.term_id
                    AND tm.meta_key = '$this->order_meta_value_terms'
                WHERE tt.taxonomy IN (%s) AND tm.meta_value IS NULL  OR tm.meta_value = '0'";

        $this->cache(false);
        return $wpdb->get_results( $wpdb->prepare($sql, $taxonomy) );
        $this->cache(true);
    }

    /**
     * Получаем список постов, в которых нету сортировки
     * используется при включении плагина и настройках его
     * @param $post_type
     * @return null|string
     */
    private function wp_get_unordered_posts ($post_type) {
        global $wpdb;

        $sql = "SELECT
                  $wpdb->posts.ID
                FROM $wpdb->posts
                WHERE $wpdb->posts.menu_order <= 0
                AND $wpdb->posts.post_type = %s";
        $this->cache(false);
        return $wpdb->get_results( $wpdb->prepare($sql, $post_type) );
        $this->cache(true);
    }

    /**
     * Включает или выключает кеширование
     * @param $bool
     */
    private function cache ($bool) {
        define('WP_OBJECT_CACHE', $bool );
        define('DONOTCACHEDB', !$bool);
    }
}
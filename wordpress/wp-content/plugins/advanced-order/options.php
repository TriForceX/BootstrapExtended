<?php
/**
 * Created by PhpStorm.
 * User: c0ns0l3
 * Date: 14.01.2016
 * Time: 19:12
 */

/**
 * Производится сохранение опций
 * @package AdvancedOrder
 * @var AdvancedOrder $this
 */
if( isset ($_POST['proceed_save_options']) ) {

    $taxonomies_proceed = wp_parse_args($_POST['taxonomies_proceed'],array() );
    $posts_proceed      = wp_parse_args($_POST['posts_proceed'],array() );

    $this->plugin_options['taxonomies_proceed'] = $taxonomies_proceed;
    $this->plugin_options['posts_proceed'] = $posts_proceed;
    $this->plugin_options['notice_suppress'] = false;

    update_option('advanced_order',$this->plugin_options);



    $this->cache (false);

    foreach ($taxonomies_proceed as $taxonomy) {
        $count_of_ordered = $this->wp_get_unordered_terms($taxonomy);

        if ( count ($count_of_ordered ) > 0) {
            $_info_update_terms[] = $taxonomy;
            $max_term_order = $this->get_max_term_order ($taxonomy);

            foreach ($count_of_ordered as $object) {
                $max_term_order++;
                $meta_add = add_term_meta($object->term_id, $this->order_meta_value_terms, $max_term_order, true);
                if ( ! $meta_add ) {
                    $meta_updated = update_term_meta($object->term_id, $this->order_meta_value_terms, $max_term_order);
                }

            }
        }
    }

    foreach ($posts_proceed as $post_type) {
        $count_of_ordered = $this->wp_get_unordered_posts ($post_type);
        if ( count ($count_of_ordered) > 0) {
            global $wpdb;
            $_info_update_posts[] = $post_type;
            $max_posts_order = $this->get_max_post_order ($post_type);

            foreach ($count_of_ordered as $post_ID) {
                $max_posts_order++;
                $sql = "UPDATE $wpdb->posts SET menu_order = %d WHERE ID = %d";
                $sql = $wpdb->prepare($sql, $max_posts_order, $post_ID->ID);
                $wpdb->get_col ($sql);
            }
        }
    }
    $this->cache(true);
}
?>

<div class="wrap">
    <h1><?=__('Настройки плагина Advanced Order','advanced-order')?></h1>
    <?php if (count ($_info_update_terms)> 0 || count ($_info_update_posts)> 0):?>
    <div id="message" class="updated notice is-dismissible">
        <?php if (count ($_info_update_terms)> 0) : foreach ($_info_update_terms as $_info_term):?>
            <p>
                <?=__('Добавлены стартовые данные сортировки для таксономии:','advanced-order')?> <strong><?=$_info_term?></strong>.
            </p>
        <?php endforeach; endif; ?>

        <?php if (count ($_info_update_posts)> 0) : foreach ($_info_update_posts as $_info_post):?>
            <p>
                <?=__('Добавлены стартовые данные сортировки для типа записей:','advanced-order')?> <strong><?=$_info_post?></strong>.
            </p>
        <?php endforeach; endif; ?>

        <button type="button" class="notice-dismiss">
            <span class="screen-reader-text">
                <?=__('Скрыть это уведомление.','advanced-order')?>
            </span>
        </button>
    </div>
    <?php endif;?>
    <form action="" method="POST">
        <input type="hidden" name="proceed_save_options" value="true">
        <div class="card">
            <h3>
                <?=__('Выбор таксономий, с которыми работать','advanced-order')?>
            </h3>
            <div class="a-order_list_tax">

                <?php
                   $taxanomies = $this->wp_get_taxonomies();
                    foreach ($taxanomies as $taxonomy) {
                        ?>
                        <p>
                            <label for="check_tax-<?=$taxonomy->name?>">
                                <input name="taxonomies_proceed[]"
                                       type="checkbox"
                                       id="check_tax-<?=$taxonomy->name?>"
                                       value="<?=$taxonomy->name?>"
                                       <?=( in_array($taxonomy->name, $this->plugin_options['taxonomies_proceed']) ) ? 'checked' : ''?>
                                >
                                <?=$taxonomy->labels->name?> (<?=$taxonomy->name?>)
                            </label>
                        </p>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div class="card">
            <h3>
                <?=__('Выбор типов записей, с которыми работать','advanced-order')?>
            </h3>

            <?php
                $posts_order = $this->wp_get_post_types();
                foreach ($posts_order as $_post) {
                    ?>
                    <p>
                        <label for="check_tax-<?=$_post->name?>">
                            <input name="posts_proceed[]"
                                   type="checkbox"
                                   id="check_tax-<?=$_post->name?>"
                                   value="<?=$_post->name?>"
                                <?=( in_array($_post->name, $this->plugin_options['posts_proceed']) ) ? 'checked' : ''?>
                                >
                            <?=$_post->labels->name?> (<?=$_post->name?>)
                        </label>
                    </p>
                    <?php
                }
            ?>
        </div>
        <!--
        <div class="card">
            <h3>
                <?=__('Отладка','advanced-order')?>
            </h3>
            <div class="a-order_list_tax">
                <p>
                    <label for="debug_check">
                        <input
                            type="checkbox"
                            id="debug_check"
                            value="1"
                        >
                        Debug?
                    </label>
                </p>
            </div>
        </div>
        -->
        <p>
            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?=__('Сохранить изменения','advanced-order')?>">
        </p>
    </form>
</div>

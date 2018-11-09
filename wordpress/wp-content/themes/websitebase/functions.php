<?php

//Get the main PHP utilities
require_once('resources.php');

/*
 * Wordpress Main Stuff
 * 
 * You can enable/disable Wordpress stuff or add more functions
 * More resources in https://codex.wordpress.org
 * 
 */

/*
 * Enable post support
 * Info: https://developer.wordpress.org/reference/functions/add_theme_support
 */
/*
add_theme_support('post-formats');
add_theme_support('post-thumbnails');
add_theme_support('html5');
add_theme_support('custom-logo');
add_theme_support('custom-header-uploads');
add_theme_support('custom-header');
add_theme_support('custom-background');
add_theme_support('title-tag');
add_theme_support('starter-content');
*/

/* 
 * Enable post type support
 * Info: https://developer.wordpress.org/reference/functions/add_theme_support
 */
/*
add_post_type_support('page', 'title');
add_post_type_support('page', 'editor');
add_post_type_support('page', 'author');
add_post_type_support('page', 'thumbnail');
add_post_type_support('page', 'excerpt');
add_post_type_support('page', 'trackbacks');
add_post_type_support('page', 'custom-fields');
add_post_type_support('page', 'comments');
add_post_type_support('page', 'revisions');
add_post_type_support('page', 'page-attributes');
add_post_type_support('page', 'post-formats');
*/

/*
 * Remove items from adminbar
 * Info: https://codex.wordpress.org/Function_Reference/remove_node
 */
/*
function remove_from_adminbar($wp_admin_bar) 
{
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('comments');
	$wp_admin_bar->remove_node('new-post');
	$wp_admin_bar->remove_node('new-page');
	$wp_admin_bar->remove_node('new-media');
	$wp_admin_bar->remove_node('new-content');
	$wp_admin_bar->remove_node('archive');
}
add_action('admin_bar_menu', 'remove_from_adminbar', 999);
*/

/*
 * Remove dashboard widgets
 * Info: https://codex.wordpress.org/Function_Reference/remove_meta_box
 */
/*
function remove_dashboard_widgets() 
{
	//General
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );   // Right Now
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); // Recent Comments
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );  // Incoming Links
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );   // Plugins
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );  // Quick Press
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );  // Recent Drafts
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );   // WordPress blog
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );   // Other WordPress News
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); //Activity
	
	//Example by user role: Remove 'Simple History' Plugin widget
	if(!current_user_can('administrator')){
		remove_meta_box('simple_history_dashboard_widget', 'dashboard', 'normal'); 
	}
	
	//Example by user role: Remove 'Simple History' Plugin widget
	if($user && isset($user->user_login) && 'user' == $user->user_login){
		remove_meta_box('simple_history_dashboard_widget', 'dashboard', 'normal'); 
	}
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
*/

/*
 * Posts data based on content type
 * Info: Set post type properties before load, useful to enable paged post type
 */
/*
function custom_posts_per_page($query)
{
	if(!is_admin())
	{
        switch ($query->query_vars['post_type'])
        {
            case 'custom_post_type_slug':
                $query->query_vars['posts_per_page'] = 6;
                $query->query_vars['order'] = 'DESC';
                $query->query_vars['orderby'] = 'date';
                break;
        }
        return $query;
    }
}
add_filter('pre_get_posts', 'custom_posts_per_page');
*/

/* 
 * Custom theme mods shortcut
 * Usage: get_theme_mod2('slug');
 */
/*
//Customize Theme Text Field
$customize_theme_fields['field-text'] = array(
	'panel'		=>	'',
	'type'		=>	'text',
	'title'		=>	'Field Text Button Title',
	'desc'		=>	'Field Text Desctription',
	'label'		=>	'Field Text Label Title',
	'default'		=>	'Field Text Default Value'
);
*/
/*
// Customize Theme Text Field
$customize_theme_fields['field-text-area'] = array(
	'panel'		=>	'',
	'type'		=>	'textarea',
	'title'		=>	'Field Text Area Button Title',
	'desc'		=>	'Field Text Area Desctription',
	'label'		=>	'Field Text Area Label Title',
	'default'	=>	'Field Text Area Default Value'
);
*/
/*
// Customize Theme Wysiwig Field
$customize_theme_fields['field-text-wysiwig'] = array(
	'panel'		=>	'',
	'type'		=>	'wysiwig',
	'title'		=>	'Field WYSIWIG Text Button Title',
	'desc'		=>	'Field WYSIWIG Text Desctription',
	'label'		=>	'Field WYSIWIG Text Label Title',
	'default'	=>	'Field WYSIWIG Text Default Value'
);
*/
/*
// Customize Theme Image Field
$customize_theme_fields['field-image'] = array(
	'panel'		=>	'',
	'type'		=>	'image',
	'title'		=>	'Field Image Button Title',
	'desc'		=>	'Field Image Desctription',
	'label'		=>	'Field Image Label Title',
	'default'	=>	get_bloginfo('template_url').'/img/base/favicon/global.png'
);
*/
/*
// Customize Theme File Field
$customize_theme_fields['field-file'] = array(
	'panel'		=>	'',
	'type'		=>	'file',
	'title'		=>	'Field File Button Title',
	'desc'		=>	'Field File Desctription',
	'label'		=>	'Field File Label Title',
	'default'	=>	get_bloginfo('template_url').'/img/base/favicon/global.png'
);
*/
/*
// Customize Theme Checkbox Field
$customize_theme_fields['field-checkbox'] = array(
	'panel'		=>	'',
	'type'		=>	'checkbox',
	'title'		=>	'Field Checkbox Button Title',
	'desc'		=>	'Field Checkbox Desctription',
	'label'		=>	'Field Checkbox Label Title',
	'default'	=>	'option-2', //Default
	'choices'	=>	array('option-1'  => 'Option 1',
						  'option-2'  => 'Option 2')
);
*/
/*
// Customize Theme Radio Field
$customize_theme_fields['field-radio'] = array(
	'panel'		=>	'',
	'type'		=>	'radio',
	'title'		=>	'Field Radio Button Title',
	'desc'		=>	'Field Radio Desctription',
	'label'		=>	'Field Radio Label Title',
	'default'	=>	'option-2', //Default
	'choices'	=>	array('option-1'  => 'Option 1',
						  'option-2'  => 'Option 2')
);
*/
/*
// Customize Theme Select Field
$customize_theme_fields['field-select'] = array(
	'panel'		=>	'',
	'type'		=>	'select',
	'title'		=>	'Field Select Button Title',
	'desc'		=>	'Field Select Desctription',
	'label'		=>	'Field Select Label Title',
	'default'	=>	'option-2', //Default
	'choices'	=>	array('option-1'  => 'Option 1',
						  'option-2'  => 'Option 2')
);
*/

/* 
 * Custom theme mods shortcut
 * Usage: Add the slug as a value of 'panel' in a $customize_theme_fields
 */
/*
//Customize Theme Panel
$customize_theme_panels['custom-panel-1'] = array(
	'priority'       => 10,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => 'Custom Panel 1 Title',
	'description'    => 'Custom Panel 1 Description',
);
*/

/* 
/* Register custom menus
/* Info: https://codex.wordpress.org/Function_Reference/register_nav_menus
 */
/*
function register_custom_menus()
{
	register_nav_menus(
		array(
			'header-menu'	=> __('Header Menu'),
			'extra-menu' 	=> __('Extra Menu')
		)
	);
}
add_action('init', 'register_custom_menus');
*/

/*
 * Register sidebars and widgets
 * Info: https://codex.wordpress.org/Function_Reference/register_sidebar
 */
/*
function custom_widgets_init()
{
	//Sidebar
	register_sidebar(array(
		'name'          => 'Custom Sidebar 1',
		'id'            => 'custom-sidebar-1',
		'description'	=> 'Custom Sidebar Description.',  
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	));
	
	//Widget
	register_widget('custom_widget_1');
}
add_action('widgets_init', 'custom_widgets_init');
*/

/*
 * Custom widget class
 * Info: https://codex.wordpress.org/Widgets_API
 */
/*
class custom_widget_1 extends WP_Widget
{
	function custom_widget_1()
	{
		//process widget
		$widget_options = array(
			'classname'=> 'custom_widget_1_classname',
			'description'=> 'A custom widget 1.',
		);
		$this->WP_Widget('custom_widget_1', 'Custom Widget 1', $widget_options);
	}
	function form($instance)
	{
		//show widget form in admin panel
		$default_settings = array(
			'title' => 'Custom Boxes',
			'cwbox_box_1'=>'',
			'cwbox_box_2'=>'',
			'cwbox_box_3'=>'',
			'cwbox_box_4'=>'',
		);
		$instance = wp_parse_args(
			(array) $instance,
			$default_settings
		);
		$title = $instance['title'];
		$cwbox_box_1 = $instance['cwbox_box_1'];
		$cwbox_box_2 = $instance['cwbox_box_2'];
		$cwbox_box_3 = $instance['cwbox_box_3'];
		$cwbox_box_4 = $instance['cwbox_box_4'];
		
		echo '<p>
				Title: <input class="widefat" name="'.$this->get_field_name('title').'" type="text" value="'.esc_attr($title).'"/>
			</p>
			<p>
				Ads Box 1: <textarea class="widefat" name="'.$this->get_field_name('cwbox_box_1').'">'.esc_attr($cwbox_box_1).'</textarea>
			</p>
			<p>
				Ads Box 2: <textarea class="widefat" name="'.$this->get_field_name('cwbox_box_2').'">'.esc_attr($cwbox_box_2).'</textarea>
			</p>
			<p>
				Ads Box 3: <textarea class="widefat" name="'.$this->get_field_name('cwbox_box_3').'">'.esc_attr($cwbox_box_3).'</textarea>
			</p>
			<p>
				Ads Box 4: <textarea class="widefat" name="'.$this->get_field_name('cwbox_box_4').'">'.esc_attr($cwbox_box_4).'</textarea>
			</p>';
	}
	function update($new_instance, $old_instance)
	{
		//update widget settings
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cwbox_box_1'] = $new_instance['cwbox_box_1'];
		$instance['cwbox_box_2'] = $new_instance['cwbox_box_2'];
		$instance['cwbox_box_3'] = $new_instance['cwbox_box_3'];
		$instance['cwbox_box_4'] = $new_instance['cwbox_box_4'];

		return $instance;
	}
	function widget($args, $instance)
	{
		//display widget
		extract($args);

		echo $before_widget;

		$title = apply_filters('widget_title', $instance['title']);
		$cwbox_box_1 = empty($instance['cwbox_box_1']) ? '' : $instance['cwbox_box_1'];
		$cwbox_box_2 = empty($instance['cwbox_box_2']) ? '' : $instance['cwbox_box_2'];
		$cwbox_box_3 = empty($instance['cwbox_box_3']) ? '' : $instance['cwbox_box_3'];
		$cwbox_box_4 = empty($instance['cwbox_box_4']) ? '' : $instance['cwbox_box_4'];

		if(!empty($title)){ echo $befor_title . $title . $after_title; }
		echo '<ul class="cli_sb_cwbox_boxes">
				<li>'.$cwbox_box_1.'</li>
				<li>'.$cwbox_box_2.'</li>
				<li>'.$cwbox_box_3.'</li>
				<li>'.$cwbox_box_4.'</li>
			</ul>';

		echo $after_widget;
	}
}
*/

/*
 * Edit custom role capabilities
 * Info: https://codex.wordpress.org/Function_Reference/add_cap
 */
/*
function custom_capability()
{
	//Role add
	$role1 = get_role('editor');
	$role1Perms = array('posts');
	
	foreach($role1Perms as $rolePerm1)
	{ 
		$role1->add_cap('publish_'.$role1Perm); 
		$role1->add_cap('edit_'.$role1Perm); 
		$role1->add_cap('delete_'.$role1Perm);
		$role1->add_cap('edit_published_'.$role1Perm); 
		$role1->add_cap('delete_published_'.$role1Perm); 
		$role1->add_cap('edit_others_'.$role1Perm); 
		$role1->add_cap('delete_others_'.$role1Perm); 
		$role1->add_cap('read_private_'.$role1Perm); 
		$role1->add_cap('edit_private_'.$role1Perm);
		$role1->add_cap('delete_private_'.$role1Perm);
		$role1->add_cap('manage_categories_'.$role1Perm); 	
	}
	
	//Individual add
	if(!$role1->has_cap('edit_theme_options')){
		$role1->add_cap('edit_theme_options'); 
	}
	
	//Individual remove
	if($role1->has_cap('edit_theme_options')){
		$role1->remove_cap('edit_theme_options'); 
	}
}
add_action('admin_init', 'custom_capability');
*/

/*
 * Hide menu items
 * Info: https://codex.wordpress.org/Function_Reference/remove_menu_page
 */
/*
function hide_menu_items() 
{ 
	//Remove Posts for everyone
	remove_menu_page('edit.php'); //Posts
	
	//Remove Tools for non administrator
	if(!current_user_can('administrator')){
		remove_menu_page('tools.php'); //Tools
	}
	
	//Add theme options for editors
	if(current_user_can('editor'))
	{
		remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
		remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
		remove_submenu_page( 'themes.php', 'customize.php' ); // hide the customizer submenu
		remove_submenu_page( 'themes.php', 'nav-menus.php' ); // hide the widgets submenu
		remove_submenu_page( 'themes.php', 'theme-editor.php' ); // hide the widgets submenu
    }
}
add_action('admin_menu', 'hide_menu_items');
*/

/* 
 * Remove custom post type support
 * Info: https://codex.wordpress.org/Function_Reference/remove_post_type_support
 */
/*
function remove_custom_post_type_support()
{
	remove_post_type_support('post_type_slug', 'post_type_feature');
}
add_action('init', 'remove_custom_post_type_support');
*/

/*
 * Custom excerpt word limit
 * Info: It will affect to get_the_excerpt();
 */
/*
function custom_excerpt_length($length)
{
	global $typenow;
	$amount = 150;
	
	//if("page" == $typenow){ 
	//	$amount = 150; 
	//}
	
	return $amount;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);
*/

/*
 * Custom excerpt append word
 * Info: It will affect to get_the_excerpt();
 */
/*
function custom_excerpt_more($more)
{
    return ' ...';
}
add_filter('excerpt_more', 'custom_excerpt_more');
*/

/*
 * Custom file size limit
 * Info: It will affect to all file uploads
 */
/*
function filter_site_upload_size_limit($size)
{
	//Set the upload size limit to 10 MB for users lacking the 'manage_options' capability.
    $size = 1024 * 1100; // 1 MB.
    return $size;
}
add_filter('upload_size_limit', 'filter_site_upload_size_limit', 20);
*/

/*
 * Custom menu items order
 * Info: It affect to admin sidebar menus
 */
/*
function admin_menu_items_order()
{
    global $menu;
    foreach ($menu as $key => $value)
	{
        if ('upload.php' == $value[2])
		{
            $oldkey = $key;
        }
    }
    $newkey = 24; // use whatever index gets you the position you want,if this key is in use you will write over a menu item!
    $menu[$newkey]=$menu[$oldkey];
    $menu[$oldkey]=array();
}
add_action('admin_menu', 'admin_menu_items_order');
*/

/*
 * Show future posts
 * Info: It will affect to a post type
 */
/*
function show_future_posts($data) 
{
    if($data['post_status'] == 'future' && $data['post_type'] == 'post-type')
	{	
        $data['post_status'] = 'publish';
	}
    return $data;
}
add_filter('wp_insert_post_data', 'show_future_posts');
*/

/*
 * Protect meta key (custom_fields)
 * Info: It will hide a custom field on select box in edit fields
 */
/*
function protected_meta_filter($protected, $meta_key)
{
	$fields_target = array('custom-field');
	
    if(in_array($meta_key, $fields_target))
	{
		return true;
	}
	return $protected;
}
add_filter('is_protected_meta', 'protected_meta_filter', 10, 2);
*/

/*
 * Hide meta key (attachment) by css
 * Info: It will hide a field on attachment screen
 */
/*
function remove_attachment_field() {
	
	$fields_normal = array('title','caption','alt','description');
	$fields_custom = array('custom-field-1');
	$fields_meta = array('custom-field-2');
	
	echo "<style>";
	foreach ($fields_normal as $fields_normal_item)
	{
		echo ".attachment-details .setting[data-setting='".$fields_normal_item."'], .media-sidebar .setting[data-setting='".$fields_normal_item."'],";
	}
	foreach ($fields_custom as $fields_custom_item)
	{
		echo ".compat-item tr.compat-field-".$fields_custom_item.",";
	}
	echo ".remove_attachment_field_finish";
	echo "{ display: none !important; }";
	echo "</style>";
	
	echo "<script>jQuery(document).ready(function(){ ";
	foreach ($fields_meta as $fields_meta_item)
	{
		echo 'jQuery("#metakeyselect option[value=';
		echo "'".$fields_meta_item."'";
		echo ']").remove();';
	}
	echo "});</script>";
}
add_action('admin_head', 'remove_attachment_field');
*/

/*
 * Create new attachment fields
 * Info: Create a custom attachment field screen
 */
/*
function attachment_field_add($form_fields, $post)
{
	$form_fields['custom-field'] = array(
		'label' => 'Custom Field',
		'input' => 'text',
		'value' => get_post_meta($post->ID, 'custom_field_id', true),
		'helps' => 'Custom Field Help',
	);
	return $form_fields;
}
add_filter('attachment_fields_to_edit', 'attachment_field_add', 10, 2);
*/

/*
 * Set new attachment fields
 * Info: Set a custom attachment field screen
 */
/*
function attachment_field_save($post, $attachment)
{
	if(isset($attachment['custom-field']))
	{
		update_post_meta($post['ID'], 'custom_field_id', $attachment['custom-field']);
	}
	return $post;
}
add_filter('attachment_fields_to_save', 'attachment_field_save', 10, 2);
*/

/*
 * Increase post meta limit
 * Info: Increase the custom field limit on select box (edit page screen)
 */
/*
function customfield_limit_increase($limit)
{
	$limit = 100;
	return $limit;
}
add_filter('postmeta_form_limit', 'customfield_limit_increase');
*/

/*
 * Hide admin items using CSS
 * Info: Hide elements on admin panel through CSS
 */
/*
function hide_items_css()
{
	global $typenow;

	echo "<style>";
	
		if("page" == $typenow)
		{
			echo "#pageparentdiv,"; 
		}
		if("page" == $typenow && $_GET["post"] == get_id_by_name('some-page-id'))
		{
			echo "#postdivrich,";
		}
	
	echo ".remove_items_css_finish{ 
		visibility: hidden !important; 
		height: 0px !important; 
		overflow: hidden !important; 
		margin: 0 !important; 
		padding: 0 !important; 
		border: none !important; 
		position: absolute !important; 
		z-index: -1;
	}</style>";
}
add_action('admin_footer', 'hide_items_css');
*/

//Remove custom post type
/*
function delete_custom_post_type()
{
    unregister_post_type('post_type_slug');
}
add_action('init','delete_custom_post_type');
*/

/*
 * Custom admin post filter by taxonomy
 * Info: Show filter for custom taxonomy on post type item list
 */
/*
function custom_taxonomy_filter_1()
{
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('custom-taxonomy-1');
 
	// must set this to the post type you want the filter(s) displayed on
	if($typenow == 'custom-post-type-1')
	{
		foreach ($taxonomies as $tax_slug){
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$tax_terms = get_terms($tax_slug);
			
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Show All $tax_name</option>";
			foreach($tax_terms as $tax_term)
			{ 
				echo '<option value='. $tax_term->slug, $_GET[$tax_slug] == $tax_term->slug ? ' selected="selected"' : '','>' . $tax_term->name .'</option>'; //(' . $tax_term->count .')
			}
			echo "</select>";
		}
	}
}
add_action('restrict_manage_posts', 'custom_taxonomy_filter_1');
*/

/*
 * Custom taxonomy
 * Info: https://codex.wordpress.org/Function_Reference/register_taxonomy
 */
/*
function create_custom_taxonomy_1() 
{
	// Add new taxonomy, make it hierarchical (like categories)
	$tax_title = 'Custom Taxonomy';
	$tax_item = 'Taxonomy Item';
	$tax_slug = 'custom-taxonomy-1';
	$tax_post_type = array('custom-post-type-1');
	$tax_args = array('hierarchical'      => true, //false = NOT hierarchical (like tags)
					  'labels'            => array('name'              => _x($tax_title, 'taxonomy general name', 'websitebase'),
												   'singular_name'     => _x($tax_item, 'taxonomy singular name', 'websitebase'),
												   'menu_name'         => __($tax_title, 'websitebase'),
												   'search_items'      => __('Search '.$tax_item, 'websitebase'),
												   'all_items'         => __('All '.$tax_title, 'websitebase'),
												   'parent_item'       => __('Parent '.$tax_item, 'websitebase'),
												   'parent_item_colon' => __('Parent '.$tax_item.':', 'websitebase'),
												   'edit_item'         => __('Edit '.$tax_item, 'websitebase'),
												   'update_item'       => __('Update '.$tax_item, 'websitebase'),
												   'add_new_item'      => __('Add New '.$tax_item, 'twebsitebase ,
												   'new_item_name'     => __($tax_title, 'websitebase')),
					  'show_ui'           => true,
					  'show_admin_column' => true,
					  'query_var'         => true,
					  'rewrite'           => array('slug' => $tax_slug,
												   'with_front' => false),
					);

	register_taxonomy($tax_slug, $tax_post_type, $tax_args);
	
	//Add default items
	$parent_term = term_exists( $tax_slug, $tax_slug ); // array is returned if taxonomy is given
	$parent_term_id = $parent_term['term_id']; // get numeric term id
	
	$term_name_1 = 'General';
	$term_slug_1 = 'general';
	wp_insert_term($term_name_1, $tax_slug, array( 'slug' => $term_slug_1,'parent'=> $parent_term_id));
}
add_action('init', 'create_custom_taxonomy_1', 0);
*/

/*
 * Custom Post Type 1
 * Info: https://codex.wordpress.org/Function_Reference/register_post_type
 */
/*
function custom_post_type_1() 
{
	// Set UI labels for Custom Post Type
	$post_title = 'Custom Post Type 1';
	$post_item = 'Post Type 1 Item';
	$post_slug = 'custom-post-type-1';
	$post_position = 4;
	
	// Set other options for Custom Post Type
    $post_args = array('label'               	=> __($post_slug, 'websitebase'),
					  'description'         	=> __('List '.$post_item, 'websitebase'),
					  'labels'              	=> array('name'                => _x($post_title, 'Post Type General Name', 'websitebase'),
														 'singular_name'       => _x($post_item, 'Post Type Singular Name', 'websitebase'),
														 'menu_name'           => __($post_title, 'websitebase'),
														 'parent_item_colon'   => __('Parent '.$post_item, 'websitebase'),
														 'all_items'           => __('All '.$post_title, 'websitebase'),
														 'view_item'           => __('View '.$post_item, 'websitebase'),
														 'add_new_item'        => __('Create New '.$post_item, 'websitebase'),
														 'add_new'             => __('Add '.$post_item, 'websitebase'),
														 'edit_item'           => __('Edit '.$post_item, 'websitebase'),
														 'update_item'         => __('Update '.$post_item, 'websitebase'),
														 'search_items'        => __('Search '.$post_item, 'websitebase'),
														 'not_found'           => __($post_item.' Not Found', 'websitebase'),
														 'not_found_in_trash'  => __($post_item.' Not Found in Trash', 'websitebase'),
														 'not_found_in_trash'  => __('List '.$post_item, 'websitebase')),
					  // Features this CPT supports in Post Editor
					  'supports'            	=> array('title',
														 'editor',
														 'excerpt',
														 'author',
														 'thumbnail',
														 'comments',
														 'revisions',
														 'custom-fields'),
					  // You can associate this CPT with a taxonomy or custom taxonomy.
					  'taxonomies'          	=> array('custom_taxonomy_1',
														 'post_tag'),
					  // A hierarchical CPT is like Pages and can have Parent and child items. A non-hierarchical CPT is like Posts.
					  'hierarchical'        	=> false,
					  'public'              	=> true,
					  'show_ui'             	=> true,
					  'show_in_menu'        	=> true,
					  'show_in_nav_menus'   	=> true,
					  'show_in_admin_bar'   	=> true,
					  'menu_position'       	=> $post_position,
					  'can_export'          	=> true,
					  'has_archive'         	=> true,
					  'exclude_from_search' 	=> false,
					  'publicly_queryable'  	=> true,
					  'capability_type'     	=> 'page',
    );
    
    // Registering your Custom Post Type
    register_post_type($post_slug, $post_args);
}
add_action('init', 'custom_post_type_1', 0);
*/

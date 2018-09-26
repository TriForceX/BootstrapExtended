<?php

//Get the main PHP utilities
require_once('resources.php');
require_once('resources/php/utilities.php');

use utilities\php as php;

/*
 * Wordpress Main Stuff
 * 
 * You can enable/disable Wordpress stuff or add more functions
 * More resources in https://codex.wordpress.org
 * 
 */

//Add custom CSS & JS to admin
function add_custom_admin() 
{
	echo '<link href="'.get_bloginfo('template_url').'/css/admin/style-base.css" rel="stylesheet">';
	echo '<link href="'.get_bloginfo('template_url').'/css/admin/style-theme.css" rel="stylesheet">';
	echo '<script src="'.get_bloginfo('template_url').'/js/admin/app-base.js"></script>';
	echo '<script src="'.get_bloginfo('template_url').'/js/admin/app-theme.js"></script>';
}
add_action('admin_footer', 'add_custom_admin');
add_action('login_footer', 'add_custom_admin');
if(is_user_logged_in())
{
	add_action('wp_footer', 'add_custom_admin');
}

//Custom login logo URL
function login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'login_logo_url');
add_filter('login_headertitle', 'login_logo_url');

//Prevent .htaccess to be modified by permalink rules
add_filter('flush_rewrite_rules_hard','__return_false');

//Set current page title
function get_page_title($separator)
{
    if(is_page()){
		$text = get_the_title(get_page_by_path(get_query_var('pagename')));
        $result = ' '.$separator.' '.$text;
    }
    else if(is_single() || is_archive()){
		$text = get_post_type_object(get_query_var('post_type'))->label;
        $result = ' '.$separator.' '.$text;
    }
	else if(is_tax() || is_tag() || is_category()){
		$text = ''; //get_taxonomy_data('name'); //WIP
        $result = ' '/*.$separator.' '.$text*/; //WIP
    }
    else if(is_404()){
		$text = 'Not found';
        $result = ' '.$separator.' '.$text;
    }
	else if(is_home()){
		$result = '';
    }
    else{
        $result = '';
    }
    return $result;
}

//Get the slug inside post
function get_the_slug($id = null)
{
  if(empty($id)){
    global $post;
    if(empty($post)){
    	return ''; // No global $post var available.
	}
    $id = $post->ID;
  }

  $slug = basename(get_permalink($id));
  return $slug;
}

//Get the id by name
function get_id_by_name($post_name)
{
	global $wpdb;
	$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$post_name."'");
	return $id;
}

//Get post_type data (label, name, description, etc...)
function get_post_type_data($type, $name = null){
	$post_type = empty($name) ? get_query_var('post_type') : $name;
	$data = get_post_type_object($post_type);
	return $data->$type;
}

//Get taxonomy data (term_id, name, slug, term_group, term_taxonomy_id, taxonomy, description, parent, count, etc...)
function get_taxonomy_data($type, $taxonomy, $id = null){
	$post_id = empty($id) ? get_the_ID() : $id;
	$post_terms = array_reverse(get_terms($taxonomy));
	$current_terms = wp_get_post_terms($post_id, $taxonomy, array('fields' => 'slugs')); 

	foreach($post_terms as $post_term){
		if (in_array($post_term->slug, $current_terms)){
			return $post_term->$type;
		}
	} 
}

//Featured image
function featuredImg($post, $size = 'full')
{
    $src = wp_get_attachment_image_src( get_post_thumbnail_id($post), $size, false); //$post->ID
    return $src[0];
}

//Featured image size
function featuredImgSize($post, $prop)
{
    $src = wp_get_attachment_image_src( get_post_thumbnail_id($post), 'full', false); //$post->ID
	if($prop == 'width'){
		$data = $src[1];
	}else{
		$data = $src[2];
	}
    return $data;
}

//Featured image field
function featuredImgField($post, $field)
{
    $value = get_post_meta(get_post_thumbnail_id($post), $field, true);
    return $value;
}

//Small function to check plugin without using is_plugin_active (due to it requires plugin.php)
function check_plugin($plugin)
{
	return in_array($plugin, apply_filters('active_plugins', get_option('active_plugins')));
}

/*
 * Wordpress Aditional Stuff
 * 
 * You can add more stuff above such as more functions, 
 * global variables, wordpress stuff, etc...
 * 
 */

//Enable post thumbnails
add_theme_support('post-thumbnails');

//Remove custom post type support
//function remove_custom_post_type_support() {
//	remove_post_type_support('post_type_slug', 'post_type_feature');
//}
//add_action('init', 'remove_custom_post_type_support');

//Custom JPEG quality on upload
function custom_jpeg_quality()
{
    return 100;
}

//Don't execute custom jpg quality if an image resizer is enabled
if(!check_plugin('resize-image-after-upload/resize-image-after-upload.php'))
{
	add_filter('jpeg_quality', 'custom_jpeg_quality');
}

//Register custom menus
//function register_custom_menus()
//{
//	register_nav_menus(
//		array(
//			'header-menu'	=> __('Header Menu'),
//			'extra-menu' 	=> __('Extra Menu')
//		)
//	);
//}
//add_action('init', 'register_custom_menus');

//Enable page excerpt
//add_post_type_support('page', 'excerpt');

//Custom excerpt word limit
//function custom_excerpt_length($length)
//{
//	global $typenow;
//	$amount = 150;
//	
//	/*if("page" == $typenow){
//		$amount = 150;
//	}*/
//	
//	return $amount;
//}
//add_filter('excerpt_length', 'custom_excerpt_length', 999);

//Custom excerpt append word
//function custom_excerpt_more($more)
//{
//    return ' ...';
//}
//add_filter('excerpt_more', 'custom_excerpt_more');

//Custom file size limit
//function filter_site_upload_size_limit($size)
//{
//	//Set the upload size limit to 10 MB for users lacking the 'manage_options' capability.
//    $size = 1024 * 1100; // 1 MB.
//    return $size;
//}
//add_filter('upload_size_limit', 'filter_site_upload_size_limit', 20);

//Edit custom role capabilities
//function custom_capability()
//{
//	$role1 = get_role('editor');
//	
//	//Per stuff
//	/*$role1Perms = array('posts');
//	
//	foreach($role1Perms as $rolePerm1)
//	{ 
//		$role1->add_cap('publish_'.$role1Perm); 
//		$role1->add_cap('edit_'.$role1Perm); 
//		$role1->add_cap('delete_'.$role1Perm);
//		$role1->add_cap('edit_published_'.$role1Perm); 
//		$role1->add_cap('delete_published_'.$role1Perm); 
//		$role1->add_cap('edit_others_'.$role1Perm); 
//		$role1->add_cap('delete_others_'.$role1Perm); 
//		$role1->add_cap('read_private_'.$role1Perm); 
//		$role1->add_cap('edit_private_'.$role1Perm);
//		$role1->add_cap('delete_private_'.$role1Perm);
//		$role1->add_cap('manage_categories_'.$role1Perm); 	
//	}*/
//	
//	//Individual add
//	/*if(!$role1->has_cap('edit_theme_options')){
//		$role1->add_cap('edit_theme_options'); 
//	}*/
//	
//	//Individual remove
//	/*if($role1->has_cap('edit_theme_options')){
//		$role1->remove_cap('edit_theme_options'); 
//	}*/
//}
//add_action('admin_init', 'custom_capability');


//Hide menu items
//function hide_menu_items() 
//{ 
//	//Remove Posts for everyone
//	/*remove_menu_page('edit.php'); //Posts*/
//	
//	//Remove Tools for non administrator
//	/*if(!current_user_can('administrator')){
//		remove_menu_page('tools.php'); //Tools
//	}*/
//	
//	//Add theme options for editors
//	if(current_user_can('editor')) {
//
//		//remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
//		//remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
//		//remove_submenu_page( 'themes.php', 'customize.php' ); // hide the customizer submenu
//		//remove_submenu_page( 'themes.php', 'nav-menus.php' ); // hide the widgets submenu
//		//remove_submenu_page( 'themes.php', 'theme-editor.php' ); // hide the widgets submenu
//    }
//}
//add_action('admin_menu', 'hide_menu_items'); 

//Custom menu items order
//function admin_menu_items_order()
//{
//    global $menu;
//    foreach ( $menu as $key => $value ) {
//        if ( 'upload.php' == $value[2] ) {
//            $oldkey = $key;
//        }
//    }
//    $newkey = 24; // use whatever index gets you the position you want,if this key is in use you will write over a menu item!
//    $menu[$newkey]=$menu[$oldkey];
//    $menu[$oldkey]=array();
//}
//add_action('admin_menu', 'admin_menu_items_order');

//Remove dashboard widgets
//function remove_dashboard_widgets() 
//{
//	//General
//	remove_action( 'welcome_panel', 'wp_welcome_panel' );
//	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );   // Right Now
//	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); // Recent Comments
//	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );  // Incoming Links
//	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );   // Plugins
//	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );  // Quick Press
//	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );  // Recent Drafts
//	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );   // WordPress blog
//	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );   // Other WordPress News
//	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); //Activity
//	
//	//Example by user role: Remove 'Simple History' Plugin widget
//	/*if(!current_user_can('administrator')){
//		remove_meta_box('simple_history_dashboard_widget', 'dashboard', 'normal'); 
//	}*/
//	//Example by user role: Remove 'Simple History' Plugin widget
//	/*if($user && isset($user->user_login) && 'user' == $user->user_login){
//		remove_meta_box('simple_history_dashboard_widget', 'dashboard', 'normal'); 
//	}*/
//}
//add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

//Remove items from adminbar
//function remove_from_adminbar($wp_admin_bar) 
//{
//	$wp_admin_bar->remove_node('wp-logo');
//	$wp_admin_bar->remove_node('comments');
//	$wp_admin_bar->remove_node('new-post');
//	$wp_admin_bar->remove_node('new-page');
//	$wp_admin_bar->remove_node('new-media');
//	$wp_admin_bar->remove_node('new-content');
//	$wp_admin_bar->remove_node('archive');
//}
//add_action('admin_bar_menu', 'remove_from_adminbar', 999);

//Custom general fields
$new_general_setting = new new_general_setting();

class new_general_setting 
{
    function new_general_setting() 
	{
        add_filter('admin_init', array(&$this, 'register_fields'));
    }
    function register_fields() 
	{
		$new_fields = array(
							array("blogkeywords","Site Keywords"),
							array("bloganalytics","Analytics Code"),
							array("blogauthor","Site Author"),
							array("blognavcolor","Nav Color"),
							array("blognavcolorapple","Nav Color"),
							);
		
		for($i = 0; $i < count($new_fields); ++$i)
		{
			register_setting('general', $new_fields[$i][0], 'esc_attr');
			add_settings_field($new_fields[$i][0], '<label for="'.$new_fields[$i][0].'">'.$new_fields[$i][1].'</label>', array(&$this, "new_field_".$i."_html"), 'general');
		}
    }
    function new_field_0_html() 
	{
		$new_field_data = array("blogkeywords","Words to let search engines to found this site");
		echo '<textarea style="max-width: 350px;min-height: 100px;width: 100%;" id="'.$new_field_data[0].'" name="'.$new_field_data[0].'">'.get_option($new_field_data[0], '').'</textarea>';
		echo '<p class="description" id="'.$new_field_data[0].'-description">'.$new_field_data[1].'</p>';
    }
	function new_field_1_html() 
	{
		$new_field_data = array("bloganalytics","Code placed in the HTML head to track site analytics");
        echo '<textarea style="max-width: 350px;min-height: 100px;width: 100%;" id="'.$new_field_data[0].'" name="'.$new_field_data[0].'">'.get_option($new_field_data[0], '').'</textarea>';
		echo '<p class="description" id="'.$new_field_data[0].'-description">'.$new_field_data[1].'</p>';
    }
	function new_field_2_html() 
	{
		$new_field_data = array("blogauthor","Defines the website author");
        echo '<input type="text" style="max-width: 350px;width: 100%;" id="'.$new_field_data[0].'" name="'.$new_field_data[0].'" value="'.get_option($new_field_data[0], '').'"/>';
		echo '<p class="description" id="'.$new_field_data[0].'-description">'.$new_field_data[1].'</p>';
    }
	function new_field_3_html() 
	{
		$new_field_data = array("blognavcolor","Website nav bar color for most devices");
        echo '<input type="text" style="max-width: 350px;width: 100%;" id="'.$new_field_data[0].'" name="'.$new_field_data[0].'" value="'.get_option($new_field_data[0], '').'"/>';
		echo '<p class="description" id="'.$new_field_data[0].'-description">'.$new_field_data[1].'</p>';
    }
	function new_field_4_html() 
	{
		$new_field_data = array("blognavcolorapple","Website nav bar color for Apple devices (it can be black or black-translucent)","new_field_5_html");
        echo '<input type="text" style="max-width: 350px;width: 100%;" id="'.$new_field_data[0].'" name="'.$new_field_data[0].'" value="'.get_option($new_field_data[0], '').'"/>';
		echo '<p class="description" id="'.$new_field_data[0].'-description">'.$new_field_data[1].'</p>';
    }
}

//Custom customize register functions
function custom_customize_register($wp_customize)
{
	//Hide ections, settings, and controls
	$wp_customize->remove_panel('themes');
	$wp_customize->remove_section('title_tagline');
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('header_image');
	$wp_customize->remove_section('background_image');
	$wp_customize->remove_panel('nav_menus');
	$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_section('custom_css');
	
	//Set custom template control for multiple checkbox
	class WP_Customize_Checkbox_Multiple_Control extends WP_Customize_Control {

		public $type = 'checkbox-multiple';
		
		public function enqueue() {
			wp_enqueue_script( 'custom_customize_register', get_bloginfo('template_url').'/js/app-admin.js', array( 'jquery' ) );
		}

		public function render_content() {

			if ( empty( $this->choices ) )
				return; ?>

			<?php if ( !empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>

			<?php if ( !empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>

			<?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

			<ul>
				<?php foreach ( $this->choices as $value => $label ) : ?>

					<li>
						<label>
							<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
							<?php echo esc_html( $label ); ?>
						</label>
					</li>

				<?php endforeach; ?>
			</ul>

			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
		<?php }
	}
}
add_action('customize_register', 'custom_customize_register', 50);

//Set template values (slug, control type, title, description, label, value)
$customize_theme_fields = array(
									//Field
									//array('field-text' => 
									//	  array(
									//			'text',
									//			'Field Text Button Title',
									//			'Field Text Desctription',
									//			'Field Text Label Title',
									//			'Field Text Default Value'
									//			)
									//),
									//Field
									//array('field-text-area' => 
									//	  array(
									//			'textarea',
									//			'Field Text Area Button Title',
									//			'Field Text Area Desctription',
									//			'Field Text Area Label Title',
									//			'Field Text Area Default Value'
									//			)
									//),
									//Field
									//array('field-image' => 
									//	  array(
									//			'image',
									//			'Field Image Button Title',
									//			'Field Image Desctription',
									//			'Field Image Label Title',
									//			get_bloginfo('template_url').'/img/icons/favicon/global.png'
									//			)
									//),
									//Field
									//array('field-file' => 
									//	  array(
									//			'file',
									//			'Field File Button Title',
									//			'Field File Desctription',
									//			'Field File Label Title',
									//			get_bloginfo('template_url').'/img/icons/favicon/global.png'
									//			)
									//),
									//Field
									//array('field-checkbox' => 
									//	  array(
									//		  	'checkbox',
									//			'Field Checkbox Button Title',
									//			'Field Checkbox Desctription',
									//			'Field Checkbox Label Title',
									//			array('option-2'), //Default
									//			array(
									//				'option-1'  => 'Option 1',
									//				'option-2'  => 'Option 2',
									//			)
									//		)
									//),
									//Field
									//array('field-radio' => 
									//	  array(
									//		  	'radio',
									//		  	'Field Radio Button Title',
									//		  	'Field Radio Desctription',
									//		  	'Field Radio Label Title',
									//		  	'option-2', //Default
									//		  	array(
									//				'option-1'  => 'Option 1',
									//				'option-2'  => 'Option 2',
									//			)
									//		)
									//),
									//Field
									//array('field-select' => 
									//	  array(
									//		  	'select',
									//		  	'Field Select Button Title',
									//		  	'Field Select Desctription',
									//		  	'Field Select Label Title',
									//		  	'option-2', //Default
									//		  	array(
									//				'option-1'  => 'Option 1',
									//				'option-2'  => 'Option 2',
									//			)
									//		)
									//),
								);

//Set template modifications
function custom_theme_settings($wp_customize)
{
	global $customize_theme_fields;
	
	foreach ($customize_theme_fields as $items)
	{
		foreach ($items as $key => $value)
		{
			$wp_customize->add_section($key,
				array(
					'title' 		=> $value[1],
					'description' 	=> $value[2],
				)
			);
			$wp_customize->add_setting($key,
				array(
					'default' 		=> $value[4],
				)
			);
			
			//Control type
			switch($value[0])
			{
				case 'text':
				case 'textarea':
					$wp_customize->add_control($key,
						array(
							'label' 	=> $value[3],
							'section' 	=> $key,
							'type' 		=> $value[0], //text
						)
					);
					break;
				case 'radio':
				case 'select':
					$wp_customize->add_control($key,
						array(
							'label' 	=> $value[3],
							'section' 	=> $key,
							'settings'	=> $key,
							'type' 		=> $value[0], //radio/select
							'choices'  	=> $value[5],
						)
					);
					break;
				case 'checkbox':
					$wp_customize->add_control( 
						new WP_Customize_Checkbox_Multiple_Control($wp_customize, $key,
							array(
								'label' 	=> $value[3],
								'section' 	=> $key,
								'settings'	=> $key,
								'type' 		=> 'checkbox-multiple', //improved checkbox
								'choices'  	=> $value[5],
							)
						)
					);
					break;
				case 'image':
					$wp_customize->add_control( 
						new WP_Customize_Image_Control($wp_customize, $key,
							array(
								'label'   	=> $value[3],
								'section' 	=> $key,
								'settings'	=> $key,
							)
						)
					);
					break;
				case 'file':
					$wp_customize->add_control( 
						new WP_Customize_Upload_Control($wp_customize, $key,
							array(
								'label'   	=> $value[3],
								'section' 	=> $key,
								'settings'	=> $key,
							)
						)
					);
					break;
			}
		}
	}
}
add_action('customize_register', 'custom_theme_settings');

//Set template default values
function get_theme_mod2($name)
{
    global $customize_theme_fields;

	foreach ($customize_theme_fields as $items)
	{
		foreach ($items as $key => $value)
		{
			if($key == $name)
			{
				$field = get_theme_mod($key);
				return empty($field) ? $value[4] : get_theme_mod($key);
			}
		}
	}
}

//Show future posts
//function show_future_posts($data) 
//{
//    if($data['post_status'] == 'future' && $data['post_type'] == 'post-type'){
//		
//        $data['post_status'] = 'publish';
//	}
//    return $data;
//}
//add_filter( 'wp_insert_post_data', 'show_future_posts' );

//Protect meta key (custom_fields)
//function my_is_protected_meta_filter($protected, $meta_key)
//{
//	$fields_target = array(
//							'custom-field',
//						  );
//	
//    if(in_array($meta_key, $fields_target))
//	{
//		return true;
//	}
//	return $protected;
//}
//add_filter('is_protected_meta', 'my_is_protected_meta_filter', 10, 2);

//Hide meta key (attachment) by css
//function remove_attachment_field() {
//	
//	$fields_normal = array(
//							//"title",
//						   	//"caption",
//							//"alt",
//							//"description"
//						  );
//	$fields_custom = array(
//							//"custom-field"
//						  );
//	$fields_meta = array(
//							//"custom-field",
//						);
//	
//	echo "<style>";
//	
//	foreach ( $fields_normal as $fields_normal_item )
//	{
//		echo ".attachment-details .setting[data-setting='".$fields_normal_item."'], .media-sidebar .setting[data-setting='".$fields_normal_item."'],";
//	}
//	
//	foreach ( $fields_custom as $fields_custom_item )
//	{
//		echo ".compat-item tr.compat-field-".$fields_custom_item.",";
//	}
//	
//	echo ".remove_attachment_field_finish";
//	echo "{ display: none !important; }";
//	echo "</style>";
//	
//	echo "<script>jQuery(document).ready(function(){ ";
//	
//	foreach ( $fields_meta as $fields_meta_item )
//	{
//		echo 'jQuery("#metakeyselect option[value=';
//		echo "'".$fields_meta_item."'";
//		echo ']").remove();';
//	}
//	
//	echo "});</script>";
//	
//}
//add_action('admin_head', 'remove_attachment_field');

//Create new attachment fields
//function be_attachment_field_credit($form_fields, $post)
//{
//	$form_fields['custom-field'] = array(
//		'label' => 'Custom Field',
//		'input' => 'text',
//		'value' => get_post_meta( $post->ID, 'custom_field_id', true ),
//		//'helps' => 'Custom Field Help',
//	);
//
//	return $form_fields;
//}
//add_filter('attachment_fields_to_edit', 'be_attachment_field_credit', 10, 2);

//Set new attachment fields
//function be_attachment_field_credit_save($post, $attachment)
//{
//	
//	if(isset( $attachment['custom-field']))
//		update_post_meta($post['ID'], 'custom_field_id', $attachment['custom-field']);
//
//	return $post;
//}
//add_filter('attachment_fields_to_save', 'be_attachment_field_credit_save', 10, 2);

//Increase post meta limit
//function customfield_limit_increase($limit)
//{
//  $limit = 100;
//  return $limit;
//}
//add_filter('postmeta_form_limit', 'customfield_limit_increase');

//Custom widget class
//class custom_widget_1 extends WP_Widget
//{
//	function custom_widget_1()
//	{
//		//process widget
//		$widget_options = array(
//			'classname'=> 'custom_widget_1_classname',
//			'description'=> 'A custom widget 1.',
//		);
//		$this->WP_Widget('custom_widget_1', 'Custom Widget 1', $widget_options);
//	}
//	function form($instance)
//	{
//		//show widget form in admin panel
//		$default_settings = array(
//			'title' => 'Custom Boxes',
//			'cwbox_box_1'=>'',
//			'cwbox_box_2'=>'',
//			'cwbox_box_3'=>'',
//			'cwbox_box_4'=>'',
//		);
//		$instance = wp_parse_args(
//			(array) $instance,
//			$default_settings
//		);
//		$title = $instance['title'];
//		$cwbox_box_1 = $instance['cwbox_box_1'];
//		$cwbox_box_2 = $instance['cwbox_box_2'];
//		$cwbox_box_3 = $instance['cwbox_box_3'];
//		$cwbox_box_4 = $instance['cwbox_box_4'];
//		
//		echo '<p>
//				Title: <input class="widefat" name="'.$this->get_field_name('title').'" type="text" value="'.esc_attr($title).'"/>
//			</p>
//			<p>
//				Ads Box 1: <textarea class="widefat" name="'.$this->get_field_name('cwbox_box_1').'">'.esc_attr($cwbox_box_1).'</textarea>
//			</p>
//			<p>
//				Ads Box 2: <textarea class="widefat" name="'.$this->get_field_name('cwbox_box_2').'">'.esc_attr($cwbox_box_2).'</textarea>
//			</p>
//			<p>
//				Ads Box 3: <textarea class="widefat" name="'.$this->get_field_name('cwbox_box_3').'">'.esc_attr($cwbox_box_3).'</textarea>
//			</p>
//			<p>
//				Ads Box 4: <textarea class="widefat" name="'.$this->get_field_name('cwbox_box_4').'">'.esc_attr($cwbox_box_4).'</textarea>
//			</p>';
//	}
//	function update($new_instance, $old_instance)
//	{
//		//update widget settings
//		$instance = $old_instance;
//		$instance['title'] = strip_tags($new_instance['title']);
//		$instance['cwbox_box_1'] = $new_instance['cwbox_box_1'];
//		$instance['cwbox_box_2'] = $new_instance['cwbox_box_2'];
//		$instance['cwbox_box_3'] = $new_instance['cwbox_box_3'];
//		$instance['cwbox_box_4'] = $new_instance['cwbox_box_4'];
//
//		return $instance;
//	}
//	function widget($args, $instance)
//	{
//		//display widget
//		extract($args);
//
//		echo $before_widget;
//
//		$title = apply_filters('widget_title', $instance['title']);
//		$cwbox_box_1 = empty($instance['cwbox_box_1']) ? '' : $instance['cwbox_box_1'];
//		$cwbox_box_2 = empty($instance['cwbox_box_2']) ? '' : $instance['cwbox_box_2'];
//		$cwbox_box_3 = empty($instance['cwbox_box_3']) ? '' : $instance['cwbox_box_3'];
//		$cwbox_box_4 = empty($instance['cwbox_box_4']) ? '' : $instance['cwbox_box_4'];
//
//		if(!empty($title)){ echo $befor_title . $title . $after_title; }
//		echo '<ul class="cli_sb_cwbox_boxes">
//				<li>'.$cwbox_box_1.'</li>
//				<li>'.$cwbox_box_2.'</li>
//				<li>'.$cwbox_box_3.'</li>
//				<li>'.$cwbox_box_4.'</li>
//			</ul>';
//
//		echo $after_widget;
//	}
//}

//Register widgets and sidebars
//function custom_widgets_init()
//{
//	$nameTHEME = 'websitebase';
//	
//	//Sidebar
//    register_sidebar(array(
//        'name'          => __('Sidebar Custom 1', $nameTHEME),
//        'id'            => 'sidebar-custom-1',
//		'description'	=> 'A custom sidebar 1.',  
//        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//        'after_widget'  => '</aside>',
//        'before_title'  => '<h1 class="widget-title">',
//        'after_title'   => '</h1>',
//    ));
//	
//	//Widget
//	register_widget('custom_widget_1');
//}
//add_action('widgets_init', 'custom_widgets_init');

//Hide admin items using CSS
//function hide_items_css()
//{
//	global $typenow;
//
//	echo "<style>";
//	
//		if("page" == $typenow){
//			echo "#pageparentdiv,"; 
//		}
//		//
//		if("page" == $typenow && $_GET["post"] == get_id_by_name('some-page-id')){
//			echo "#postdivrich,";
//		}
//	
//	
//	echo ".remove_items_css_finish{ 
//				visibility: hidden !important; 
//				height: 0px !important; 
//				overflow: hidden !important; 
//				margin: 0 !important; 
//				padding: 0 !important; 
//				border: none !important; 
//				position: absolute !important; 
//				z-index: -1;
//		  }
//		  </style>";
//}
//add_action('admin_footer', 'hide_items_css');

//Custom admin post filter by taxonomy
//function custom_taxonomy_filter_1()
//{
//	global $typenow;
// 
//	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
//	$taxonomies = array('custom-taxonomy-1');
// 
//	// must set this to the post type you want the filter(s) displayed on
//	if($typenow == 'custom-post-type-1'){
//		
//		foreach ($taxonomies as $tax_slug){
//			$tax_obj = get_taxonomy($tax_slug);
//			$tax_name = $tax_obj->labels->name;
//			$tax_terms = get_terms($tax_slug);
//			
//			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
//			echo "<option value=''>Show All $tax_name</option>";
//			foreach($tax_terms as $tax_term){ 
//				echo '<option value='. $tax_term->slug, $_GET[$tax_slug] == $tax_term->slug ? ' selected="selected"' : '','>' . $tax_term->name .'</option>'; //(' . $tax_term->count .')
//			}
//			echo "</select>";
//		}
//	}
//}
//add_action('restrict_manage_posts', 'custom_taxonomy_filter_1');

//Custom taxonomy
//function create_custom_taxonomy_1() 
//{
//	// Add new taxonomy, make it hierarchical (like categories)
//	$nameFULL = 'Custom Taxonomy';
//	$nameITEM = 'Taxonomy Item';
//	$nameLANG = 0; //0 = English, 1 = Spanish
//	$nameGENDER = 'o'; //a = Female, o = Male (Spanish case to end an item)
//	$nameSLUG = 'deportes';
//	$nameTYPE = array(
//					  	'custom-post-type-1',
//					 );
//	
//	$menuLANGTEXT = array(
//						'search_items'      => array('Search '.$nameITEM, 'Buscar '.$nameITEM),
//						'all_items'         => array('All '.$nameFULL, 'Tod'.$nameGENDER.'s l'.$nameGENDER.'s '.$nameFULL),
//						'parent_item'       => array('Parent '.$nameITEM, $nameITEM.' Superior'),
//						'parent_item_colon' => array('Parent '.$nameITEM.':', $nameITEM.' Superior:'),
//						'edit_item'         => array('Edit '.$nameITEM, 'Editar '.$nameITEM),
//						'update_item'       => array('Update '.$nameITEM, 'Actualizar '.$nameITEM),
//						'add_new_item'      => array('Add New '.$nameITEM, 'Agregar Nuev'.$nameGENDER.' '.$nameITEM),
//						'new_item_name'     => array('New '.$nameITEM.' Name', 'Nuevo Nombre '.$nameITEM),
//						'menu_name'         => array($nameFULL, $nameFULL),
//					);
//	
//	$menuARGS = array(
//						'hierarchical'      => true, //false = NOT hierarchical (like tags)
//						'labels'            => array(
//													'name'              => _x($nameFULL, 'taxonomy general name', 'textdomain' ),
//													'singular_name'     => _x($nameITEM, 'taxonomy singular name', 'textdomain' ),
//													'menu_name'         => __($nameFULL, 'textdomain' ),
//													'search_items'      => __($menuLANGTEXT['search_items'][$nameLANG], 'textdomain' ),
//													'all_items'         => __($menuLANGTEXT['all_items'][$nameLANG], 'textdomain' ),
//													'parent_item'       => __($menuLANGTEXT['parent_item'][$nameLANG], 'textdomain' ),
//													'parent_item_colon' => __($menuLANGTEXT['parent_item_colon'][$nameLANG], 'textdomain' ),
//													'edit_item'         => __($menuLANGTEXT['edit_item'][$nameLANG], 'textdomain' ),
//													'update_item'       => __($menuLANGTEXT['update_item'][$nameLANG], 'textdomain' ),
//													'add_new_item'      => __($menuLANGTEXT['add_new_item'][$nameLANG], 'textdomain' ),
//													'new_item_name'     => __($menuLANGTEXT['new_item_name'][$nameLANG], 'textdomain' ),
//													),
//						'show_ui'           => true,
//						'show_admin_column' => true,
//						'query_var'         => true,
//						'rewrite'           => array(
//													'slug' => $nameSLUG,
//													'with_front' => false),
//													);
//
//	register_taxonomy( $nameSLUG, $nameTYPE, $menuARGS );
//	
//	//Add default items
//	/*$parent_term = term_exists( $nameSLUG, $nameSLUG ); // array is returned if taxonomy is given
//	$parent_term_id = $parent_term['term_id']; // get numeric term id
//	
//	$termNONAME1 = 'General';
//	$termSLUG1 = 'general';
//	wp_insert_term( $termNAME1, $nameSLUG, array( 'slug' => $termSLUG1,'parent'=> $parent_term_id ));*/
//	
//}
//add_action('init', 'create_custom_taxonomy_1', 0);

//Custom Post Type 1
//function custom_post_type_1() 
//{
//	// Set UI labels for Custom Post Type
//	$nameFULL = 'Custom Post Type 1';
//	$nameITEM = 'Post Type 1 Item';
//	$nameLANG = 0; //0 = English, 1 = Spanish
//	$nameGENDER = 'o'; //a = Female, o = Male (Spanish case to end an item)
//	$nameSLUG = 'custom-post-type-1';
//	$nameTEMPLATE = 'websitebase';
//	$menuPOSITION = 4;
//	
//	$menuLANGTEXT = array(
//							'parent_item_colon' 	=> array('Parent '.$nameITEM, $nameITEM.' Superior'),
//							'all_items' 			=> array('All '.$nameFULL, 'Tod'.$nameGENDER.'s l'.$nameGENDER.'s '.$nameFULL),
//							'view_item' 			=> array('View '.$nameITEM, 'Ver '.$nameITEM),
//							'add_new_item' 			=> array('Create New '.$nameITEM, 'Crear Nuev'.$nameGENDER.' '.$nameITEM),
//							'add_new' 				=> array('Add '.$nameITEM, 'Agregar '.$nameITEM),
//							'edit_item' 			=> array('Edit '.$nameITEM, 'Editar '.$nameITEM),
//							'update_item' 			=> array('Update '.$nameITEM, 'Actualizar '.$nameITEM),
//							'search_items' 			=> array('Search '.$nameITEM, 'Buscar '.$nameITEM),
//							'not_found' 			=> array($nameITEM.' Not Found', $nameITEM.' No Encontrado'),
//							'not_found_in_trash' 	=> array($nameITEM.' Not Found in Trash', $nameITEM.' No Encontrado en la Papelera'),
//							'description' 			=> array('List '.$nameITEM, 'Listado de '.$nameITEM),
//						);
//	
//	// Set other options for Custom Post Type
//    $menuARGS = array(
//							'label'               	=> __($nameSLUG, $nameTEMPLATE),
//							'description'         	=> __($menuLANGTEXT['description'][$nameLANG], $nameTEMPLATE),
//							'labels'              	=> array(
//															'name'                => _x($nameFULL, 'Post Type General Name', $nameTEMPLATE),
//														   	'singular_name'       => _x($nameITEM, 'Post Type Singular Name', $nameTEMPLATE),
//														   	'menu_name'           => __($nameFULL, $nameTEMPLATE),
//														   	'parent_item_colon'   => __($menuLANGTEXT['parent_item_colon'][$nameLANG], $nameTEMPLATE),
//														   	'all_items'           => __($menuLANGTEXT['all_items'][$nameLANG], $nameTEMPLATE),
//														   	'view_item'           => __($menuLANGTEXT['view_item'][$nameLANG], $nameTEMPLATE ),
//														   	'add_new_item'        => __($menuLANGTEXT['add_new_item'][$nameLANG], $nameTEMPLATE),
//														   	'add_new'             => __($menuLANGTEXT['add_new'][$nameLANG], $nameTEMPLATE),
//														   	'edit_item'           => __($menuLANGTEXT['edit_item'][$nameLANG], $nameTEMPLATE),
//														   	'update_item'         => __($menuLANGTEXT['update_item'][$nameLANG], $nameTEMPLATE),
//														   	'search_items'        => __($menuLANGTEXT['search_items'][$nameLANG], $nameTEMPLATE),
//														   	'not_found'           => __($menuLANGTEXT['not_found'][$nameLANG], $nameTEMPLATE),
//														   	'not_found_in_trash'  => __($menuLANGTEXT['not_found_in_trash'][$nameLANG], $nameTEMPLATE),
//														   	'not_found_in_trash'  => __($menuLANGTEXT['not_found_in_trash'][$nameLANG], $nameTEMPLATE),
//															),
//
//							// Features this CPT supports in Post Editor
//							'supports'            	=> array(
//														   	'title', 
//														   	'editor', 
//														   	//'excerpt', 
//														   	//'author',
//														   	'thumbnail',
//														   	//'comments',
//														   	//'revisions',
//														   	'custom-fields',
//														  	),
//		
//							// You can associate this CPT with a taxonomy or custom taxonomy.
//							'taxonomies'          	=> array(
//														   	//'custom_taxonomy_1',
//														   	//'post_tag',
//														  	),
//
//							/* A hierarchical CPT is like Pages and can have
//							* Parent and child items. A non-hierarchical CPT
//							* is like Posts.
//							*/    
//							'hierarchical'        	=> false,
//							'public'              	=> true,
//							'show_ui'             	=> true,
//							'show_in_menu'        	=> true,
//							'show_in_nav_menus'   	=> true,
//							'show_in_admin_bar'   	=> true,
//							'menu_position'       	=> $menuPOSITION,
//							'can_export'          	=> true,
//							'has_archive'         	=> true,
//							'exclude_from_search' 	=> false,
//							'publicly_queryable'  	=> true,
//							'capability_type'     	=> 'page',
//    );
//    
//    // Registering your Custom Post Type
//    register_post_type($nameSLUG, $menuARGS);
//}
//add_action('init', 'custom_post_type_1', 0);

//Remove custom post type
//function delete_custom_post_type(){
//    unregister_post_type('post_type_slug');
//}
//add_action('init','delete_custom_post_type');

//Posts data based on content type
//function custom_posts_per_page($query)
//{
//	if(!is_admin()){
//        switch ($query->query_vars['post_type'])
//        {
//            case 'custom_post_type_slug':
//                $query->query_vars['posts_per_page'] = 6;
//                $query->query_vars['order'] = 'DESC';
//                $query->query_vars['orderby'] = 'date';
//                break;
//        }
//        return $query;
//    }
//}
//add_filter('pre_get_posts', 'custom_posts_per_page');

//Disable specific plugin update check 
function disable_plugin_updates( $value ) {
	
	$disabledPlugins = array(
							'advanced-custom-fields-pro/acf.php', //Updated manually (from https://github.com/wp-premium/advanced-custom-fields-pro)
							'admin-menu-editor-pro/menu-editor.php', //Updated manually (check the comment "//Manual update" on this file before update)
							'enhaced-contextual-help/enhaced-contextual-help.php', //Updated manually (from https://github.com/TriForceX/WebsiteBase/tree/master/wordpress/wp-content/plugins/enhaced-contextual-help)
							'wp-migrate-db-pro/wp-migrate-db-pro.php', //Updated manually (check the comment "//Manual update" on this file before update)
							//'plugin-folder/plugin.php',
							//'plugin-folder/plugin.php',
							);
	
	foreach ($disabledPlugins as $disabledPlugin)
	{
		if (isset($value) && is_object($value)) 
		{
			if (isset($value->response[$disabledPlugin])) 
			{
				unset($value->response[$disabledPlugin]);
			}
		}
	}
	return $value;
}
add_filter('site_transient_update_plugins', 'disable_plugin_updates');

<?php

/*
 * PHP Main Stuff
 * © 2017 TriForce - Matías Silva
 *
 * This file calls the main PHP utilities and sets the main HTML data
 * for meta tags in the header file
 * 
 */

//Get the PHP utilities file
require('resources/php/main.php');

//Call the main class
class php extends utilities\php 
{ 
	public static function get_html_data($type)
    {
		switch($type){
			case 'lang': 
				return get_bloginfo('language'); 
				break;
			case 'charset': 
				return get_option('blog_charset'); 
				break;
			case 'title': 
				return get_option('blogname'); 
				break;
			case 'description': 
				return get_option('blogdescription'); 
				break;
			case 'keywords': 
				return get_option('blogkeywords'); 
				break;
			case 'author': 
				return get_option('blogauthor'); 
				break;
			case 'mobile-capable': 
				return 'yes'; 
				break;
			case 'viewport': 
				return 'width=device-width, initial-scale=1, user-scalable=no'; 
				break;
			case 'nav-color': 
				return '#f46016'; 
				break;
			case 'nav-color-apple': 
				return 'black'; 
				break;
			default: break;
		}
	}
}

//PHP error handler
if(isset($_GET['debug'])){
	php::get_error($_GET['debug']);
}

/*
 * PHP Aditional Stuff
 * 
 * You can add more stuff above such as more functions, 
 * global variables, wordpress stuff, etc...
 * 
 */





/*
 * Wordpress Main Stuff
 * 
 * You can add more stuff above such as more functions, 
 * global variables, wordpress stuff, etc...
 * 
 */

//St current page title
function get_page_title($separator)
{
    if(is_page()){
		$text = get_the_title(get_page_by_path(get_query_var('pagename')));
        $result = ' '.$separator.' '.$text;
    }
    else if(is_single() OR is_archive()){
		$text = !empty(get_taxonomy_data('name')) ? get_taxonomy_data('name') : get_post_type_object(get_query_var('post_type'))->label;
        $result = ' '.$separator.' '.$text;
    }
	else if(is_tax() OR is_tag() OR is_category()){
		$text = ''; //WIP
        $result = ' '/*.$separator.' '.$text*/; //WIP
    }
    else if(is_404()){
		$text = 'Disabled';
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

//Hide menu items
function hide_menu_items() 
{ 
	//remove_menu_page( 'edit.php' ); //Posts
	//remove_menu_page( 'tools.php' ); //Tools
}
add_action( 'admin_menu', 'hide_menu_items' ); 

//Custom menu items order
/*function admin_menu_items_order()
{
    global $menu;
    foreach ( $menu as $key => $value ) {
        if ( 'upload.php' == $value[2] ) {
            $oldkey = $key;
        }
    }
    $newkey = 24; // use whatever index gets you the position you want
    // if this key is in use you will write over a menu item!
    $menu[$newkey]=$menu[$oldkey];
    $menu[$oldkey]=array();
}
add_action('admin_menu', 'admin_menu_items_order');

//Custom menu items order
function admin_menu_items_order_2()
{
    global $menu;
    foreach ( $menu as $key => $value ) {
        if ( 'edit.php?post_type=page' == $value[2] ) {
            $oldkey = $key;
        }
    }
    $newkey = 23; // use whatever index gets you the position you want
    // if this key is in use you will write over a menu item!
    $menu[$newkey]=$menu[$oldkey];
    $menu[$oldkey]=array();
}
add_action('admin_menu', 'admin_menu_items_order_2');*/

//Remove dashboard widgets
function remove_dashboard_widgets() 
{
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
	
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

//Remove from adminbar
function remove_from_adminbar($wp_admin_bar) 
{
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('new-post');
	$wp_admin_bar->remove_node('new-page');
	$wp_admin_bar->remove_node('new-media');
	$wp_admin_bar->remove_node('archive');
}
add_action( 'admin_bar_menu', 'remove_from_adminbar', 999 );

//Custom general fields
$new_general_setting = new new_general_setting();

class new_general_setting 
{
    function new_general_setting() 
	{
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() 
	{
		$new_field_1 = array("blogkeywords","Site Keywords","Words to let search engines to found this site","new_field_1_html");
		$new_field_2 = array("bloganalytics","Analytics Code","Code placed in the HTML head to track site analytics","new_field_2_html");
		$new_field_3 = array("blogauthor","Site Author","Defines the website author","new_field_3_html");
        register_setting( 'general', $new_field_1[0], 'esc_attr' );
        register_setting( 'general', $new_field_2[0], 'esc_attr' );
        register_setting( 'general', $new_field_3[0], 'esc_attr' );
        add_settings_field($new_field_1[0], '<label for="'.$new_field_1[0].'">'.$new_field_1[1].'</label>' , array(&$this, $new_field_1[3]) , 'general' );
        add_settings_field($new_field_2[0], '<label for="'.$new_field_2[0].'">'.$new_field_2[1].'</label>' , array(&$this, $new_field_2[3]) , 'general' );
        add_settings_field($new_field_3[0], '<label for="'.$new_field_3[0].'">'.$new_field_3[1].'</label>' , array(&$this, $new_field_3[3]) , 'general' );
    }
    function new_field_1_html() 
	{
		$new_field_data = array("blogkeywords","Site Keywords","Words to let search engines to found this site","new_field_1_html");
        //echo '<input class="regular-text" type="text" id="'.$new_field_data[0].'" name="'.$new_field_data[0].'" value="' . get_option( $new_field_data[0], '' ) . '" />';
		echo '<textarea style="max-width: 350px;min-height: 100px;width: 100%;" id="'.$new_field_data[0].'" name="'.$new_field_data[0].'">' . get_option( $new_field_data[0], '' ) . '</textarea>';
		echo '<p class="description" id="'.$new_field_data[0].'-description">'.$new_field_data[2].'</p>';
    }
	function new_field_2_html() 
	{
		$new_field_data = array("bloganalytics","Analytics Code","Code placed in the HTML head to track site analytics","new_field_2_html");
        echo '<textarea style="max-width: 350px;min-height: 100px;width: 100%;" id="'.$new_field_data[0].'" name="'.$new_field_data[0].'">' . get_option( $new_field_data[0], '' ) . '</textarea>';
		echo '<p class="description" id="'.$new_field_data[0].'-description">'.$new_field_data[2].'</p>';
    }
	function new_field_3_html() 
	{
		$new_field_data = array("blogauthor","Site Author","Defines the website author","new_field_3_html");
        echo '<input style="max-width: 350px;width: 100%;" id="'.$new_field_data[0].'" name="'.$new_field_data[0].'" value="' . get_option( $new_field_data[0], '' ) . '"/>';
		echo '<p class="description" id="'.$new_field_data[0].'-description">'.$new_field_data[2].'</p>';
    }
}

//Show admin bar in front-end
if(isset($_GET['adminbar'])){
	show_admin_bar(true);
}
else{
	show_admin_bar(false);
}

//Add custom CSS & JS to admin
function add_custom_admin() 
{
	echo '<link href="'.get_bloginfo('template_url').'/css/style-admin.css" rel="stylesheet" />';
	echo '<script src="'.get_bloginfo('template_url').'/js/app-admin.js"></script>';
}
//add_action(array('admin_footer','login_footer','wp_footer'), 'add_custom_admin');
add_action('admin_footer', 'add_custom_admin');
add_action('login_footer', 'add_custom_admin');
add_action('wp_footer', 'add_custom_admin');

//Enable page excerpt
add_post_type_support('page', 'excerpt');

//Enable post thumbnails
add_theme_support( 'post-thumbnails' );

//Dont show auto-galleries on content (Easy Gallery plugin)
remove_filter( 'the_content', 'easy_image_gallery_append_to_content' );

//Show future posts
function show_future_posts( $data ) 
{
    if ( $data['post_status'] == 'future' && 
		 $data['post_type'] == 'calendarios'
		 //$data['post_type'] == 'post-type' 
	   ){
		
        $data['post_status'] = 'publish';
	}
    return $data;
}
add_filter( 'wp_insert_post_data', 'show_future_posts' );

//Get the slug inside post
function get_the_slug( $id=null )
{
  if( empty($id) ):
    global $post;
    if( empty($post) )
      return ''; // No global $post var available.
    $id = $post->ID;
  endif;

  $slug = basename( get_permalink($id) );
  return $slug;
}

//Get the category inside post
function get_category_name( $tipo )
{
	if($tipo=='category'){
		return get_the_category()[0]->name;
	}
	else{//Custom tax
		return get_the_terms( get_the_ID(), $tipo )[0]->name;
	}
}

//Get the category slug inside post
function get_category_slug( $tipo )
{
	if($tipo=='category'){
		return get_the_category()[0]->slug;
	}
	else{//Custom tax
		return get_the_terms( get_the_ID(), $tipo )[0]->slug;
	}
}

//Get the category name by id
function get_category_name_by_id( $name, $tipo )
{
	$term = get_term_by('slug', $name,  $tipo); 
    $name = $term->name; 
    //$id = $term->term_id;
	return $name;
}

//Get the id by name
function get_id_by_name($post_name)
{
	global $wpdb;
	$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$post_name."'");
	return $id;
}

//Get taxonomy data
function get_taxonomy_data($type)
{
	/*
	term_id
	name
	slug
	term_group
	term_taxonomy_id
	taxonomy
	description
	parent
	count
	*/
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	return $term->$type; 
}

//Image Featured
function imageFeatured($featuredPost)
{
    $src = wp_get_attachment_image_src( get_post_thumbnail_id( $featuredPost ), 'full', false ); //$post->ID
    //echo $src[0];
    return $src[0];
}

//Image Featured
function imageFeaturedSize($tipo,$featuredPost)
{
    $src = wp_get_attachment_image_src( get_post_thumbnail_id( $featuredPost ), 'full', false ); //$post->ID
    //echo $src[0];
	if($tipo=="width"){
		$srcFinal = $src[1];
	}else{
		$srcFinal = $src[2];
	}
    return $srcFinal;
}

//Image Featured Data
function imageFeaturedData($featuredField,$featuredPost)
{
    $value = get_post_meta(get_post_thumbnail_id( $featuredPost ), $featuredField, true);
    return $value;
}

//for dynamic-featured-image.3.5.2
function dinamicFeatured($dynamicItem,$dynamicPost)
{
	if( class_exists('Dynamic_Featured_Image') ) {
		 global $dynamic_featured_image;
		 $featured_images = $dynamic_featured_image->get_featured_images( $dynamicPost );
		 return $featured_images[$dynamicItem]['full'];//[0]['full']
		//You can now loop through the image to display them as required
	 }
}

//
function dinamicFeaturedData($dynamicField,$dynamicItem,$dynamicPost)
{
	if( class_exists('Dynamic_Featured_Image') ) {
		 global $dynamic_featured_image;
		 $featured_images = $dynamic_featured_image->get_featured_images( $dynamicPost );
		 $dynamicID = $featured_images[$dynamicItem]['attachment_id'];//[0]['full']
		//You can now loop through the image to display them as required
		 $value = get_post_meta($dynamicID, $dynamicField, true);
   		 return $value;
	 }
}

/*
 * Wordpress Aditional Stuff
 * 
 * You can add more stuff above such as more functions, 
 * global variables, wordpress stuff, etc...
 * 
 */
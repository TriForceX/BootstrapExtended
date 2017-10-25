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
				return '#333333'; 
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

function getEmbedVideo($url,$autoplay = false)
{
	$videoCode = '';
	$videoURL = '';
	$videoAutplay = $autoplay === true ? 1 : 0;
	
	if(php::str_contains($url,'youtube')){
		preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $url, $videoCode);
		$videoURL = 'https://www.youtube.com/embed/'.$videoCode[7].'?rel=0&autoplay='.$videoAutplay;
	}
	elseif(php::str_contains($url,'vimeo')){
		preg_match('/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/', $url, $videoCode);
		$videoURL = 'https://player.vimeo.com/video/'.$videoCode[5].'?autoplay='.$videoAutplay;
	}
	elseif(php::str_contains($url,'facebook')){
		$videoURL = 'https://www.facebook.com/plugins/video.php?href='.$url.'&show_text=0&autoplay='.$videoAutplay;
	}
	
	return $videoURL;
}

function getVideoID($url)
{
	$videoCode = '';
	$videoID = '';
	
	if(php::str_contains($url,'youtube')){
		preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $url, $videoCode);
		$videoID = $videoCode[7];
	}
	elseif(php::str_contains($url,'vimeo')){
		preg_match('/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/', $url, $videoCode);
		$videoID = $videoCode[5];
	}
	elseif(php::str_contains($url,'facebook')){
		$videoID = $url;
	}
	
	return $videoID;
}

//Custom paginator for galleries
function customPaginator($offset, $limit, $totalnum, $customclass, $customLeft = '&laquo;', $customRight = '&laquo;', $append = false){
	
	if($append == false){
		$append = get_bloginfo('url').'/'.get_query_var('post_type').'/'.get_the_slug($post->ID).'/?';
	}

	if ($totalnum > $limit)
	{
		$pages = intval($totalnum / $limit);

		if ($totalnum % $limit)
		$pages++;

		if(($offset + $limit) > $totalnum){
			$lastnum = $totalnum;
		}else{
			$lastnum = ($offset + $limit);
		}
		if (isset($_GET['pag'])){ 
			$pageCurrent = $_GET['pag'];
		}
		else{
			$pageCurrent = 1;
		}
		$pagePrev = $pageCurrent-1; $pageNumPrev = ($pageCurrent*$limit)-$limit*2;
		$pageNext = $pageCurrent+1; $pageNumNext = $pageCurrent*$limit;
		if($pagePrev <= 1){
			$pagePrev = 1;
			$pageNumPrev = 0;
		} 
		if($pageNext > $pages){
			$pageNext = $_GET['pag'];
			$pageNumNext = $_GET['num'];
		}
		echo '<div class="JSpaginator '.$customclass.'"><div class="JSpageItems">';
		echo '<a class="JSpagePrev" href="'.$append.'pag='.$pagePrev.'&num='.$pageNumPrev.'">'.$customLeft.'</a>';	
			for ($i = 1; $i <= $pages; $i++) {  // loop thru 
				$newoffset = $limit * ($i - 1);

				if ($newoffset != $offset) 
				{
					echo '<a href="'.$append.'pag='.$i.'&num='.$newoffset.'">'.$i.'</a>';
				} 
				else
				{
					echo '<a href="'.$append.'pag='.$i.'&num='.$newoffset.'" class="JSpageActive">'.$i.'</a>';
				}

			}
		echo '<a class="JSpageNext" href="'.$append.'pag='.$pageNext.'&num='.$pageNumNext.'">'.$customRight.'</a>';
		echo '</div></div>';
	}
	return;
}

/*
 * Wordpress Main Stuff
 * 
 * You can add more stuff above such as more functions, 
 * global variables, wordpress stuff, etc...
 * 
 */

//Show admin bar in front-end
if(isset($_GET['admin'])){
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

//Custom login logo URL
function login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'login_logo_url' );
add_filter( 'login_headertitle', 'login_logo_url' );

//Set current page title
function get_page_title($separator)
{
    if(is_page()){
		$text = get_the_title(get_page_by_path(get_query_var('pagename')));
        $result = ' '.$separator.' '.$text;
    }
    else if(is_single() || is_archive()){
		$text = !empty(get_taxonomy_data('name')) ? get_taxonomy_data('name') : get_post_type_object(get_query_var('post_type'))->label;
        $result = ' '.$separator.' '.$text;
    }
	else if(is_tax() || is_tag() || is_category()){
		$text = ''; //WIP
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
    if(empty($post))
    	return ''; // No global $post var available.
    $id = $post->ID;
  }

  $slug = basename( get_permalink($id) );
  return $slug;
}

//Get the category inside post
function get_category_name($tipo)
{
	if($tipo=='category'){
		return get_the_category()[0]->name;
	}
	else{//Custom tax
		return get_the_terms( get_the_ID(), $tipo )[0]->name;
	}
}

//Get the category slug inside post
function get_category_slug($tipo)
{
	if($tipo=='category'){
		return get_the_category()[0]->slug;
	}
	else{//Custom tax
		return get_the_terms( get_the_ID(), $tipo )[0]->slug;
	}
}

//Get the category name by id
function get_category_name_by_id($name, $tipo)
{
	$term = get_term_by('slug', $name,  $tipo); 
    $name = $term->name; 
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
	//term_id, name, slug, term_group, term_taxonomy_id, taxonomy, description, parent, count
	$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
	return $term->$type; 
}

//Image Featured
function imageFeatured($featuredPost,$size = 'full')
{
    $src = wp_get_attachment_image_src( get_post_thumbnail_id($featuredPost), $size, false); //$post->ID
    return $src[0];
}

//Image Featured
function imageFeaturedSize($tipo,$featuredPost)
{
    $src = wp_get_attachment_image_src( get_post_thumbnail_id($featuredPost), 'full', false); //$post->ID
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
    $value = get_post_meta(get_post_thumbnail_id($featuredPost), $featuredField, true);
    return $value;
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

//Enable page excerpt
//add_post_type_support('page', 'excerpt');

//Custom excerpt word limit
//function custom_excerpt_length($length)
//{
//	global $typenow;
//	$amount = 150;
//	
////	if("page" == $typenow){
////		$amount = 150;
////	}
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
//add_filter( 'upload_size_limit', 'filter_site_upload_size_limit', 20 );

//Hide menu items
//function hide_menu_items() 
//{ 
//	remove_menu_page( 'edit.php' ); //Posts
//	
//	if(!current_user_can('administrator')){
//		remove_menu_page( 'tools.php' ); //Tools
//	}
//}
//add_action( 'admin_menu', 'hide_menu_items' ); 

//Custom menu items order
//function admin_menu_items_order()
//{
//    global $menu;
//    foreach ( $menu as $key => $value ) {
//        if ( 'upload.php' == $value[2] ) {
//            $oldkey = $key;
//        }
//    }
//    $newkey = 24; // use whatever index gets you the position you want
//    // if this key is in use you will write over a menu item!
//    $menu[$newkey]=$menu[$oldkey];
//    $menu[$oldkey]=array();
//}
//add_action('admin_menu', 'admin_menu_items_order');

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
	
	if (!current_user_can('administrator')){
		remove_meta_box( 'simple_history_dashboard_widget', 'dashboard', 'normal' ); //History System
	}
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
//add_filter( 'attachment_fields_to_edit', 'be_attachment_field_credit', 10, 2 );

//Set new attachment fields
//function be_attachment_field_credit_save($post, $attachment)
//{
//	
//	if(isset( $attachment['custom-field']))
//		update_post_meta($post['ID'], 'custom_field_id', $attachment['custom-field']);
//
//	return $post;
//}
//add_filter( 'attachment_fields_to_save', 'be_attachment_field_credit_save', 10, 2 );

//Increase post meta limit
//function customfield_limit_increase($limit)
//{
//  $limit = 100;
//  return $limit;
//}
//add_filter('postmeta_form_limit', 'customfield_limit_increase');

//Register sidebar
//function themename_widgets_init()
//{
//	
//	$nameTHEME = 'websitebase';
//	
//    register_sidebar(array(
//        'name'          => __('Sidebar Custom', $nameTHEME),
//        'id'            => 'custom',
//		//'description'	=> '',  
//        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//        'after_widget'  => '</aside>',
//        'before_title'  => '<h1 class="widget-title">',
//        'after_title'   => '</h1>',
//    ));
//}
//add_action( 'widgets_init', 'themename_widgets_init' );

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
//	$taxonomies = array('deportes');
// 
//	// must set this to the post type you want the filter(s) displayed on
//	if($typenow == 'custom-post-type-1'){
//		
//		foreach ($taxonomies as $tax_slug){
//			$tax_obj = get_taxonomy($tax_slug);
//			$tax_name = $tax_obj->labels->name;
//			$tax_terms = get_terms($tax_slug);
//			//if(count($terms) > 0) {
//				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
//				echo "<option value=''>Show All $tax_name</option>";
//				foreach($tax_terms as $tax_term){ 
//					echo '<option value='. $tax_term->slug, $_GET[$tax_slug] == $tax_term->slug ? ' selected="selected"' : '','>' . $tax_term->name .'</option>'; //(' . $tax_term->count .')
//				}
//				echo "</select>";
//			//}
//		}
//	}
//}
//add_action( 'restrict_manage_posts', 'custom_taxonomy_filter_1' );

//Custom taxonomy
//function create_custom_taxonomy_1() 
//{
//	// Add new taxonomy, make it hierarchical (like categories)
//	$nameFULL = 'Custom Taxonomy';
//	$nameITEM = 'Taxonomy Item';
//	$nameLANG = 0; //0 = English, 1 = Spanish
//	$nameGENDER = 'o'; //a: femenino, o: masculino
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
//add_action( 'init', 'create_custom_taxonomy_1', 0 );

//Custom Post Type 1
//function custom_post_type_1() 
//{
//	// Set UI labels for Custom Post Type
//	$nameFULL = 'Custom Post Type 1';
//	$nameITEM = 'Post Type 1 Item';
//	$nameLANG = 0; //0 = English, 1 = Spanish
//	$nameGENDER = 'o'; //Spanish case to end an item
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
//    register_post_type( $nameSLUG, $menuARGS );
//}
//add_action( 'init', 'custom_post_type_1', 0 );

//Posts data based on content type
//function themename_custom_posts_per_page($query)
//{
//	if(!is_admin()){
//        switch ($query->query_vars['post_type'])
//        {
//            case 'custom-post-type':  // Post Type named 'content_type_name'
//                $query->query_vars['posts_per_page'] = 6; //display all is -1
//                $query->query_vars['order'] = 'DESC';
//                $query->query_vars['orderby'] = 'date';
//                break;
//			
//        }
//        return $query;
//    }
//}
//add_filter( 'pre_get_posts', 'themename_custom_posts_per_page' );

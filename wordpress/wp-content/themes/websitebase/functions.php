<?php

/*
 * Functions PHP
 * © 2017 TriForce - Matías Silva
 *
 * This file calls the main PHP utilities and sets the main HTML data
 * for meta tags in the header file
 * 
 */

//Get the PHP utilities file
require('resources/php/main.php');

//Call the main class
class php extends utilities\php { 

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
				return get_option('blogname'); 
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

//St current page title
function get_page_title($separator){
    if(is_page()){
        $result = ' '.$separator.' '.get_the_title(get_page_by_path(get_query_var('pagename')));
    }
    else if(is_single() OR is_archive()){
        $result = ' '.$separator.' '.get_post_type_object(get_query_var('post_type'))->label;
    }
    else if(is_404()){
        $result = ' '.$separator.' Error';
    }
    else{
        $result = '';
    }
    return $result;
}

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
        register_setting( 'general', $new_field_1[0], 'esc_attr' );
        register_setting( 'general', $new_field_2[0], 'esc_attr' );
        add_settings_field($new_field_1[0], '<label for="'.$new_field_1[0].'">'.$new_field_1[1].'</label>' , array(&$this, $new_field_1[3]) , 'general' );
        add_settings_field($new_field_2[0], '<label for="'.$new_field_2[0].'">'.$new_field_2[1].'</label>' , array(&$this, $new_field_2[3]) , 'general' );
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
		$new_field_data = array("bloganalytics","Analytics Code","Code placed in the HTML head to track site analytics","new_field_1_html");
        echo '<textarea style="max-width: 350px;min-height: 100px;width: 100%;" id="'.$new_field_data[0].'" name="'.$new_field_data[0].'">' . get_option( $new_field_data[0], '' ) . '</textarea>';
		echo '<p class="description" id="'.$new_field_data[0].'-description">'.$new_field_data[2].'</p>';
    }
}

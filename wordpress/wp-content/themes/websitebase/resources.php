<?php

/*
 * PHP Main Stuff
 * TriForce - Matías Silva
 *
 * This file calls the main PHP utilities and sets the main template ones
 * also you can extend the functions below with your own ones
 * 
 */

//Get the PHP utilities file
require_once('resources/php/utilities.php');

//Call the main class
class php extends utilities\php 
{ 
	//Main header data
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
				return get_option('blognavcolor'); 
				break;
			case 'nav-color-apple': 
				return get_option('blognavcolorapple'); 
				break;
			default: break;
		}
	}
	
	//Get extra code section
	public static $section_code = array();

	public static function section($name, $type)
	{
		if(!isset(self::$section_code[$name])){
			self::$section_code[$name] = null; 
		}
		if($type == 'start'){
			return ob_start();
		}
		elseif($type == 'end'){
			return self::$section_code[$name] .= ob_get_clean();
		}
		elseif($type == 'get'){
			return self::$section_code[$name];
		}
	}
	
	//Get main CSS & JS files
	public static $rebuild_pass = 'mypassword';
	
	public static function get_template($type, $get = null)
    {
		$url = get_bloginfo('template_url').'/';
		$local = dirname( __FILE__ ).'/';
		$append = $get != null ? $get : '';
		$route = $type == 'css' ? 'css/style' : 'js/app';
		$ext = $type == 'css' ? '.css' : '.js';
		
		if(php::is_localhost())
		{
			if(file_exists($local.$route.$ext))
			{
				unlink($local.$route.$ext);
			}
			echo $url.$route.'.php'.$append;
		}
		else
		{
			if(isset($_GET['rebuild']) && $_GET['rebuild'] == self::$rebuild_pass)
			{
				if(file_exists($local.$route.$ext))
				{
					if(strcmp(php::get_page_code($url.$route.'.php'.$append), file_get_contents($local.$route.$ext)) !== 0)
					{
						unlink($local.$route.$ext);
					}
				}
			}
			if(!file_exists($local.$route.$ext))
			{
				file_put_contents($local.$route.$ext, php::get_page_code($url.$route.'.php'.$append));
			}
			echo $url.$route.$ext;
		}
	}
}

//Rebuild CSS & JS redirect
if(isset($_GET['rebuild']) && $_GET['rebuild'] == php::$rebuild_pass)
{
	header('Refresh: 0; url='.get_bloginfo('url'));
}

/*
 * Custom Stuff
 * 
 * You can set-up custom stuff or add more functions
 * More resources in http://php.net/manual
 * 
 */

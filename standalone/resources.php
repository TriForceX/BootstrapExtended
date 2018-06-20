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
				return 'en'; 
				break;
			case 'charset': 
				return 'UTF-8'; 
				break;
			case 'title': 
				return 'Website Base'; 
				break;
			case 'description': 
				return 'Base structure for WebSites with CSS/JS/PHP improvements'; 
				break;
			case 'keywords': 
				return 'html, jquery, javascript, php, responsive, css3'; 
				break;
			case 'author': 
				return 'TriForce'; 
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
		$url = php::get_main_url().'/';
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
	header('Location: '.php::get_main_url());
}

/*
 * Custom Stuff
 * 
 * You can set-up custom stuff or add more functions
 * More resources in http://php.net/manual
 * 
 */

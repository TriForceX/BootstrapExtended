<?php

/*
 * PHP Main Stuff
 * TriForce - Matías Silva
 *
 * This file calls the main PHP utilities and sets the main HTML data
 * also you can extend the functions below with your own ones
 * 
 */

//Get the PHP utilities file
require('resources/php/utilities.php');

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
	
	//Get main CSS & JS files
	public static function get_main_theme($type, $get = null)
    {
		$url = php::get_main_url();
		$append = $get != null ? $get : '';
		$route = $type == 'css' ? 'css/style' : 'js/app';
		$ext = $type == 'css' ? '.css' : '.js';
		$file = $url.'/'.$route;
		
		if(php::is_localhost())
		{
			if(file_exists($route.$ext))
			{
				unlink($route.$ext);
			}
			echo $file.'.php'.$append;
		}
		else
		{
			if(file_exists($route.$ext) && isset($_GET['rebuild']))
			{
				if(strcmp(php::get_page_code($file.'.php'.$append), file_get_contents($route.$ext)) !== 0)
				{
					unlink($route.$ext);
				}
				header('Location: '.$url);
			}
			if(!file_exists($route.$ext))
			{
				file_put_contents($route.$ext, php::get_page_code($file.'.php'.$append));
			}
			echo $file.$ext;
		}
	}
	
	//Get extra code
	public static $extra_code = false;

	public static function extra_code($type)
	{
		if($type == 'start'){
			return ob_start();
		}
		elseif($type == 'end'){
			return php::$extra_code .= ob_get_clean();
		}
		elseif($type == 'get'){
			return php::$extra_code;
		}
	}
}

/*
 * Custom Stuff
 * 
 * You can set-up custom stuff or add more functions
 * More resources in http://php.net/manual/
 * 
 */


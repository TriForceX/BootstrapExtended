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
	
	//Get main CSS file
	public static function get_main_css($get = null)
    {
		$append = $get != null ? $get : '';
		$base = php::get_main_url().'/css/style.';
		
		if(php::is_localhost())
		{
			echo $base.'php'.$append;
		}
		else
		{
			echo file_exists('css/style.css') == false ? $base.'php'.$append : $base.'css';
		}
	}
	
	//Get main JS file
	public static function get_main_js($get = null)
    {
		$append = $get != null ? $get : '';
		$base = php::get_main_url().'/js/app.';
		
		if(php::is_localhost())
		{
			echo $base.'php'.$append;
		}
		else
		{
			echo file_exists('js/app.js') == false ? $base.'php'.$append : $base.'js';
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


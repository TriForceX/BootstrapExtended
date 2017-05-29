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
				return 'en'; 
				break;
			case 'charset': 
				return 'utf-8'; 
				break;
			case 'title': 
				return 'Website Base'; 
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
			case 'description': 
				return 'Website based on Bootstrap with some CSS/JS/PHP improvements'; 
				break;
			case 'keywords': 
				return 'html, jquery, javascript, php, responsive, css3'; 
				break;
			case 'author': 
				return 'TriForce'; 
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
 * global variables, etc...
 * 
 */


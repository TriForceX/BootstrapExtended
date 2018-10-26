<?php
/*
 * PHP Main Resources
 * TriForce - Matías Silva
 *
 * This file calls the main PHP utilities and sets the main data (html and rebuild pass)
 * Don't add functions here, You can add your own in functions.php
 * 
 */

//Main Website Base Data
define('websitebase', serialize(array(
	//Fields
	'lang' 				=> get_bloginfo('language'),
	'charset' 			=> get_option('blog_charset'),
	'title' 			=> get_option('blogname'),
	'description' 		=> get_option('blogdescription'),
	'keywords' 			=> get_option('blogkeywords'),
	'author' 			=> get_option('blogauthor'),
	'mobile-capable' 	=> 'yes',
	'viewport' 			=> 'width=device-width, initial-scale=1, user-scalable=no',
	'nav-color' 		=> '#333333',
	'nav-color-apple' 	=> get_option('blognavcolorapple'),
	'timezone' 			=> get_option('timezone_string'),
	'rebuild_pass'		=> 'mypassword',
	'minify'			=> true,
	'mix'				=> true,
	'css_file'			=> array('css/extras/example.css',
								 /*'css/extras/example-2.css',*/
								 /*'css/extras/example-3.css',*/),
	'css_vars'			=> array('$color-custom'	=> '#FF0000',
								 /*'$color-custom-2'	=> '#FFFFFF',*/
								 /*'$color-custom-3'	=> '#FFFFFF',*/ ),
	'js_file'			=> array('js/extras/example.js',
								 /*'js/extras/example-2.js',*/
								 /*'js/extras/example-3.js',*/),
	'js_vars'			=> array('$color-custom'	=> '#FF0000',
								 /*'$color-custom-2'	=> '#FFFFFF',*/
								 /*'$color-custom-3'	=> '#FFFFFF',*/),
)));

//Set Website Base Data
$websitebase = unserialize(constant('websitebase'));

//Get the main PHP utilities
require_once('resources/php/utilities.php');

//Enable main PHP utilities
class php extends utilities\php { }

//Rebuild CSS & JS redirect clean
if(isset($_GET['rebuild']) && $_GET['rebuild'] == $websitebase['rebuild_pass'])
{
	header('Expires: Tue, 01 Jan 2000 00:00:00 GMT');
	header('Last-Modified: '.gmdate("D, d M Y H:i:s").' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');
	header('Location: '.get_bloginfo('url').'?lastbuild');
}
if(isset($_GET['lastbuild']))
{
	header('Location: '.get_bloginfo('url'));
}

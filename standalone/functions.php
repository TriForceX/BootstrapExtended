<?php

/*
 * PHP Main Resources
 * TriForce - Matías Silva
 *
 * This file calls the main PHP utilities and sets the main data (html and rebuild pass)
 * Don't add functions here, You can add your own in functions.php
 * 
 */

// Get the main PHP utilities
require_once('resources/utilities.php');

// Enable main PHP utilities
class php extends utilities\php { }

// Set main Website Base data fields
$websitebase = array(
	'debug'				=> false,
	'lang' 				=> 'en-US',
	'charset' 			=> 'UTF-8',
	'title' 			=> 'Website Base',
	'description' 		=> 'Base structure for websites with CSS/JS/PHP improvements',
	'keywords' 			=> 'html, jquery, javascript, php, responsive, css3',
	'author' 			=> 'TriForce',
	'mobile-capable' 	=> 'yes',
	'viewport' 			=> 'width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no',
	'nav-color' 		=> '#7840a2',
	'nav-color-apple' 	=> 'black',
	'timezone' 			=> 'America/New_York',
	'local_dir'			=> dirname(__FILE__),
	'custom_main_url'	=> false,
	'assets_url'		=> php::get_main_url(),
	'rebuild_pass'		=> 'mypassword',
	'minify'			=> true,
	'mix'				=> true,
	'css_file'			=> array('css/extras/example.css'),
	'css_vars'			=> array('$color-custom'	=> '#FF0000'),
	'js_file'			=> array('js/extras/example.js'),
	'js_vars'			=> array('$color-custom'	=> '#FF0000'),
);

// Set default timezone
date_default_timezone_set($websitebase['timezone']);

// Rebuild CSS & JS redirect clean
php::check_rebuild();

// Check error warnings
php::debug();

/*
 * Custom Stuff
 * 
 * You can set-up custom stuff or add more functions
 * More resources in http://php.net/manual
 * 
 */

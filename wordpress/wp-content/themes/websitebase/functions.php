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
require_once('resources/wordpress.php');

// Enable main PHP utilities
class php extends utilities\php { }

// Set main Website Base data fields
$websitebase = array(
	'debug'				=> false,
	'lang' 				=> get_bloginfo('language'),
	'charset' 			=> get_option('blog_charset'),
	'title' 			=> get_option('blogname'),
	'description' 		=> get_option('blogdescription'),
	'keywords' 			=> get_option('blogkeywords'),
	'author' 			=> get_option('blogauthor'),
	'mobile-capable' 	=> 'yes',
	'viewport' 			=> 'width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no',
	'nav-color' 		=> get_option('blognavcolor'),
	'nav-color-apple' 	=> get_option('blognavcolorapple'),
	'timezone' 			=> wp_get_timezone_string(), // 'America/New_York',
	'local_dir'			=> dirname(__FILE__),
	'custom_main_url'	=> false,
	'assets_url'		=> get_bloginfo('template_url'),
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
 * Wordpress Stuff
 * 
 * Custom functions to load on template
 * More resources in https://codex.wordpress.org
 * 
 */

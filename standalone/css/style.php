<?php

//Show as a CSS file
header('Content-type: text/css; charset: UTF-8');

//Get the main PHP utilities
require_once('../resources/php/utilities.php');

class php extends utilities\php 
{
	public static $css_info = '/*
 * Style.php CSS File Parser
 * Version 2.0
 * TriForce - Matías Silva
 * 
 * Site:     https://dev.gznetwork.com/websitebase
 * Source:   https://github.com/triforcex/websitebase
 * 
 */';
	
	public static function build_css()
	{
		$css_url = php::get_main_url('/css');
		$css_minify = isset($_GET['unminify']) ? false : true;
		
		//Defaults
		$css_data['file'] = array(
								 'style-base.css',
								 'style-bootstrap.css',
								 'style-theme.css',
								 );
		$css_data['vars'] = array(
								 '@global-url'	=> $css_url,
								 '@screen-xs'	=> '480px',
								 '@screen-sm'	=> '768px',
								 '@screen-md'	=> '992px',
								 '@screen-lg'	=> '1200px', 
								 '@screen-xl' 	=> '1920px', 
								 );
		
		include('style-extras.php');
		
		$css_data['file'] = array_merge($css_data['file'], $css_extra['file']);
		$css_data['vars'] = array_merge($css_data['vars'], $css_extra['vars']);

		foreach($css_data['file'] as $css_file){
			$css_buffer .= file_get_contents($css_file);
		}

		$css_key = array_keys($css_data['vars']);
		$css_buffer = str_replace($css_key, $css_data['vars'], $css_buffer);
		$css_content = $css_minify == true ? php::minify_css($css_buffer) : $css_buffer;

		return php::$css_info.$css_content;
	}
}

echo php::build_css();

//php::get_error('warning');

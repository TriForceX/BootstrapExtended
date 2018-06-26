<?php

//Show as a JS file
header('Content-type: text/javascript; charset: UTF-8');

//Get the main PHP utilities
require_once('../resources/php/utilities.php');

class php extends utilities\php 
{
	public static $js_info = '/*
 * App.php JavaScript File Parser
 * Version 2.0
 * TriForce - Matías Silva
 * 
 * Site:     https://dev.gznetwork.com/websitebase
 * Source:   https://github.com/triforcex/websitebase
 * 
 */';
	
	public static function build_js()
	{
		$js_url = php::get_main_url('/js');
		$js_minify = isset($_GET['unminify']) ? false : true;
		
		//Defaults
		$js_data['file'] = array(
								 'app-lang.js',
								 'app-base.js',
								 'app-theme.js',
								 );
		$js_data['vars'] = array(
								 '@global-url'	=> $js_url,
								 '@screen-xs'	=> '480',
								 '@screen-sm'	=> '768',
								 '@screen-md'	=> '992',
								 '@screen-lg'	=> '1200', 
								 '@screen-xl' 	=> '1920', 
								 );
		
		include('app-extras.php');
		
		$js_data['file'] = array_merge($js_data['file'], $js_extra['file']);
		$js_data['vars'] = array_merge($js_data['vars'], $js_extra['vars']);

		foreach($js_data['file'] as $js_file){
			$js_buffer .= file_get_contents($js_file);
		}

		$js_key = array_keys($js_data['vars']);
		$js_buffer = str_replace($js_key, $js_data['vars'], $js_buffer);
		$js_content = $js_minify == true ? php::minify_js($js_buffer) : $js_buffer;

		return php::$js_info.$js_content;
	}
}

echo php::build_js();

//php::get_error('warning');

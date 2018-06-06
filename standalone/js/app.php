<?php

header('Content-type: text/javascript; charset: UTF-8');

$jsInfo = '/*
 * App.php JavaScript File Parser
 * Version 2.0
 * TriForce - Matías Silva
 * 
 * Site:     https://dev.gznetwork.com/websitebase
 * Source:   https://github.com/triforcex/websitebase
 * 
 */';

require_once('../resources/php/utilities.php');

class php extends utilities\php 
{
	public static function build_js()
	{
		$jsMinify = isset($_GET['unminify']) ? false : true;
		$jsBuffer = '';
		$jsUrl = php::get_main_url('/js');

		$jsFiles = array(
					  '../js/app-lang.js',
					  '../js/app-base.js',
					  '../js/app-theme.js',
					);

		$jsVariables = array(
							//Global Url
							'@global-url'	=> $jsUrl,
							//Screen Size
							'@screen-xs'	=> '480',
							'@screen-sm'	=> '768',
							'@screen-md'	=> '992',
							'@screen-lg'	=> '1200', 
							'@screen-xl' 	=> '1920', 
						);

		include('app-extras.php');

		$jsFiles = array_merge($jsFiles, $jsFilesExtras);
		$jsVariables = array_merge($jsVariables, $jsVariablesExtras);

		foreach($jsFiles as $jsFile){
			$jsBuffer .= file_get_contents($jsFile);
		}

		$jsKey = array_keys($jsVariables);
		$jsBuffer = str_replace($jsKey, $jsVariables, $jsBuffer);
		$jsContent = $jsMinify == true ? php::minify_js($jsBuffer) : $jsBuffer;

		return $jsContent;
	}
}

if(php::is_localhost())
{
	if(file_exists('app.js'))
	{
		unlink('app.js');
	}
	echo $jsInfo.php::build_js();
}
else
{
	if(!file_exists('app.js'))
	{
		file_put_contents('app.js', $jsInfo.php::build_js());
	}
	echo file_get_contents('app.js');
}

//php::get_error('warning');

?>
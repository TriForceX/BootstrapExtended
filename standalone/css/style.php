<?php

header('Content-type: text/css; charset: UTF-8');

require_once('../resources/php/utilities.php');

class php extends utilities\php 
{
	public static $cssInfo = '/*
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
		$cssMinify = isset($_GET['unminify']) ? false : true;
		$cssBuffer = '';
		$cssUrl = php::get_main_url('/css');

		$cssFiles = array(
					  '../css/style-base.css',
					  '../css/style-bootstrap.css',
					  '../css/style-theme.css',
					);

		$cssVariables = array(
							//Global Url
							'@global-url'	=> $cssUrl,
							//Screen Size
							'@screen-xs'	=> '480px',
							'@screen-sm'	=> '768px',
							'@screen-md'	=> '992px',
							'@screen-lg'	=> '1200px', 
							'@screen-xl' 	=> '1920px', 
						);

		include('style-extras.php');

		$cssFiles = array_merge($cssFiles, $cssFilesExtras);
		$cssVariables = array_merge($cssVariables, $cssVariablesExtras);

		foreach($cssFiles as $cssFile){
			$cssBuffer .= file_get_contents($cssFile);
		}

		$cssKey = array_keys($cssVariables);
		$cssBuffer = str_replace($cssKey, $cssVariables, $cssBuffer);
		$cssContent = $cssMinify == true ? php::minify_css($cssBuffer) : $cssBuffer;

		return $cssContent;
	}
}

if(php::is_localhost())
{
	if(file_exists('style.css'))
	{
		unlink('style.css');
	}
	echo php::$cssInfo.php::build_css();
}
else
{
	if(file_exists('style.css'))
	{
		if(strcmp(php::$cssInfo.php::build_css(), file_get_contents('style.css')) != 0)
		{
			unlink('style.css');
		}
	}
	if(!file_exists('style.css'))
	{
		file_put_contents('style.css', php::$cssInfo.php::build_css());
	}
	echo file_get_contents('style.css');
}

//php::get_error('warning');

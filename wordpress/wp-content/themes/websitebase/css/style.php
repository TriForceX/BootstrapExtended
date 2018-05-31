<?php

header('Content-type: text/css; charset: UTF-8');

$cssInfo = '/*
 * Style.php CSS File Parser
 * Version 2.0
 * TriForce - Matías Silva
 * 
 * Site:     https://dev.gznetwork.com/websitebase
 * Source:   https://github.com/triforcex/websitebase
 * 
 */';

require_once('../resources/php/utilities.php');
require_once('../resources/php/minifier/minifier.php');

class php extends utilities\php { }

function cssGenerate()
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
						//Global
						'@global-url'	=> $cssUrl,
						//Screen
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
	$cssContent = $cssMinify == true ? minifyCSS($cssBuffer) : $cssBuffer;

	return $cssContent;
}

if(php::is_localhost())
{
	if(file_exists('style.css'))
	{
		unlink('style.css');
	}
	echo $cssInfo.cssGenerate();
}
else
{
	if(!file_exists('style.css'))
	{
		file_put_contents('style.css', $cssInfo.cssGenerate());
	}
	echo file_get_contents('style.css');
}

//php::get_error('warning');

?>
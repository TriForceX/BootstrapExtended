<?php

header('Content-type: text/javascript; charset: UTF-8');

echo '/*
 * App.php JavaScript File Parser
 * Version 2.0
 * TriForce - Matías Silva
 * 
 * Site:     https://dev.gznetwork.com/websitebase
 * Source:   https://github.com/triforcex/websitebase
 * 
 */';

require_once('../resources/php/main.php');
require_once('../resources/php/minifier/minifier.php');

class php extends utilities\php { }

function jsGenerate()
{
	$jsMinify = true;
	$jsBuffer = '';
	$jsUrl = php::get_main_url('/js');

	$jsFiles = array(
				  '../js/app-lang.js',
				  '../js/app-base.js',
				  '../js/app-ready.js',
				  '../js/app-load.js',
				  '../js/app-responsive.js',
				);

	$jsVariables = array(
						//Global Url
						'@global-url' 			=> $jsUrl,
						//Screen Size
						'@screen-small-phone' 	=> '320', 
						'@screen-medium-phone' 	=> '360',
						'@screen-phone' 		=> '480',
						'@screen-tablet' 		=> '768',
						'@screen-desktop' 		=> '992',  
						'@screen-widescreen' 	=> '1200', 
						'@screen-full-hd' 		=> '1920', 
					);

	include('app-extras.php');

	$jsFiles = array_merge($jsFiles, $jsFilesExtras);
	$jsVariables = array_merge($jsVariables, $jsVariablesExtras);

	foreach($jsFiles as $jsFile){
		$jsBuffer .= file_get_contents($jsFile);
	}

	$jsKey = array_keys($jsVariables);
	$jsBuffer = str_replace($jsKey, $jsVariables, $jsBuffer);
	$jsContent = $jsMinify == true ? minifyJS($jsBuffer) : $jsBuffer;

	return $jsContent;
}

if(php::is_localhost())
{
	if(file_exists('app.js'))
	{
		unlink('app.js');
	}
	echo jsGenerate();
}
else
{
	if(!file_exists('app.js'))
	{
		file_put_contents('app.js',jsGenerate());
	}
	echo file_get_contents('app.js');
}

//php::get_error('warning');

?>
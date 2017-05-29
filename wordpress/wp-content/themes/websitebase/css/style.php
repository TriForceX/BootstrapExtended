<?php

header('Content-type: text/css; charset: UTF-8');

echo '/*
 * Style.php CSS File Parser
 * Version 1.0
 * © 2017 TriForce - Matías Silva
 * 
 * Site:     http://dev.gznetwork.com/websitebase
 * Issues:   https://github.com/triforcex/websitebase
 * 
 */';

require_once('../resources/php/minifier/minifier.php');

$cssUrl = minifyGetURL('css');
$cssFiles = array(
			  $cssUrl.'/css/style-base.css',
			  $cssUrl.'/css/style-fonts.css',
			  $cssUrl.'/css/style-theme.css',
			  $cssUrl.'/css/style-example.css',
			);
$cssBuffer = '';
$cssMinify = true;

foreach($cssFiles as $cssFile){
	$cssBuffer .= file_get_contents($cssFile);
}

$cssVariables = array(
					//Screen
					'@screen-small-phone' => '320px', 
					'@screen-medium-phone' => '360px',
					'@screen-phone' => '480px',
					'@screen-tablet' => '768px',
					'@screen-desktop' => '992px',  
					'@screen-widescreen' => '1200px', 
					'@screen-full-hd' => '1920px', 
					//Colors
					'@color-black' => '#000000',
					'@color-white' => '#ffffff',
					'@color-red' => '#ff0000',
					'@color-blue' => '#0000ff',
					'@color-green' => '#008000',
					'@color-lime' => '#00ff00',
					'@color-yellow' => '#ffff00',
					'@color-cyan' => '#00ffff',
					'@color-magenta' => '#ff00ff',
				);

$cssKey = array_keys($cssVariables);
$cssBuffer = str_replace($cssKey, $cssVariables, $cssBuffer);

echo $cssMinify == true ? minifyCSS($cssBuffer) : $cssBuffer;

?>
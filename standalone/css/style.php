<?php

header('Content-type: text/css; charset: UTF-8');

echo '/*
 * Style.php CSS File Parser
 * Version 2.0
 * © 2017 TriForce - Matías Silva
 * 
 * Site:     http://dev.gznetwork.com/websitebase
 * Issues:   https://github.com/triforcex/websitebase
 * 
 */';

require_once('../resources/php/main.php');

class php extends utilities\php { }

$cssDevelopMode = true;
$cssUrl = php::get_main_url('/css');

if($cssDevelopMode):

	require_once('../resources/php/minifier/minifier.php');

	$cssMinify = true;
	$cssBuffer = '';
	$cssFiles = array(
				  $cssUrl.'/css/style-base.css',
				  $cssUrl.'/css/style-fonts.css',
				  $cssUrl.'/css/style-theme.css',
				);

	$cssVariables = array(
						//Global
						'@global-url' => $cssUrl,
						//Screen
						'@screen-small-phone' 	=> '320px', 
						'@screen-medium-phone' 	=> '360px',
						'@screen-phone' 		=> '480px',
						'@screen-tablet' 		=> '768px',
						'@screen-desktop' 		=> '992px',  
						'@screen-widescreen' 	=> '1200px', 
						'@screen-full-hd' 		=> '1920px', 
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

	file_put_contents('style.css',$cssContent);
	echo $cssContent;

else:

	echo file_get_contents('style.css');

endif;

?>
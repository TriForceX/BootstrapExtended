<?php
	header('Content-type: text/css; charset: UTF-8');

	require_once('../plugins/minifier/php/minifier.php');

	$cssUrl = $_GET['url'];
	$cssFiles = array(
				  $cssUrl.'/css/style-fonts.css',
				  $cssUrl.'/css/style-base.css',
				  $cssUrl.'/css/style-theme.css',
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
						'@color-red' => '#ff0000',
						'@color-blue' => '#0000ff',
						'@color-green' => '#00ff00',
						'@color-yellow' => '#ffff00',
					);

	$cssKey = array_keys($cssVariables);
  	$cssBuffer = str_replace($cssKey, $cssVariables, $cssBuffer);

    echo $cssMinify == true ? minifyCSS($cssBuffer) : $cssBuffer;
?>
<?php
	header('Content-type: text/javascript; charset: UTF-8');

	require_once('../resources/minifier.php');

	$jsUrl = $_GET['url'];
	$jsFiles = array(
				  $jsUrl.'/js/app-base.js',
				  $jsUrl.'/js/app-ready.js',
				  $jsUrl.'/js/app-load.js',
				  $jsUrl.'/js/app-responsive.js',
				);
    $jsBuffer = '';
	$jsMinify = true;

    foreach($jsFiles as $jsFile){
    	$jsBuffer .= file_get_contents($jsFile);
    }

	$jsVariables = array(
						//Screen
						'@screen-small-phone' => '320', 
						'@screen-medium-phone' => '360',
						'@screen-phone' => '480',
						'@screen-tablet' => '768',
						'@screen-desktop' => '992',  
						'@screen-widescreen' => '1200', 
						'@screen-full-hd' => '1920', 
						//Global
						'@global-url' => $jsUrl,
					);

	$jsKey = array_keys($jsVariables);
  	$jsBuffer = str_replace($jsKey, $jsVariables, $jsBuffer);
	
    echo $jsMinify == true ? minifyJS($jsBuffer) : $jsBuffer;
?>
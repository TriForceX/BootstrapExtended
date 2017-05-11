<?php
	header('Content-type: text/javascript; charset: UTF-8');

	require_once('../plugins/minifier/php/minifier.php');

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
						//Validation
						'@validate-title' => 'Form Alert', 
						'@validate-text' => 'Please fill the fields.', 
						'@validate-pass' => 'Please fill your password.', 
						'@validate-email' => 'Please type a correct E-Mail.',
						'@validate-search' => 'Please fill the search field.', 
						'@validate-checkbox' => 'Please check an option.',
						'@validate-textarea' => 'Please write a message.',
						'@validate-select' => 'Please select an option.',
						//Video launch
						'@videolaunch-title' => 'Share Link', 
						'@videolaunch-text' => 'Copy & paste this URL to share',
						//Search input
						'@searchinput-title' => 'Search', 
						'@searchinput-text' => 'Please fill the search field.', 
					);

	$jsKey = array_keys($jsVariables);
  	$jsBuffer = str_replace($jsKey, $jsVariables, $jsBuffer);
	
    echo $jsMinify == true ? minifyJS($jsBuffer) : $jsBuffer;
?>
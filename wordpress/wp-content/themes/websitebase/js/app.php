<?php

header('Content-type: text/javascript; charset: UTF-8');

echo '/*
 * App.php JavaScript File Parser
 * Version 1.0
 * © 2017 TriForce - Matías Silva
 * 
 * Site:     http://dev.gznetwork.com/websitebase
 * Issues:   https://github.com/triforcex/websitebase
 * 
 */';

require_once('../resources/php/minifier/minifier.php');

$jsUrl = minifyGetURL('js');
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
					'@validate-normal' => 'Please fill the fields.', 
					'@validate-number' => 'Please type a valid number.', 
					'@validate-tel' => 'Please type a phone number.', 
					'@validate-pass' => 'Please fill your password.', 
					'@validate-email' => 'Please type a correct E-Mail.',
					'@validate-search' => 'Please fill the search field.', 
					'@validate-checkbox' => 'Please check an option.',
					'@validate-radio' => 'Please check one of the options.',
					'@validate-textarea' => 'Please write a message.',
					'@validate-select' => 'Please select an option.',
					'@validate-confirm-title' => 'Form Confirm', 
					'@validate-confirm-text' => 'Are you sure you want to send the previous info?', 
					//Video launch
					'@videolaunch-title' => 'Share Link', 
					'@videolaunch-text' => 'The share link has been copied!',
					//Map launch
					'@maplaunch-title' => 'Map Select',
					'@maplaunch-text' => 'Select one of options below',
					//Check disabled
					'@disabled-text' => 'Este contenido esta deshabilitado por el momento.',
					//Lightgallery
					'@lgtitle-prev' => 'Loading previous page ...',
					'@lgtitle-next' => 'Loading next page ...',
				);

$jsKey = array_keys($jsVariables);
$jsBuffer = str_replace($jsKey, $jsVariables, $jsBuffer);

echo $jsMinify == true ? minifyJS($jsBuffer) : $jsBuffer;

?>
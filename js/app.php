<?php
	header("Content-type: text/javascript; charset: UTF-8");

	require_once('../resources/curl.php');

	$jsUrl = $_GET['url'];
	$jsFiles = array(
				  $jsUrl."/js/app-functions.js",
				  $jsUrl."/js/app-ready.js",
				  $jsUrl."/js/app-load.js",
				);
	$jsStart = '/*JS Start*/';
	$jsEnd = '/*JS End*/';
    $jsBuffer = '';

    foreach ($jsFiles as $jsFile) {
    	$jsBuffer .= extract_unit(LoadCURLPage($jsFile), $jsStart, $jsEnd);
    }

	$jsVariables = array(
						//Screen
						"@screen-phone-sm" => "320", 
						"@screen-phone-md" => "360",
						"@screen-phone-lg" => "480",
						"@screen-tablet" => "768",
						"@screen-desktop-md" => "992", 
						"@screen-desktop-lg" => "1024", 
						"@screen-widescreen-md" => "1200", 
						"@screen-widescreen-lg" => "1400", 
						"@screen-full-hd" => "1920", 
						//Global
						"@global-url" => $jsUrl,
					);

	foreach ($jsVariables as $jsKey => $jsValue){
		
		$jsBuffer = str_replace($jsKey, $jsValue, $jsBuffer);
	}
	
    echo $jsBuffer;
?>
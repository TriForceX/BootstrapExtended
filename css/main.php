<?php
	header("Content-type: text/css; charset: UTF-8");

	require_once('../resources/curl.php');

	$cssUrl = $_GET['url'];
	$cssFiles = array(
				  $cssUrl."/css/main-fonts.css",
				  $cssUrl."/css/main-base.css",
				  $cssUrl."/css/main-theme.css",
				);
	$cssStart = '/*CSS Start*/';
	$cssEnd = '/*CSS End*/';
    $cssBuffer = '';

    foreach ($cssFiles as $cssFile) {
    	$cssBuffer .= extract_unit(LoadCURLPage($cssFile), $cssStart, $cssEnd);
    }

	$cssVariables = array(
						//Screen
						"@screen-phone-sm" => "320px", 
						"@screen-phone-md" => "360px",
						"@screen-phone-lg" => "480px",
						"@screen-tablet" => "768px",
						"@screen-desktop-md" => "992px", 
						"@screen-desktop-lg" => "1024px", 
						"@screen-widescreen-md" => "1200px", 
						"@screen-widescreen-lg" => "1400px", 
						"@screen-full-hd" => "1920px", 
						//Colors
						"@color-red" => "#ff0000",
						"@color-blue" => "#0000ff",
						"@color-green" => "#00ff00",
					);

	foreach ($cssVariables as $cssKey => $cssValue){
		
		$cssBuffer = str_replace($cssKey, $cssValue, $cssBuffer);
	}
	
    echo $cssBuffer;
?>
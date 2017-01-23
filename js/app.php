<?php
	header("Content-type: text/javascript; charset: UTF-8");

	require_once('../resources/curl.php');

	$jsUrl = $_GET['url'];
	$jsFile1 = $jsUrl."/js/app-functions.js";
	$jsFile2 = $jsUrl."/js/app-ready.js";
	$jsFile3 = $jsUrl."/js/app-load.js";
	$jsStart = '/*JS Start*/';
	$jsEnd = '/*JS End*/';

	$jsGet1 = extract_unit(LoadCURLPage($jsFile1), $jsStart, $jsEnd);
	$jsGet2 = extract_unit(LoadCURLPage($jsFile2), $jsStart, $jsEnd);
	$jsGet3 = extract_unit(LoadCURLPage($jsFile3), $jsStart, $jsEnd);

	//Cargar Functions
	echo $jsGet1."\n";
	//Cargar Functions
	echo '$(document).ready(function(){ '."\n";
	//Cargar Document Ready
	echo $jsGet2."\n";;
	//Cargar Document Ready
		echo '$(window).bind("load", function() {'."\n";
		//Cargar Windows Load
		echo $jsGet3."\n";
		//Cargar Windows Load
		echo '});'."\n";
	echo '});';

	
?>
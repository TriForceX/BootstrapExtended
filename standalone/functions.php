<?php
//Get the PHP utilities file
require 'plugins/utilities.php';

//Call the main class
class php extends utilities\php { }

































//PHP Error Handler
if(isset($_GET['debug'])){
	if($_GET['debug']=='handler'){
		function error_handler($output)
		{
			$error = error_get_last();
			$output = "";
			foreach ($error as $info => $string)
				$output .= "{$info}: {$string}<br>";
			return $output;
		}
		ob_start('error_handler');
	}
	else{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}
}

//Get info
if (!function_exists('get_bloginfo')){
	function get_bloginfo($info){
		//Main Url
		$baseProtocol = empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off' ? 'http://' : 'https://';
		$baseUrl = $baseProtocol.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
		//Check Url
		switch($info){
			case 'url':
				$finalResult = $baseUrl;
				break;
			case 'protocol':
				$finalResult = $baseProtocol;
				break;
			case 'template_url':
				$finalResult = $baseUrl;
				break;
			default: 
				$finalResult = $baseUrl;
				break;
		}
		return $finalResult;
	}
}

//Check Home
if (!function_exists('is_home')){
	function is_home(){
		//Main url
		$baseProtocol = empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off' ? 'http://' : 'https://';
		$baseUrl = $baseProtocol.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
		//Check Home
		$scriptBase = $baseUrl.'/index.php';
		$scriptTarget = $_SERVER['SCRIPT_NAME'];
		$finalResult = strpos($scriptBase,$scriptTarget);
		return $finalResult;
	}
}


//Check Current Page
function get_pagetitle(){
	//Wordpress
	if (function_exists('is_page') AND
	    function_exists('is_single') AND
	    function_exists('is_archive') AND
	    function_exists('is_404')){
		if(is_page()){
			$finalResult = ' &raquo; '.get_the_title(get_page_by_path(get_query_var('pagename')));
		}
		else if(is_single() OR is_archive()){
			$finalResult = ' &raquo; '.get_post_type_object(get_query_var('post_type'))->label;
		}
		else if(is_404()){
			$finalResult = ' &raquo; Error';
		}
		else{
			$finalResult = '';
		}
	}
	//Standalone
	else{
		if(strpos($_SERVER['SCRIPT_NAME'],'example.php')){
			$finalResult = ' &raquo; Example';
		}
		else{
			$finalResult = '';
		}
	}
	return $finalResult;
}
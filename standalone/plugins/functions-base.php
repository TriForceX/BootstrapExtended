<?php

//PHP Error Handler
if(isset($_GET['debug'])){
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

//Check Localhost
if (!function_exists('is_localhost')){
	function is_localhost(){
		$isLocalHost = $_SERVER['HTTP_HOST'] == 'localhost' || filter_var($_SERVER['HTTP_HOST'], FILTER_VALIDATE_IP) ? true : false;
		$finalResult = $isLocalHost;
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

//Get W~bsite part
function getWebsitePart($url,$start,$end){
	require_once('curl/php/curl.php');
	$data = LoadCURLPage($url);
	$info = extract_unit($data, $start, $endo);
	return $info;
}

//UTF8 string conversion
function convertToUTF8($text) {
    // map based on:
    // http://konfiguracja.c0.pl/iso02vscp1250en.html
    // http://konfiguracja.c0.pl/webpl/index_en.html#examp
    // http://www.htmlentities.com/html/entities/
    $map = array(
        chr(0x8A) => chr(0xA9),
        chr(0x8C) => chr(0xA6),
        chr(0x8D) => chr(0xAB),
        chr(0x8E) => chr(0xAE),
        chr(0x8F) => chr(0xAC),
        chr(0x9C) => chr(0xB6),
        chr(0x9D) => chr(0xBB),
        chr(0xA1) => chr(0xB7),
        chr(0xA5) => chr(0xA1),
        chr(0xBC) => chr(0xA5),
        chr(0x9F) => chr(0xBC),
        chr(0xB9) => chr(0xB1),
        chr(0x9A) => chr(0xB9),
        chr(0xBE) => chr(0xB5),
        chr(0x9E) => chr(0xBE),
        chr(0x80) => '&euro;',
        chr(0x82) => '&sbquo;',
        chr(0x84) => '&bdquo;',
        chr(0x85) => '&hellip;',
        chr(0x86) => '&dagger;',
        chr(0x87) => '&Dagger;',
        chr(0x89) => '&permil;',
        chr(0x8B) => '&lsaquo;',
        chr(0x91) => '&lsquo;',
        chr(0x92) => '&rsquo;',
        chr(0x93) => '&ldquo;',
        chr(0x94) => '&rdquo;',
        chr(0x95) => '&bull;',
        chr(0x96) => '&ndash;',
        chr(0x97) => '&mdash;',
        chr(0x99) => '&trade;',
        chr(0x9B) => '&rsquo;',
        chr(0xA6) => '&brvbar;',
        chr(0xA9) => '&copy;',
        chr(0xAB) => '&laquo;',
        chr(0xAE) => '&reg;',
        chr(0xB1) => '&plusmn;',
        chr(0xB5) => '&micro;',
        chr(0xB6) => '&para;',
        chr(0xB7) => '&middot;',
        chr(0xBB) => '&raquo;',
    );
    return html_entity_decode(mb_convert_encoding(strtr($text, $map), 'UTF-8', 'ISO-8859-2'), ENT_QUOTES, 'UTF-8');
}

//Cut excerpt
function cutExcerpt($getText,$num) {
    
    if(strlen($getText) > $num){
        $getText = substr($getText, 0,$num)."...";
    }
    
    return $getText;
}

//Custom get date format
function showDate($date, $format, $lang, $abbr){
	
	$newDate = strtotime($date);
	$finalDate = date($format, $newDate);
	$langSet = $lang == 'esp' ? 1 : 0;
	
	/*$langDays = array(
					//English
					array("Sun" => "Sunday",
						  "Mon" => "Monday",
						  "Tue" => "Tuesday",
						  "Wed" => "Wednesday",
						  "Thu" => "Thursday",
						  "Fri" => "Friday",
						  "Sat" => "Saturday"),
					//Spanish
					array("Dom" => "Domingo",
						  "Lun" => "Lunes",
						  "Mar" => "Martes",
						  "Mié" => "Miércoles",
						  "Jue" => "Jueves",
						  "Vie" => "Viernes",
						  "Sáb" => "Sábado"),
				);
	
	$langMonths = array(
					//English
					array("Jan" => "January",
						  "Feb" => "February",
						  "Mar" => "March",
						  "Apr" => "April",
						  "May" => "May",
						  "Jun" => "June",
						  "Jul" => "July ",
						  "Aug" => "August",
						  "Sept" => "September",
						  "Oct" => "October",
						  "Nov" => "November",
						  "Dec" => "December"),
					//Spanish
					array("Ene" => "Enero",
						  "Feb" => "Febrero",
						  "Mar" => "Marzo",
						  "Abr" => "Abril",
						  "May" => "Mayo",
						  "Jun" => "Junio",
						  "Jul" => "Julio",
						  "Ago" => "Agosto",
						  "Sept" => "Septiembre",
						  "Oct" => "Octubre",
						  "Nov" => "Noviembre",
						  "Dic" => "Diciembre"),
				  );*/
	
	
	$langDays = array(
					array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"),
					array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"),
				);
	$langDaysAbbr = array(
						array("Sun","Mon","Tue","Wed","Thu","Fri","Sat"),
						array("Dom","Lun","Mar","Mié","Jue","Vie","Sáb"),
					);
	$langMonths = array(
					array("January","February","March","April","May","June","July ","August","September","October","November","December"),
					array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre", "Diciembre"),
				  );
	$langMonthsAbbr = array(
						array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec"),
						array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sept","Oct","Nov","Dic"),
					  );

	
	for ($row = 0; $row < 7; $row++)
	{
		if($abbr){
			$finalDate = str_replace($langDays[0][$row], $langDaysAbbr[$langSet][$row], $finalDate);
		}
		else{
			$finalDate = str_replace($langDays[0][$row], $langDays[$langSet][$row], $finalDate);
		}
	}
	for ($row = 0; $row < 12; $row++)
	{
		if($abbr){
			$finalDate = str_replace($langMonths[0][$row], $langMonthsAbbr[$langSet][$row], $finalDate);
		}
		else{
			$finalDate = str_replace($langMonths[0][$row], $langMonths[$langSet][$row], $finalDate);
		}
	}
	return $finalDate;
}

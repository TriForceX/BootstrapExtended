<?php

//Redirect
//header('Location: http://url'); exit;

//Debug
if(isset($_GET['debug'])){
	
	ini_set('error_prepend_string','<div class="alert alert-danger" role="alert">');
	ini_set('error_append_string','</div>');
	ini_set('html_errors', 0);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL); //E_ERROR | E_STRICT | E_WARNING | E_NOTICE | E_ALL
}
//Debug

//Check Home Page
function is_home(){
	
	$baseProtocol = (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') ? 'http://' : 'https://';
	$baseUrl = $baseProtocol.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
	
	$scriptBase = $baseUrl.'/index.php';
	$scriptTarget = $_SERVER['SCRIPT_NAME'];
	
	return strpos($scriptBase,$scriptTarget);
}
//Check Home Page

//Get info
function get_siteinfo($info){
	
	$baseProtocol = (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') ? 'http://' : 'https://';
	$baseUrl = $baseProtocol.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
	
	switch($info){
		case 'url':
			echo $baseUrl;
			break;
		case 'protocol':
			echo $baseUrl;
			break;
		case 'page':
			if(strpos($_SERVER['SCRIPT_NAME'],'index.php')){
				echo 'Home';
			}
			elseif(strpos($_SERVER['SCRIPT_NAME'],'example.php')){
				echo 'Examples';
			}
			else{
				echo 'Page';
			}
			break;
		default: 
			echo $baseUrl;
			break;
	}
}
//Get info

//UTF9 Conversion
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
//UTF9 Conversion

//Cut Excerpt
function cutExcerpt($getText,$num) {
    
    if(strlen($getText) > $num){
        $getText = substr($getText, 0,$num)."...";
    }
    
    return $getText;
}
//Cut Excerpt

//Date String WIP
function showDate($date, $format, $lang, $abbr){
	
	$newDate = strtotime($date);
	$finalDate = date($format, $newDate);
	$langSet = $lang == 'esp' ? 1 : 0;
	
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
						array("Jan","Feb","Mar","Apr","May","Jun","Jul ","Aug","Sept","Oct","Nov","Dec"),
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
//Date String WIP


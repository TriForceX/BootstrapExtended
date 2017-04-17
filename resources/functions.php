<?php

//Redirect
//header('Location: http://url'); exit;

//Debug
if(isset($_GET['debug'])){
	error_reporting(E_ALL);
}

//Base URL
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
    $basePROTOCOL = 'http://';
} else {
    $basePROTOCOL = 'https://';
}

$baseURL = $basePROTOCOL.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
$baseHOME = strpos($_SERVER['SCRIPT_NAME'],'index.php');
//Base URL

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
};
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
function dateString($show, $abbr, $date, &lang){
	$fechaDato = $date;

	$mesesPalabras = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$mesesCortar = &abbr;

	$fechaDia = date('d', strtotime($fechaDato));
	if($mesesCortar){

			$fechaMesPrev = $mesesPalabras[date('n', strtotime($fechaDato))-1];

			if($fechaMesPrev == "Septiembre"){
					$fechaMes = substr($fechaMesPrev, 0,4);
			}
			else{
					$fechaMes = substr($fechaMesPrev, 0,3);
			}
	}
	else{
			$fechaMes = $mesesPalabras[date('n', strtotime($fechaDato))-1];
	}
	$fechaAnio = date('Y', strtotime($fechaDato));
	
	if($show == 'day'){
		
	}
	elseif($show == 'month'){
		
	}
	else{
		
	}
}
//Date String WIP

?>
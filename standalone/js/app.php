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

$jsLang = isset($_GET['lang']) ? $_GET['lang'] : 0; //0 = English, 1 = Spanish
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
					'@screen-small-phone' 	=> '320', 
					'@screen-medium-phone' 	=> '360',
					'@screen-phone' 		=> '480',
					'@screen-tablet' 		=> '768',
					'@screen-desktop' 		=> '992',  
					'@screen-widescreen' 	=> '1200', 
					'@screen-full-hd' 		=> '1920', 
					//Global
					'@global-url' => $jsUrl,
					//Validation
					'@validate-title' 			=> array('Form Alert', 'Alerta Formulario')[$jsLang], 
					'@validate-normal' 			=> array('Please fill the fields.', 'Por favor complete los campos.')[$jsLang], 
					'@validate-number'	 		=> array('Please type a valid number.', 'Por favor escriba un número válido.')[$jsLang], 
					'@validate-tel' 			=> array('Please type a phone number.', 'Por favor escriba un teléfono válido.')[$jsLang], 
					'@validate-pass' 			=> array('Please fill your password.', 'Por favor complete su clave.')[$jsLang], 
					'@validate-email' 			=> array('Please type a correct E-Mail.', 'Por favor escriba un E-Mail válido.')[$jsLang],
					'@validate-search' 			=> array('Please fill the search field.', 'Por favor complete el campo de busqueda.')[$jsLang], 
					'@validate-checkbox' 		=> array('Please check an option.', 'Por favor elija una(s) opción(es).')[$jsLang],
					'@validate-radio' 			=> array('Please check one of the options.')[$jsLang],
					'@validate-textarea' 		=> array('Please write a message.', 'Por favor escriba un mensaje.')[$jsLang],
					'@validate-select' 			=> array('Please select an option.' ,'Por favor seleccione una opción.')[$jsLang],
					'@validate-confirm-title' 	=> array('Form Confirm')[$jsLang], 
					'@validate-confirm-text' 	=> array('Are you sure you want to send the previous info?', '¿Estas seguro de que deseas enviar el formulario?')[$jsLang], 
					//Video launch
					'@videolaunch-title' 		=> array('Share Link', 'Compartir Enlace')[$jsLang], 
					'@videolaunch-text' 		=> array('The share link has been copied!', '¡El enlace ha sido copiado!')[$jsLang],
					//Map launch
					'@maplaunch-title' 			=> array('Map Select', 'Mapa Dirección')[$jsLang],
					'@maplaunch-text' 			=> array('Select one of options below', 'Seleccione una de las opciones')[$jsLang],
					//Check disabled
					'@disabled-text' 			=> array('Este contenido esta deshabilitado por el momento.', 'Este contenido esta deshabilitado por el momento.')[$jsLang],
					//Lightgallery
					'@lgtitle-prev' 			=> array('Loading previous page ...', 'Cargando página anterior ...')[$jsLang],
					'@lgtitle-next' 			=> array('Loading next page ...', 'Cargando siguiente página ...')[$jsLang],
				);

$jsKey = array_keys($jsVariables);
$jsBuffer = str_replace($jsKey, $jsVariables, $jsBuffer);

echo $jsMinify == true ? minifyJS($jsBuffer) : $jsBuffer;

?>
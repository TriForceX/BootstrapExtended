<?php

header('Content-type: text/javascript; charset: UTF-8');

echo '/*
 * App.php JavaScript File Parser
 * Version 2.0
 * TriForce - Matías Silva
 * 
 * Site:     http://dev.gznetwork.com/websitebase
 * Issues:   https://github.com/triforcex/websitebase
 * 
 */';

require_once('../resources/php/main.php');
require_once('../resources/php/minifier/minifier.php');

class php extends utilities\php { }

//php::get_error('warning');

$jsSeparate = isset($_GET['separate']) ? 1 : 0;
$jsLanguage = isset($_GET['language']) ? $_GET['language'] : 0;

function jsGenerate()
{
	global $jsLanguage;
	
	$jsMinify = true;
	$jsBuffer = '';
	$jsUrl = php::get_main_url('/js');

	$jsFiles = array(
				  $jsUrl.'/js/app-base.js',
				  $jsUrl.'/js/app-ready.js',
				  $jsUrl.'/js/app-load.js',
				  $jsUrl.'/js/app-responsive.js',
				);

	$jsVariables = array(
						//Global
						'@global-url' => $jsUrl,
						//Screen
						'@screen-small-phone' 	=> '320', 
						'@screen-medium-phone' 	=> '360',
						'@screen-phone' 		=> '480',
						'@screen-tablet' 		=> '768',
						'@screen-desktop' 		=> '992',  
						'@screen-widescreen' 	=> '1200', 
						'@screen-full-hd' 		=> '1920', 
						//Form Validation
						'@validate-title' 			=> $jsLanguage == 1 ? 'Alerta Formulario' : 'Form Alert', 
						'@validate-normal' 			=> $jsLanguage == 1 ? 'Por favor complete los campos.' : 'Please fill the fields.', 
						'@validate-number'	 		=> $jsLanguage == 1 ? 'Por favor escriba un número válido.' : 'Please type a valid number.', 
						'@validate-tel' 			=> $jsLanguage == 1 ? 'Por favor escriba un teléfono válido.' : 'Please type a phone number.', 
						'@validate-pass' 			=> $jsLanguage == 1 ? 'Por favor complete su clave.' : 'Please fill your password.', 
						'@validate-email' 			=> $jsLanguage == 1 ? 'Por favor escriba un E-Mail válido.' : 'Please type a correct E-Mail.',
						'@validate-search' 			=> $jsLanguage == 1 ? 'Por favor complete el campo de busqueda.' : 'Please fill the search field.', 
						'@validate-checkbox' 		=> $jsLanguage == 1 ? 'Por favor elija opciones.' : 'Please check an option.',
						'@validate-radio' 			=> $jsLanguage == 1 ? 'Por favor elija una de las opciones.' : 'Please check one of the options.',
						'@validate-textarea' 		=> $jsLanguage == 1 ? 'Por favor escriba un mensaje.' : 'Please write a message.',
						'@validate-select' 			=> $jsLanguage == 1 ? 'Por favor seleccione una opción.' : 'Please select an option.',
						'@validate-confirm-title' 	=> $jsLanguage == 1 ? 'Confirmar Formulario' : 'Form Confirm', 
						'@validate-confirm-text' 	=> $jsLanguage == 1 ? '¿Estas seguro de que deseas enviar el formulario?' : 'Are you sure you want to send the previous info?', 
						//Video launch
						'@videolaunch-title' 		=> $jsLanguage == 1 ? 'Compartir Enlace' : 'Share Link', 
						'@videolaunch-text' 		=> $jsLanguage == 1 ? '¡El enlace ha sido copiado!' : 'The share link has been copied!',
						//Map launch
						'@maplaunch-title' 			=> $jsLanguage == 1 ? 'Mapa Dirección' : 'Map Select',
						'@maplaunch-text' 			=> $jsLanguage == 1 ? 'Seleccione una de las opciones' : 'Select one of options below',
						//Check disabled
						'@disabled-text' 			=> $jsLanguage == 1 ? 'Este contenido esta deshabilitado por el momento.' : 'This content is currently disabled.',
						//Lightgallery
						'@lgtitle-prev' 			=> $jsLanguage == 1 ? 'Cargando página anterior ...' : 'Loading previous page ...',
						'@lgtitle-next' 			=> $jsLanguage == 1 ? 'Cargando siguiente página ...' : 'Loading next page ...',
					);

	include('app-extras.php');

	$jsFiles = array_merge($jsFiles, $jsFilesExtras);
	$jsVariables = array_merge($jsVariables, $jsVariablesExtras);

	foreach($jsFiles as $jsFile){
		$jsBuffer .= file_get_contents($jsFile);
	}

	$jsKey = array_keys($jsVariables);
	$jsBuffer = str_replace($jsKey, $jsVariables, $jsBuffer);
	$jsContent = $jsMinify == true ? minifyJS($jsBuffer) : $jsBuffer;

	return $jsContent;
}

if(php::is_localhost())
{
	if(file_exists('app.js'))
	{
		unlink('app.js');
	}
	if(file_exists('app-'.$jsLanguage.'.js'))
	{
		unlink('app-'.$jsLanguage.'.js');
	}
	
	echo jsGenerate();
}
else
{
	if($jsSeparate)
	{
		if(!file_exists('app-'.$jsLanguage.'.js'))
		{
			file_put_contents('app-'.$jsLanguage.'.js',jsGenerate());
		}
		echo file_get_contents('app-'.$jsLanguage.'.js');
	}
	else
	{
		if(!file_exists('app.js'))
		{
			file_put_contents('app.js',jsGenerate());
		}
		echo file_get_contents('app.js');
	}
	
}

?>
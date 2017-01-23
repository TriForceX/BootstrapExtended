<?php

//Redirect
//header('Location: http://url'); exit;

//Debug
//error_reporting(E_ALL);

//Base URL
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
    $basePROTOCOL = 'http://';
} else {
    $basePROTOCOL = 'https://';
}

$baseURL = $basePROTOCOL.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
$baseHOME = strpos($_SERVER['SCRIPT_NAME'],'index.php');
//Base URL

?>
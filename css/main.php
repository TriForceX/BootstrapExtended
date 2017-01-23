<?php
	header("Content-type: text/css; charset: UTF-8");

	require_once('../resources/curl.php');

	$cssUrl = $_GET['url'];
	$cssFile1 = $cssUrl."/css/system.css";
	$cssFile2 = $cssUrl."/css/theme.css";
	$cssFile3 = $cssUrl."/css/responsive.css";
	$cssStart = '/*CSS Start*/';
	$cssEnd = '/*CSS End*/';

	$cssGet1 = extract_unit(LoadCURLPage($cssFile1), $cssStart, $cssEnd);
	$cssGet2 = extract_unit(LoadCURLPage($cssFile2), $cssStart, $cssEnd);
	$cssGet3 = extract_unit(LoadCURLPage($cssFile3), $cssStart, $cssEnd);

	$cssVar = array(
			  array("#azul-claro","#486ca5"),
			  array("#azul-oscuro","#034074"),
			  array("#gris-claro","#e9e9e9"),
			  array("#gris-medio","#dddddd"),
			  array("#gris-oscuro","#aeaeb3"),
			  array("#negro-claro","#333333"),
			  array("#negro-medio","#888888"),
			  );

	for ($cssRow = 0; $cssRow < count($cssVar); $cssRow++)
	{
		$cssGet1 = str_replace($cssVar[$cssRow][0],$cssVar[$cssRow][1], $cssGet1);
		$cssGet2 = str_replace($cssVar[$cssRow][0],$cssVar[$cssRow][1], $cssGet2);
		$cssGet3 = str_replace($cssVar[$cssRow][0],$cssVar[$cssRow][1], $cssGet3);
	}

	echo $cssGet1."\n";
	echo $cssGet2."\n";
	echo $cssGet3."\n";

?>
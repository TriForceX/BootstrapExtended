<?php

/*
 * PHP Main Stuff
 * TriForce - Matías Silva
 *
 * This file calls the main PHP utilities and sets the main HTML data
 * also you can extend the functions below with your own ones
 * 
 */

//Get the PHP utilities file
require('resources/php/utilities.php');

//PHP error handler
if(isset($_GET['debug'])){
	php::get_error($_GET['debug']);
}

//Call the main class
class php extends utilities\php 
{ 
	//Main header data
	public static function get_html_data($type)
    {
		switch($type){
			case 'lang': 
				return 'en'; 
				break;
			case 'charset': 
				return 'UTF-8'; 
				break;
			case 'title': 
				return 'Website Base'; 
				break;
			case 'description': 
				return 'Base structure for WebSites with CSS/JS/PHP improvements'; 
				break;
			case 'keywords': 
				return 'html, jquery, javascript, php, responsive, css3'; 
				break;
			case 'author': 
				return 'TriForce'; 
				break;
			case 'mobile-capable': 
				return 'yes'; 
				break;
			case 'viewport': 
				return 'width=device-width, initial-scale=1, user-scalable=no'; 
				break;
			case 'nav-color': 
				return '#333333'; 
				break;
			case 'nav-color-apple': 
				return 'black'; 
				break;
			default: break;
		}
	}
	
	//Get main CSS file
	public static function get_main_css($get = null)
    {
		$append = $get != null ? $get : '';
		
		if(php::is_localhost())
		{
			if(file_exists('css/style.css'))
			{
				unlink('css/style.css');
			}
			echo php::get_main_url().'/css/style.php'.$append;
		}
		else
		{
			if(!file_exists('css/style.css'))
			{
				echo php::get_main_url().'/css/style.php'.$append;
			}
			else
			{
				echo php::get_main_url().'/css/style.css';
			}
		}
	}
	
	//Get main JS file
	public static function get_main_js($get = null)
    {
		$append = $get != null ? $get : '';
		
		if(php::is_localhost())
		{
			if(file_exists('js/app.js'))
			{
				unlink('js/app.js');
			}
			echo php::get_main_url().'/js/app.php'.$append;
		}
		else
		{
			if(!file_exists('js/app.js'))
			{
				echo php::get_main_url().'/js/app.php'.$append;
			}
			else
			{
				echo php::get_main_url().'/js/app.js';
			}
		}
	}
	
	//Get custom date format
	public static function show_date($date = false, $format = 'Y-m-d', $lang = 'eng', $abbr = false){

		if(!$date){
			$date = date('Y-m-d');
		}
		
		$newDate = strtotime($date);
		$finalDate = date($format, $newDate);
		$langSet = $lang == 'esp' ? 1 : 0;
		$langAbbr = $abbr ? 1 : 0;

		$langDays = array(
						array(
							array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"),
							array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"),
						),
						array(
							array("Sun","Mon","Tue","Wed","Thu","Fri","Sat"),
							array("Dom","Lun","Mar","Mié","Jue","Vie","Sáb"),
						)
					);
		
		$langMonths = array(
							array(
								array("January","February","March","April","May","June","July ","August","September","October","November","December"),
								array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre", "Diciembre"),
							),
							array(
								array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec"),
								array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sept","Oct","Nov","Dic"),
							)
						);


		for ($day = 0; $day < 7; $day++)
		{
			$finalDate = str_replace($langDays[0][0][$day], $langDays[$langAbbr][$langSet][$day] , $finalDate);
		}
		for ($month = 0; $month < 12; $month++)
		{
			$finalDate = str_replace($langMonths[0][0][$month], $langMonths[$langAbbr][$langSet][$month], $finalDate);
		}
		
		return $finalDate;
	}
	
	//Get video embed url
	public static function get_embed_video($url,$autoplay = false)
	{
		$videoCode = '';
		$videoURL = '';
		$videoAutplay = $autoplay === true ? 1 : 0;

		if(php::str_contains($url,'youtube')){
			preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $url, $videoCode);
			$videoURL = 'https://www.youtube.com/embed/'.$videoCode[7].'?rel=0&autoplay='.$videoAutplay;
		}
		elseif(php::str_contains($url,'vimeo')){
			preg_match('/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/', $url, $videoCode);
			$videoURL = 'https://player.vimeo.com/video/'.$videoCode[5].'?autoplay='.$videoAutplay;
		}
		elseif(php::str_contains($url,'facebook')){
			$videoURL = 'https://www.facebook.com/plugins/video.php?href='.$url.'&show_text=0&autoplay='.$videoAutplay;
		}

		return $videoURL;
	}
	
	//Get video id
	public static function get_video_id($url)
	{
		$videoCode = '';
		$videoID = '';

		if(php::str_contains($url,'youtube')){
			preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $url, $videoCode);
			$videoID = $videoCode[7];
		}
		elseif(php::str_contains($url,'vimeo')){
			preg_match('/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/', $url, $videoCode);
			$videoID = $videoCode[5];
		}
		elseif(php::str_contains($url,'facebook')){
			$videoID = $url;
		}

		return $videoID;
	}

	//Custom paginator
	public static function custom_paginator($offset, $limit, $totalnum, $customclass, $customLeft = '&laquo;', $customRight = '&laquo;', $append = false, $parentDiv = false){

		if($append == false){
			$append = get_bloginfo('url').'/'.get_query_var('post_type').'/'.get_the_slug($post->ID).'/?';
		}
		
		if ($totalnum > $limit)
		{
			$pages = intval($totalnum / $limit);

			if ($totalnum % $limit)
			$pages++;

			if(($offset + $limit) > $totalnum){
				$lastnum = $totalnum;
			}else{
				$lastnum = ($offset + $limit);
			}
			if (isset($_GET['pag'])){ 
				$pageCurrent = $_GET['pag'];
			}
			else{
				$pageCurrent = 1;
			}
			$pagePrev = $pageCurrent-1; $pageNumPrev = ($pageCurrent*$limit)-$limit*2;
			$pageNext = $pageCurrent+1; $pageNumNext = $pageCurrent*$limit;
			if($pagePrev <= 1){
				$pagePrev = 1;
				$pageNumPrev = 0;
			} 
			if($pageNext > $pages){
				$pageNext = $_GET['pag'];
				$pageNumNext = $_GET['num'];
			}
			if($parentDiv != false){
				echo '<div class="'.$parentDiv.'">';
			}
			echo '<div class="JSpaginator '.$customclass.'"><div class="JSpageItems">';
			echo '<a class="JSpagePrev" href="'.$append.'pag='.$pagePrev.'&num='.$pageNumPrev.'">'.$customLeft.'</a>';	
				for ($i = 1; $i <= $pages; $i++) {  // loop thru 
					$newoffset = $limit * ($i - 1);

					if ($newoffset != $offset) 
					{
						echo '<a href="'.$append.'pag='.$i.'&num='.$newoffset.'">'.$i.'</a>';
					} 
					else
					{
						echo '<a href="'.$append.'pag='.$i.'&num='.$newoffset.'" class="JSpageActive">'.$i.'</a>';
					}

				}
			echo '<a class="JSpageNext" href="'.$append.'pag='.$pageNext.'&num='.$pageNumNext.'">'.$customRight.'</a>';
			echo '</div></div>';
			if($parentDiv != false){
				echo '</div>';
			}
		}
		return;
	}
}

/*
 * Custom Stuff
 * 
 * You can set-up custom stuff or add more functions
 * More resources in http://php.net/manual/
 * 
 */


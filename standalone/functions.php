<?php

/*
 * Functions PHP
 * © 2017 TriForce - Matías Silva
 *
 * This file calls the main PHP utilities and sets the main HTML data
 * for meta tags in the header file
 * 
 */

//Get the PHP utilities file
require('resources/php/main.php');

//Call the main class
class php extends utilities\php { 

	public static function get_html_data($type)
    {
		switch($type){
			case 'lang': 
				return 'en-US'; 
				break;
			case 'charset': 
				return 'UTF-8'; 
				break;
			case 'title': 
				return 'Website Base'; 
				break;
			case 'description': 
				return 'Website based on Bootstrap with some CSS/JS/PHP improvements'; 
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
				return '#FF0000'; 
				break;
			case 'nav-color-apple': 
				return 'black'; 
				break;
			default: break;
		}
	}
}

//PHP error handler
if(isset($_GET['debug'])){
	php::get_error($_GET['debug']);
}

/*
 * PHP Aditional Stuff
 * 
 * You can add more stuff above such as more functions, 
 * global variables, wordpress stuff, etc...
 * 
 */

function getEmbedVideo($url,$autoplay = false)
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

//Custom paginator for galleries
function customPaginator($offset, $limit, $totalnum, $customclass){

	if ($totalnum > $limit) {
		// calculate number of pages needing links 
		$pages = intval($totalnum / $limit);

		// $pages now contains int of pages needed unless there is a remainder from division 
		if ($totalnum % $limit)
		$pages++;

		if(($offset + $limit) > $totalnum){
			$lastnum = $totalnum;
		}else{
			$lastnum = ($offset + $limit);
		}
		if (isset($_GET['pag'])) { 
			$paginaActual = $_GET['pag'];
		}
		else{
			$paginaActual = 1;
		}
		$paginaAnterior = $paginaActual-1; $paginaOffsetAnt = ($paginaActual*$limit)-$limit*2;
		$paginaSiguiente = $paginaActual+1; $paginaOffsetSig = $paginaActual*$limit;
		if($paginaAnterior < $paginaActual){
			$paginaAnterior = 1;
			$paginaOffsetAnt = 0;
		} 
		if($paginaSiguiente > $pages ){
			$paginaSiguiente = $_GET['pag'];
			$paginaOffsetSig = $_GET['offset'];
		}
		echo '<div class="paginador '.$customclass.'"><div class="items">';
		echo '<a class="prev" href="'.get_bloginfo('url').'/'.get_query_var('post_type').'/'.get_the_slug($post->ID).'/?offset='.$paginaOffsetAnt.'&pag='.$paginaAnterior.'">&laquo;</a>';	
			for ($i = 1; $i <= $pages; $i++) {  // loop thru 
				$newoffset = $limit * ($i - 1);

				if ($newoffset != $offset) 
				{
					echo '<a href="'.get_bloginfo('url').'/'.get_query_var('post_type').'/'.get_the_slug($post->ID).'/?offset='.$newoffset.'&pag='.$i.'">'.$i.'</a>';
				} 
				else
				{
					echo '<a href="'.get_bloginfo('url').'/'.get_query_var('post_type').'/'.get_the_slug($post->ID).'/?offset='.$newoffset.'&pag='.$i.'" class="active">'.$i.'</a>';
				}

			}
		echo '<a class="next" href="'.get_bloginfo('url').'/'.get_query_var('post_type').'/'.get_the_slug($post->ID).'/?offset='.$paginaOffsetSig.'&pag='.$paginaSiguiente.'">&raquo;</a>';	
		echo '</div></div>';
	}
	return;
}

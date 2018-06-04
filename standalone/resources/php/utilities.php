<?php

namespace utilities;

/*
 * PHP Functions Utilities
 * Version 2.0
 * TriForce - Matías Silva
 * 
 * Site:     https://dev.gznetwork.com/websitebase
 * Source:   https://github.com/triforcex/websitebase
 * 
 */

class php
{
	//PHP error handle & warnings
	public static function get_error($type)
    {
		if($type=='handler'){
			ob_start(function($outputt) {
					// ... modify content ...
					$error = error_get_last();
					$output = "";
					foreach ($error as $info => $string)
						$output .= "{$info}: {$string}<br>";
					return $output;
				}
			);
		}
		elseif($type=='warning'){
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
		}
	}
	
    //Check if a string starts with the given string.
    public static function starts_with($string, $starts_with)
    {
        return strpos($string, $starts_with) === 0;
    }

    //Check if a string ends with the given string.
    public static function ends_with($string, $ends_with)
    {
        return substr($string, -strlen($ends_with)) === $ends_with;
    }

    //Check if a string contains another string.
    public static function str_contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }

    //Check if a string contains another string. This version is case insensitive.
    public static function str_icontains($haystack, $needle)
    {
        return stripos($haystack, $needle) !== false;
    }

    //Strip all witespaces from the given string.
    public static function strip_space($string)
    {
        return preg_replace('/\s+/', '', $string);
    }
	
	//Converts many english words that equate to true or false to boolean.
    public static function str_to_bool($string, $default = false)
    {
        $yes_words = 'affirmative|all right|aye|indubitably|most assuredly|ok|of course|okay|sure thing|y|yes+|yea|yep|sure|yeah|true|t|on|1|oui|vrai';
        $no_words = 'no*|no way|nope|nah|na|never|absolutely not|by no means|negative|never ever|false|f|off|0|non|faux';

        if (preg_match('/^(' . $yes_words . ')$/i', $string)) {
            return true;
        } elseif (preg_match('/^(' . $no_words . ')$/i', $string)) {
            return false;
        }

        return $default;
    }
	
	//Converts all accent characters to normal characters
    public static function remove_accents($string)
    {
       $unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
		$string = strtr( $string, $unwanted_array );
		
		return $string;
    }

    //Sanitize a string by performing the following operation 
    public static function sanitize_string($string)
    {
        $string = self::remove_accents($string);
        $string = strtolower($string);
        $string = preg_replace('/[^a-zA-Z 0-9]+/', '', $string);
        $string = self::strip_space($string);

        return $string;
    }
    
	//Convert strings to URL slug type
    public static function slugify($string, $separator = '-', $css_mode = false)
    {
        // Compatibility with 1.0.* parameter ordering for semvar
        if ($separator === true || $separator === false) {
            $css_mode = $separator;
            $separator = '-';

            // Raise deprecation error
            trigger_error('util::slugify() now takes $css_mode as the third parameter, please update your code', E_USER_DEPRECATED);
        }

        $slug = preg_replace('/([^a-z0-9]+)/', $separator, strtolower(self::remove_accents($string)));

        if ($css_mode) {
            $digits = array('zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine');

            if (is_numeric(substr($slug, 0, 1))) {
                $slug = $digits[substr($slug, 0, 1)] . substr($slug, 1);
            }
        }

        return $slug;
    }
	
    //Convert the string to given length of charactes.
    public static function limit_characters($string, $limit = 100, $append = '...')
    {
        if (mb_strlen($string) <= $limit) {
            return $string;
        }

        return rtrim(mb_substr($string, 0, $limit, 'UTF-8')) . $append;
    }

    //Convert the string to given length of words.
    public static function limit_words($string, $limit = 100, $append = '...')
    {
        preg_match('/^\s*+(?:\S++\s*+){1,' . $limit . '}/u', $string, $matches);

        if (!isset($matches[0]) || strlen($string) === strlen($matches[0])) {
            return $string;
        }

        return rtrim($matches[0]).$append;
    }
	
	//Check if is the main index page
	public static function is_home()
	{
		$base = self::get_main_url().'/index.php';
		$target = $_SERVER['SCRIPT_NAME'];
		return strpos($base,$target);
    }
	
	//Check if the current domain is localhost
	public static function is_localhost($custom = null)
    {
		$whitelist = array('127.0.0.', '192.168.', '::1', 'localhost');
		$passed = false;
		if($custom != null){
			$whitelist[] = $custom;
		}
		foreach ($whitelist as $item) {
			if (stripos($_SERVER['HTTP_HOST'], $item) !== false) {
				$passed = true;
			}
		}
        return $passed;
    }
	
	//Checks to see if the page is being server over SSL or not
    public static function is_https()
    {
        return isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off';
    }
	
	//Returns the IP address of the client.
    public static function get_client_ip($trust_proxy_headers = false)
    {
        if (!$trust_proxy_headers) {
            return $_SERVER['REMOTE_ADDR'];
        }

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
	
	//Returns main domain also if is in a folder
	public static function get_main_url($remove = null)
    {
		$protocol = self::is_https() ? 'https://' : 'http://';
		$domain = $protocol.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
		
		if($remove != null){
			$domain = str_replace($remove,'',$domain);
		}
		
		return $domain;
    }
	
	//Return the current URL.
    public static function get_current_url($queryStrings = true)
    {
        $url = '';

        // Check to see if it's over https
        $is_https = self::is_https();
		
        if($is_https){
            $url .= 'https://';
        }else{
            $url .= 'http://';
        }

        // Was a username or password passed?
        if(isset($_SERVER['PHP_AUTH_USER'])){
            $url .= $_SERVER['PHP_AUTH_USER'];

            if (isset($_SERVER['PHP_AUTH_PW'])){
                $url .= ':' . $_SERVER['PHP_AUTH_PW'];
            }

            $url .= '@';
        }

        // We want the user to stay on the same host they are currently on,
        // but beware of security issues
        // see http://shiflett.org/blog/2006/mar/server-name-versus-http-host
        $url .= $_SERVER['HTTP_HOST'];

        $port = $_SERVER['SERVER_PORT'];

        // Is it on a non standard port?
        if($is_https && ($port != 443)){
            $url .= ':' . $_SERVER['SERVER_PORT'];
        }elseif(!$is_https && ($port != 80)){
            $url .= ':' . $_SERVER['SERVER_PORT'];
        }

        // Get the rest of the URL
        if(!isset($_SERVER['REQUEST_URI'])){
            // Microsoft IIS doesn't set REQUEST_URI by default
            $url .= $_SERVER['PHP_SELF'];

            if(isset($_SERVER['QUERY_STRING'])){
                $url .= '?' . $_SERVER['QUERY_STRING'];
            }
        }else{
            $url .= $_SERVER['REQUEST_URI'];
        }
		
		if(!$queryStrings){
			$url = strtok($url,'?');
		}

        return $url;
    }
	
	//Convert page file name to words
	public static function get_page_title($separator)
    {
		$file = $_SERVER['SCRIPT_NAME'];
		$file = substr($file, strrpos($file, '/') + 1);
		$result = preg_replace('/\.php|.html(?=\s|$)/', '', $file);
		$result = preg_replace('/[\.\,\:\-\_]+/', ' ', $result);
		$result = ' '.$separator.' '.ucwords($result);
		
        if(strpos($file,'index')){
			$result = ' '.$separator.' '.ucwords($result);
		}
		else{
			$result = '';
		}
		return $result;
    }
	
	//Convert string to UTF8
	public static function convert_to_utf8($string)
    {
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
		return html_entity_decode(mb_convert_encoding(strtr($string, $map), 'UTF-8', 'ISO-8859-2'), ENT_QUOTES, 'UTF-8');
	}
	
	//Get page code using cUrl
	public static function get_page_code($url, $start, $end)
	{
		//Curl Init
		$curlAgent = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.89 Safari/537.36';
		$curlInit = curl_init();
		curl_setopt($curlInit, CURLOPT_URL, $url);
		curl_setopt($curlInit, CURLOPT_HEADER, 0);
		curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
		if($curlAgent){
			curl_setopt($curlInit, CURLOPT_USERAGENT, $curlAgent);
		}
		$curlInitResult = curl_exec($curlInit);
		curl_close($curlInit);

		//Curl Parse
		$curlStartPos = stripos($curlInitResult, $start);
		$curlStartStr = substr($curlInitResult, $curlStartPos);
		$curlEndStr = substr($curlStartStr, strlen($start));
		$curlEndPos = stripos($curlEndStr, $end);
		$curlFinish = substr($curlEndStr, 0, $curlEndPos);
		return trim($curlFinish);
	}
}

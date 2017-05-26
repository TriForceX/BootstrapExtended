<?php

namespace utilities;

/*

Utilities PHP Functions Utilities
Version 1.0
© 2017 TriForce - Matías Silva

Site:     http://dev.gznetwork.com/websitebase
Issues:   https://github.com/triforcex/websitebase

*/

class php
{
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

    //Sanitize a string by performing the following operation 
    public static function sanitize_string($string)
    {
        $string = self::remove_accents($string);
        $string = strtolower($string);
        $string = preg_replace('/[^a-zA-Z 0-9]+/', '', $string);
        $string = self::strip_space($string);

        return $string;
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
	public static function is_localhost()
    {
        return $_SERVER['HTTP_HOST'] == 'localhost' || filter_var($_SERVER['HTTP_HOST'], FILTER_VALIDATE_IP) ? true : false;
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
	public static function get_main_url()
    {
        $protocol = self::is_https() ? 'https://' : 'http://';
		return $protocol.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
    }
	
	//Return the current URL.
    public static function get_current_url()
    {
        $url = '';

        // Check to see if it's over https
        $is_https = self::is_https();
        if ($is_https) {
            $url .= 'https://';
        } else {
            $url .= 'http://';
        }

        // Was a username or password passed?
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $url .= $_SERVER['PHP_AUTH_USER'];

            if (isset($_SERVER['PHP_AUTH_PW'])) {
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
        if ($is_https && ($port != 443)) {
            $url .= ':' . $_SERVER['SERVER_PORT'];
        } elseif (!$is_https && ($port != 80)) {
            $url .= ':' . $_SERVER['SERVER_PORT'];
        }

        // Get the rest of the URL
        if (!isset($_SERVER['REQUEST_URI'])) {
            // Microsoft IIS doesn't set REQUEST_URI by default
            $url .= $_SERVER['PHP_SELF'];

            if (isset($_SERVER['QUERY_STRING'])) {
                $url .= '?' . $_SERVER['QUERY_STRING'];
            }
        } else {
            $url .= $_SERVER['REQUEST_URI'];
        }

        return $url;
    }
	
	public static function get_page_title()
    {
		$file = $_SERVER['SCRIPT_NAME'];
		$file = substr($file, strrpos($file, '/') + 1);
		$title = str_replace('.php','',$file);
		
        /*if(strpos(,'example.php')){
			$finalResult = ' &raquo; Example';
		}
		else{
			$finalResult = '';
		}*/
		
		return $title;
    }
}

<?php

namespace utilities;

/*
 * PHP Functions Utilities
 * Version 3.0
 * TriForce - Matías Silva
 * 
 * Site:     https://dev.gznetwork.com/websitebase
 * Source:   https://github.com/triforcex/websitebase
 * 
 */

class php
{
	// Main header data
	public static function get_html_data($type)
    {
		// Main data
		$websitebase = unserialize(constant('websitebase'));
		return $websitebase[$type]; 
	}
	
	// CSS, JS & HTML Minifier
	public static function minify_code($type, $input)
	{
		switch($type)
		{
			case 'css':
				if(trim($input) === "") return $input;
				return preg_replace(
					array(
						// Remove comment(s)
						'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
						// Remove unused white-space(s)
						'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
						// Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
						'#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
						// Replace `:0 0 0 0` with `:0`
						'#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
						// Replace `background-position:0` with `background-position:0 0`
						'#(background-position):0(?=[;\}])#si',
						// Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
						'#(?<=[\s:,\-])0+\.(\d+)#s',
						// Minify string value
						'#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
						'#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
						// Minify HEX color code
						'#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
						// Replace `(border|outline):none` with `(border|outline):0`
						'#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
						// Remove empty selector(s)
						'#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
					),
					array(
						'$1',
						'$1$2$3$4$5$6$7',
						'$1',
						':0',
						'$1:0 0',
						'.$1',
						'$1$3',
						'$1$2$4$5',
						'$1$2$3',
						'$1:0',
						'$1$2'
					),
				$input);
				break;
			case 'js':
				if(trim($input) === "") return $input;
				return preg_replace(
					array(
						// Remove comment(s)
						'#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
						// Remove white-space(s) outside the string and regex
						'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
						// Remove the last semicolon
						'#;+\}#',
						// Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
						'#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
						// --ibid. From `foo['bar']` to `foo.bar`
						'#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
					),
					array(
						'$1',
						'$1$2',
						'}',
						'$1$3',
						'$1.$3'
					),
				$input);
				break;
			case 'html':
				if(trim($input) === "") return $input;
				// Remove extra white-space(s) between HTML attribute(s)
				$input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
					return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
				}, str_replace("\r", "", $input));
				// Minify inline CSS declaration(s)
				if(strpos($input, ' style=') !== false) {
					$input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function($matches) {
						return '<' . $matches[1] . ' style=' . $matches[2] . self::minify_css($matches[3]) . $matches[2];
					}, $input);
				}
				if(strpos($input, '</style>') !== false) {
				  $input = preg_replace_callback('#<style(.*?)>(.*?)</style>#is', function($matches) {
					return '<style' . $matches[1] .'>'. self::minify_css($matches[2]) . '</style>';
				  }, $input);
				}
				if(strpos($input, '</script>') !== false) {
				  $input = preg_replace_callback('#<script(.*?)>(.*?)</script>#is', function($matches) {
					return '<script' . $matches[1] .'>'. self::minify_js($matches[2]) . '</script>';
				  }, $input);
				}

				return preg_replace(
					array(
						// t = text
						// o = tag open
						// c = tag close
						// Keep important white-space(s) after self-closing HTML tag(s)
						'#<(img|input)(>| .*?>)#s',
						// Remove a line break and two or more white-space(s) between tag(s)
						'#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
						'#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
						'#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
						'#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
						'#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
						'#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
						'#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
						'#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
						// Remove HTML comment(s) except IE comment(s)
						'#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
					),
					array(
						'<$1$2<$1>',
						'$1$2$3',
						'$1$2$3',
						'$1$2$3$4$5',
						'$1$2$3$4$5$6$7',
						'$1$2$3',
						'<$1$2',
						'$1 ',
						'$1',
						""
					),
				$input);
				break;
			default: break;
		}
		
	}
	
	// Get extra code section
	public static $section_code = array();

	public static function section($name, $type)
	{
		if(!isset(self::$section_code[$name])){
			self::$section_code[$name] = null; 
		}
		if($type == 'start'){
			return ob_start();
		}
		elseif($type == 'end'){
			return self::$section_code[$name] .= ob_get_clean();
		}
		elseif($type == 'get'){
			return self::$section_code[$name];
		}
	}
	
	// Build CSS & JS template files
	public static function build_template($type, $minify = true, $mix = true, $url)
	{
		// Main data
		$websitebase = unserialize(constant('websitebase'));
		
		$info = '/*
 * '.($type == 'css' ? 'StyleSheet' : 'Javascript').' File Parser
 * Version 3.0
 * TriForce - Matias Silva
 * 
 * Site:     https://dev.gznetwork.com/websitebase
 * Source:   https://github.com/triforcex/websitebase
 * 
 */';
		$local = str_replace('resources/php', '', dirname( __FILE__ ));
		$final = $type == 'css' ? 'style.css' : 'app.js';
		$buffer = null;
		
		// Defaults
		$data['file'] = $type == 'css' ? array('css/style-base.css',
											   'css/style-bootstrap.css',
											   'css/style-theme.css') :
										 array('js/app-init.js',
											   'js/app-base.js',
											   'js/app-theme.js');
		
		$data['vars'] = array('$global-url'	=> $url,
							  '$screen-xs'	=> $type == 'css' ? '480px' : '480',
							  '$screen-sm'	=> $type == 'css' ? '768px' : '768',
							  '$screen-md'	=> $type == 'css' ? '992px' : '992',
							  '$screen-lg'	=> $type == 'css' ? '1200px' : '1200',
							  '$screen-xl' 	=> $type == 'css' ? '1920px' : '1920');
		
		$data['file'] = array_merge($data['file'], $websitebase[$type.'_file']);
		$data['vars'] = array_merge($data['vars'], $websitebase[$type.'_vars']);
		
		if($mix)
		{
			foreach($data['file'] as $file)
			{
				$buffer .= file_get_contents($local.'/'.$file);
				$file_mix = str_replace('.'.$type, '.min.'.$type, $file);

				if(file_exists($local.'/'.$file_mix))
				{
					unlink($local.'/'.$file_mix);
				}
			}

			$key = array_keys($data['vars']);
			$buffer = str_replace($key, $data['vars'], $buffer);
			$content = $minify == true ? self::minify_code($type, $buffer) : $buffer;

			file_put_contents($local.'/'.$type.'/'.$final, $info.$content);

			if($type == 'css')
			{
				echo '<link href="'.$url.'/css/'.$final.'" rel="stylesheet">'."\n";
			}
			else
			{
				echo '<script src="'.$url.'/js/'.$final.'"></script>'."\n";
			}
		}
		else
		{
			foreach($data['file'] as $file)
			{
				$buffer = file_get_contents($local.'/'.$file);
				$key = array_keys($data['vars']);
				$buffer = str_replace($key, $data['vars'], $buffer);
				$content = $minify == true ? self::minify_code($type, $buffer) : $buffer;
				$file_mix = str_replace('.'.$type, '.min.'.$type, $file);

				if(file_exists($local.'/'.$type.'/'.$final))
				{
					unlink($local.'/'.$type.'/'.$final);
				}

				file_put_contents($local.'/'.$file_mix, $info.$content);

				if($type == 'css')
				{
					echo '<link href="'.$url.'/'.$file_mix.'" rel="stylesheet">'."\n".($file === end($data['file']) ? '' : "\t");
				}
				else
				{
					echo '<script src="'.$url.'/'.$file_mix.'"></script>'."\n";
				}
			}
		}
	}
	
	// Get main CSS & JS files
	public static function get_template($type, $url)
    {
		// Main data
		$websitebase = unserialize(constant('websitebase'));
		
		$local = str_replace('resources/php', '', dirname( __FILE__ ));
		$final = $type == 'css' ? 'style.css' : 'app.js';
		
		$minify = $websitebase['minify'];
		$mix = $websitebase['mix'];
		
		$compare = true;
		
		if(self::is_localhost())
		{
			return self::build_template($type, $minify, $mix, $url);
		}
		else
		{
			if($mix)
			{
				if(isset($_GET['rebuild']) && $_GET['rebuild'] == $websitebase['rebuild_pass'])
				{
					return self::build_template($type, $minify, $mix, $url);
				}
				else
				{
					if($type == 'css')
					{
						echo '<link href="'.$url.'/css/'.$final.'" rel="stylesheet">'."\n";
					}
					else
					{
						echo '<script src="'.$url.'/js/'.$final.'"></script>'."\n";
					}
				}
			}
			else
			{
				$data['file'] = $type == 'css' ? array('css/style-base.css',
													   'css/style-bootstrap.css',
													   'css/style-theme.css') :
												 array('js/app-init.js',
													   'js/app-base.js',
													   'js/app-theme.js');

				$data['file'] = array_merge($data['file'], $websitebase[$type.'_file']);
				
				if(isset($_GET['rebuild']) && $_GET['rebuild'] == $websitebase['rebuild_pass'])
				{
					return self::build_template($type, $minify, $mix, $url);
				}
				else
				{
					foreach($data['file'] as $file)
					{
						$file_mix = str_replace('.'.$type, '.min.'.$type, $file);
						
						if($type == 'css')
						{
							echo '<link href="'.$url.'/'.$file_mix.'" rel="stylesheet">'."\n".($file === end($data['file']) ? '' : "\t");
						}
						else
						{
							echo '<script src="'.$url.'/'.$file_mix.'"></script>'."\n";
						}
					}
				}
			}
		}
	}
	
    // Check if a string starts with the given string.
    public static function starts_with($string, $starts_with)
    {
        return strpos($string, $starts_with) === 0;
    }

    // Check if a string ends with the given string.
    public static function ends_with($string, $ends_with)
    {
        return substr($string, -strlen($ends_with)) === $ends_with;
    }

    // Check if a string contains another string.
    public static function str_contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }

    // Check if a string contains another string. This version is case insensitive.
    public static function str_icontains($haystack, $needle)
    {
        return stripos($haystack, $needle) !== false;
    }
	
	// Check if a string is different with another.
    public static function str_compare($first, $second)
    {
        return strcmp($first, $second) !== 0;
    }
	
	// Check if a string is different with another. This version is case insensitive.
    public static function str_icompare($first, $second)
    {
        return strcasecmp($first, $second) !== 0;
    }

    // Strip all witespaces from the given string.
    public static function strip_space($string)
    {
        return preg_replace('/\s+/', '', $string);
    }
	
	// Converts many english words that equate to true or false to boolean.
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
	
	// Converts all accent characters to normal characters
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

    // Sanitize a string by performing the following operation 
    public static function sanitize_string($string)
    {
        $string = self::remove_accents($string);
        $string = strtolower($string);
        $string = preg_replace('/[^a-zA-Z 0-9]+/', '', $string);
        $string = self::strip_space($string);

        return $string;
    }
    
	// Convert strings to URL slug type
    public static function slugify($string, $separator = '-', $css_mode = false)
    {
        // Compatibility with 1.0.* parameter ordering for semvar
        if ($separator === true || $separator === false){
            $css_mode = $separator;
            $separator = '-';

            // Raise deprecation error
            trigger_error('util::slugify() now takes $css_mode as the third parameter, please update your code', E_USER_DEPRECATED);
        }

        $slug = preg_replace('/([^a-z0-9]+)/', $separator, strtolower(self::remove_accents($string)));

        if($css_mode){
            $digits = array('zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine');

            if(is_numeric(substr($slug, 0, 1))){
                $slug = $digits[substr($slug, 0, 1)] . substr($slug, 1);
            }
        }
        return $slug;
    }
	
    // Convert the string to given length of charactes.
    public static function limit_characters($string, $limit = 100, $append = '...')
    {
        if (mb_strlen($string) <= $limit){
            return $string;
        }
        return rtrim(mb_substr($string, 0, $limit, 'UTF-8')) . $append;
    }

    // Convert the string to given length of words.
    public static function limit_words($string, $limit = 100, $append = '...')
    {
        preg_match('/^\s*+(?:\S++\s*+){1,' . $limit . '}/u', $string, $matches);

        if(!isset($matches[0]) || strlen($string) === strlen($matches[0])){
            return $string;
        }
        return rtrim($matches[0]).$append;
    }
	
	// Check if is the main index page
	public static function is_home()
	{
		$base = self::get_main_url().'/index.php';
		$target = $_SERVER['SCRIPT_NAME'];
		return strpos($base,$target);
    }
	
	// Check if the current domain is localhost
	public static function is_localhost($custom = null)
    {
		$baselist = preg_match('/(::1|127.0.0.|192.168.|localhost)/i', $_SERVER['HTTP_HOST']);
		$whitelist = $custom != null ? preg_match('/('.$custom.')/i', $_SERVER['HTTP_HOST']) : false;

		return $baselist || $whitelist ? true : false;
    }
	
	// Checks to see if the page is being server over SSL or not
    public static function is_https()
    {
        return isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off';
    }
	
	// Returns the IP address of the client.
    public static function get_client_ip($trust_proxy_headers = false)
    {
        if(!$trust_proxy_headers){
            return $_SERVER['REMOTE_ADDR'];
        }
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
		else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
	
	// Returns main domain also if is in a folder
	public static function get_main_url($remove = null)
    {
		$protocol = self::is_https() ? 'https://' : 'http://';
		$domain = $protocol.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
		
		if($remove != null){
			$domain = str_replace($remove,'',$domain);
		}
		return $domain;
    }
	
	// Return the current URL.
    public static function get_current_url($queryRemove = false)
    {
        $url = '';

        // Check to see if it's over https
        $is_https = self::is_https();
		
        if($is_https){
            $url .= 'https://';
        }
		else{
            $url .= 'http://';
        }
        // Was a username or password passed?
        if(isset($_SERVER['PHP_AUTH_USER'])){
            $url .= $_SERVER['PHP_AUTH_USER'];

            if(isset($_SERVER['PHP_AUTH_PW'])){
                $url .= ':' . $_SERVER['PHP_AUTH_PW'];
            }
            $url .= '@';
        }

        // We want the user to stay on the same host they are currently on, but beware of security issues. See http://shiflett.org/blog/2006/mar/server-name-versus-http-host
        $url .= $_SERVER['HTTP_HOST'];
        $port = $_SERVER['SERVER_PORT'];

        // Is it on a non standard port?
        if($is_https && ($port != 443)){
            $url .= ':' . $_SERVER['SERVER_PORT'];
        }
		elseif(!$is_https && ($port != 80)){
            $url .= ':' . $_SERVER['SERVER_PORT'];
        }
        // Get the rest of the URL
        if(!isset($_SERVER['REQUEST_URI'])){
            // Microsoft IIS doesn't set REQUEST_URI by default
            $url .= $_SERVER['PHP_SELF'];

            if(isset($_SERVER['QUERY_STRING'])){
                $url .= '?' . $_SERVER['QUERY_STRING'];
            }
        }
		else{
            $url .= $_SERVER['REQUEST_URI'];
        }
		if($queryRemove){
			$url = rtrim(strtok($url,'?'), '/');
		}
        return $url;
    }
	
	// Access an array index, retrieving the value stored there if it exists or a default if it does not
    public static function array_get(&$var, $default = null)
    {
        if(isset($var)){
            return $var;
        }
        return $default;
    }
	
	// Add or remove query arguments to the URL
    public static function add_query_arg($newKey, $newValue = null, $uri = null)
    {
        // Was an associative array of key => value pairs passed?
        if(is_array($newKey)){
            $newParams = $newKey;

            // Was the URL passed as an argument?
            if (!is_null($newValue)) {
                $uri = $newValue;
            } elseif (!is_null($uri)) {
                $uri = $uri;
            } else {
                $uri = self::array_get($_SERVER['REQUEST_URI'], '');
            }
        }
		else{
            $newParams = array($newKey => $newValue);

            // Was the URL passed as an argument?
            $uri = is_null($uri) ? self::array_get($_SERVER['REQUEST_URI'], '') : $uri;
        }

        // Parse the URI into it's components
        $puri = parse_url($uri);

        if(isset($puri['query'])){
            parse_str($puri['query'], $queryParams);
            $queryParams = array_merge($queryParams, $newParams);
        }
		elseif(isset($puri['path']) && strstr($puri['path'], '=') !== false){
            $puri['query'] = $puri['path'];
            unset($puri['path']);
            parse_str($puri['query'], $queryParams);
            $queryParams = array_merge($queryParams, $newParams);
        }
		else{
            $queryParams = $newParams;
        }

        // Strip out any query params that are set to false. Properly handle valueless parameters.
        foreach($queryParams as $param => $value){
            if($value === false){
                unset($queryParams[$param]);
            }
			elseif ($value === null){
                $queryParams[$param] = '';
            }
        }

        // Re-construct the query string
        $puri['query'] = http_build_query($queryParams);
        // Strip = from valueless parameters.
        $puri['query'] = preg_replace('/=(?=&|$)/', '', $puri['query']);
        // Re-construct the entire URL
        $nuri = self::http_build_url($puri);

        // Make the URI consistent with our input
        if($nuri[0] === '/' && strstr($uri, '/') === false){
            $nuri = substr($nuri, 1);
        }
        if($nuri[0] === '?' && strstr($uri, '?') === false){
            $nuri = substr($nuri, 1);
        }
        return rtrim($nuri, '?');
    }

    // Removes an item or list from the query string
    public static function remove_query_arg($keys, $uri = null)
    {
        if(is_array($keys)){
            return self::add_query_arg(array_combine($keys, array_fill(0, count($keys), false)), $uri);
        }
        return self::add_query_arg(array($keys => false), $uri);
    }
	
	// Convert page file name to words
	public static function get_page_title($separator, $remove = false)
    {
		$file = $_SERVER['SCRIPT_NAME'];
		$file = substr($file, strrpos($file, '/') + 1);
		$result = preg_replace('/\.php|.html(?=\s|$)/', '', $file);
		$result = preg_replace('/[\.\,\:\-\_]+/', ' ', $result);
		$result = $remove ? str_replace($remove, '', $result) : $result;
		$result = self::str_contains($file,'index') ? '' : ' '.$separator.' '.ucwords($result);
		
		return $result;
    }
	
	// Get custom date format
	public static function show_date($date = 'auto', $format = 'Y-m-d', $lang = 'en', $abbr = false)
	{
		//Set Website Base Data
		$websitebase = unserialize(constant('websitebase'));
		
		date_default_timezone_set($websitebase['timezone']);
		
		$finalDate = $date == 'auto' ? date($format) : date($format, strtotime($date));
		$langSet = $lang == 'es' ? 1 : 0;
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
								array("January","February","March","April","May","June","July","August","September","October","November","December"),
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
	
	// Custom paginator
	public static function custom_paginator($offset, $limit, $totalnum, $customclass = false, $customLeft = '&laquo;', $customRight = '&laquo;', $append = false, $parentDiv = false, $paginLimit = 12, $paginLimitMobile = 7)
	{
		if($append == false){
			$append = self::get_current_url(true).'/?';
		}
		
		if ($totalnum > $limit)
		{
			$pages = intval($totalnum / $limit);

			if ($totalnum % $limit){
				$pages++;
			}
			if(($offset + $limit) > $totalnum){
				$lastnum = $totalnum;
			}
			else{
				$lastnum = ($offset + $limit);
			}
			if(isset($_GET['pag'])){ 
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
			echo '<div class="JSpaginator '.$customclass.'" data-paginator-limit="'.$paginLimit.'" data-paginator-limit-mobile="'.$paginLimitMobile.'"><div class="JSpageItems">';
			echo '<a class="JSpagePrev" href="'.$append.'pag='.$pagePrev.'&num='.$pageNumPrev.'">'.$customLeft.'</a>';	
				for($i = 1; $i <= $pages; $i++)
				{
					$newoffset = $limit * ($i - 1);

					if($newoffset != $offset) 
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
	
	// Get video embed url
	public static function get_embed_video($url,$autoplay = false)
	{
		$videoCode = '';
		$videoURL = '';
		$videoAutplay = $autoplay === true ? 1 : 0;

		if(self::str_contains($url,'youtube')){
			preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $url, $videoCode);
			$videoURL = 'https://www.youtube.com/embed/'.$videoCode[7].'?rel=0&autoplay='.$videoAutplay;
		}
		elseif(self::str_contains($url,'vimeo')){
			preg_match('/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/', $url, $videoCode);
			$videoURL = 'https://player.vimeo.com/video/'.$videoCode[5].'?autoplay='.$videoAutplay;
		}
		elseif(self::str_contains($url,'facebook')){
			$videoURL = 'https://www.facebook.com/plugins/video.php?href='.$url.'&show_text=0&autoplay='.$videoAutplay;
		}
		return $videoURL;
	}
	
	// Get video id
	public static function get_video_id($url)
	{
		$videoCode = '';
		$videoID = '';

		if(self::str_contains($url,'youtube')){
			preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $url, $videoCode);
			$videoID = $videoCode[7];
		}
		elseif(self::str_contains($url,'vimeo')){
			preg_match('/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/', $url, $videoCode);
			$videoID = $videoCode[5];
		}
		elseif(self::str_contains($url,'facebook')){
			$videoID = $url;
		}
		return $videoID;
	}
	
	// Convert string to UTF8
	public static function convert_to_utf8($string)
    {
		// Map based on:
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
	
	// Get page code using cUrl
	public static function get_page_code($url, $start = null, $end = null, $agent = false)
	{
		/*
		Examples of common user agents:
		
		Chrome:		Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2
		IE 6:		Mozilla/4.08 (compatible; MSIE 6.0; Windows NT 5.1)
		IE 10:		Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)
		IE 11:		Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko
		Googlebot:	Googlebot/2.1 (+http://www.google.com/bot.html)
		Bingbot:	Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)
		Opera:		Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14
		Safari:		Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A
		Twitter:	Twitterbot/1.0
		Facebook:	facebookexternalhit/1.1 (+https://www.facebook.com/externalhit_uatext.php)
		*/
		
		//cUrl init
		$curlAgent = $agent ? $agent : false;
		$curlInit = curl_init();
		curl_setopt($curlInit, CURLOPT_URL, $url);
		curl_setopt($curlInit, CURLOPT_HEADER, 0);
		curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
		if($curlAgent){
			curl_setopt($curlInit, CURLOPT_USERAGENT, $curlAgent);
		}
		$curlInitResult = curl_exec($curlInit);
		curl_close($curlInit);
		
		if(empty($start) && empty($end))
		{
			//cUrl full code
			return $curlInitResult;
		}
		else
		{
			//cUrl by start/end
			$curlStartPos = stripos($curlInitResult, $start);
			$curlStartStr = substr($curlInitResult, $curlStartPos);
			$curlEndStr = substr($curlStartStr, strlen($start));
			$curlEndPos = stripos($curlEndStr, $end);
			$curlFinish = substr($curlEndStr, 0, $curlEndPos);
			return trim($curlFinish);
		}
	}
	
	// Get external function
	public static function get_function($name, $params = array())
	{
		if(function_exists($name)){
			return call_user_func_array($name, $params);
		}
	}
	
	// Recursively remove directory
	public static function remove_dir($dirPath)
	{
		if(is_dir($dirPath))
		{
			if(substr($dirPath, strlen($dirPath) - 1, 1) != '/'){
				$dirPath .= '/';
			}
			$files = glob($dirPath.'{,.}*', GLOB_BRACE);
			foreach($files as $file){
				if(is_dir($file)){
					self::remove_dir($file);
				}else{
					unlink($file);
				}
			}
			rmdir($dirPath);
		}
	}
}

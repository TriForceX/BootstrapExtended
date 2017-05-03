<?php

function minify_css($string){
    // Minify CSS and strip comments

    # Strips Comments
    $string = preg_replace('!/\*.*?\*/!s','', $string);
    $string = preg_replace('/\n\s*\n/',"\n", $string);

    # Minifies
    $string = preg_replace('/[\n\r \t]/',' ', $string);
    $string = preg_replace('/ +/',' ', $string);
    $string = preg_replace('/ ?([,:;{}]) ?/','$1',$string);

    # Remove semicolon
    $string = preg_replace('/;}/','}',$string);

    # Return Minified CSS
    return $string;
}

function minify_html($code) {
    return $code;
}

function minify_js($code) {
    return $code;
}
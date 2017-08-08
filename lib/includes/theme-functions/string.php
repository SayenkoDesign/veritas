<?php

/**
 * Add http:// if missing
 */
function addhttp($url) {
    if (false === strpos($url, '://')) {
		$url = 'http://' . $url;
	}
    return $url;
}

function reverse_words( $str )
{
	$myArray = str_word_count($str, 1);
	$reverse = array_reverse($myArray);
	return 	implode( ' ', $reverse );
}

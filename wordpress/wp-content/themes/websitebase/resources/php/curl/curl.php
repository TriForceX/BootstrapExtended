<?php
$agent = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.89 Safari/537.36';

function LoadCURLPage($url, $agent, $return_transfer = 1, $follow_location = 1, $curlopt_header = 0)
{
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  if($agent){
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
  }
  $result = curl_exec ($ch);
  curl_close ($ch);
	
  return $result;
}

function extract_unit($string, $start, $end)
{
  $pos = stripos($string, $start);
  $str = substr($string, $pos);
  $str_two = substr($str, strlen($start));
  $second_pos = stripos($str_two, $end);
  $str_three = substr($str_two, 0, $second_pos);
  $unit = trim($str_three); // remove whitespaces

  return $unit;
}
?>
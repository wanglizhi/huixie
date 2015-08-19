<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

function switchTimezone($dateStr, $target, $original){
	date_default_timezone_set($original);
	$timestamp = strtotime($dateStr);
	date_default_timezone_set($target);
	return date("Y-m-d H:i:s",$timestamp);
}
function getNow($timezone='PRC'){
    date_default_timezone_set($timezone);
    return date('Y-m-d h:i:s');
}

?>
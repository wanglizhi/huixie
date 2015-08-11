<?php
	function decodeTime($pre_time,$timezone){
		date_default_timezone_set("PRC");
		$timestamp = strtotime($pre_time);
		date_default_timezone_set($timezone);
		return date("Y-m-d H:i:s",$timestamp);
	}
?>
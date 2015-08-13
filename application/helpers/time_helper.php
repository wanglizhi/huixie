<?php
	function decodeTime($pre_time,$timezone){
		date_default_timezone_set("PRC");
		$timestamp = strtotime($pre_time);
		date_default_timezone_set($timezone);
		return date("Y-m-d H:i:s",$timestamp);
	}

	//计算相差时间
	function cal_time_differ($t1,$t2){
		$d1 = strtotime($t1);
		$d2 = strtotime($t2);
		$differ = $d2-$d1;
		$day = floor($differ/60/60/24);
		$differ-=$day*60*60*24;
		$hour = floor($differ/60/60);
		$differ-=$hour*60*60;
		$minute = floor($differ/60);
		return array('day' => $day,'hour' => $hour,'minute' => $minute);
	}
?>
<?php
// 求两个日期的差数，例如2007-2-5 ~ 2007-3-6 的日期差数
class Dtime {
	public static function get_days($date1, $date2) {
   		$time1 = strtotime($date1);
   		$time2 = strtotime($date2);
   		return ($time2-$time1)/86400;
   	}
}
$Dtime = new Dtime;

echo $Dtime::get_days('2014-2-5', '2014-3-6');

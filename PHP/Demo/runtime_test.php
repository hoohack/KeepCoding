<?php
/**
 * @Author: huhuaquan
 * @Date:   2015-09-11 15:22:33
 * @Last Modified by:   huhuaquan
 * @Last Modified time: 2015-09-11 15:34:13
 */
//获取脚本执行时间demo

function microtime_float()
{
	list($u_sec, $sec) = explode(' ', microtime());
	return (floatval($u_sec) + floatval($sec));
}

$start_time = microtime_float();

//do something
usleep(100);

$end_time = microtime_float();
$total_time = $end_time - $start_time;

$time_cost = sprintf("%.10f", $total_time);

echo "program cost total " . $time_cost . "s\n";
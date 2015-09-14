<?php
	$redis = new Redis();
	$redis->connect('127.0.0.1', '6379');
	$redis->set('tmp', 'value');
	if ($redis->exists('tmp'))
	{
		echo $redis->get('tmp') . "\n";
	}

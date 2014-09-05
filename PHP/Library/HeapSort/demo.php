<?php
	require 'heapsort.class.php';
	$arr = array();
	HeapSort::Sort($arr);
	echo "<pre>";
	print_r($arr);
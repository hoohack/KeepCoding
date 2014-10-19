<?php
	function split_and_upper($str) {
		$str = str_replace('_', ' ', $str);
        $str = ucwords($str);
		$result = str_replace(' ', '', $str);
		return $result;
	}
	$str = 'abc_def_ghi';
	$result = split_and_upper($str);
	print_r($result);

<?php
	function split_and_upper($str) {
		$arr = explode('_', $str);
		print_r($arr);
		foreach ($arr as &$val) {
			$val = ucfirst($val);
		}

		$result = implode($arr, '');

		return $result;
	}
	$str = 'abc_def_ghi';
	$result = split_and_upper($str);
	print_r($result);

<?php
	/**
	* 实现一个程序，对于给定的字符串，判断该字符串是不是一个合法的IP地址？
	* ps：要求不能用库，最好纯PHP手写
	**/
	function is_ip($str){
	
	  //filter_var — Filters a variable with a specified filter
	  //mixed filter_var ( mixed $variable [, int $filter = FILTER_DEFAULT [, mixed $options ]] )
		return filter_var($str, FILTER_VALIDATE_IP) ? "valid" : "invalid";
	}

	// echo is_ip("10.10.10.10");
?>

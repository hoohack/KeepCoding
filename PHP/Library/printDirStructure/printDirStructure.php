<?php

	//输出前导空格
	function printTag($level) {
		for($i = 0; $i < $level; ++$i) {
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		}
		if($level > 0) {
			echo "|_";
		}
	}

	//输出目录结构
	function printStructure($dir, $level) {
		if (is_file($dir)) {
			echo $dir;
		}

		if (!is_dir($dir)) {
			return;
		}

		//打开目录
		$handle = opendir($dir);
		//逐个打开文件
		while (FALSE !== ($file = readdir($handle))) {
			//过滤..与.
			if($file != '..' && $file != '.') {
				//输出前导空格
				printTag($level);

				//输出文件名
				echo $file . "<br>";

				//如果是目录
				if (is_dir($dir . "/" . $file)) {
					//进入目录递归输出文件结构
					printStructure($dir . "/" . $file, ++$level);
					
					//退出一层
					--$level;
				}
			}
		}

		//关闭文件句柄
		closedir($handle);
	}

	// $dir = '/home/hhq/data/test';
	$dir = '/home/hhq/www/hhqBlog/';

	//判断目录是否存在
	if(is_dir($dir)) {
		printStructure($dir, 0);
	} else {
		trigger_error('Open error', E_USER_ERROR);
	}
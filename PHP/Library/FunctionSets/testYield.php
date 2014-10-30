<?php
	//用yield来创建一个生成器，然后逐行读取文件内容。
	function getLines($path) {
		$handle = fopen($path, 'r');

		while (!feof($handle)) {
			$data = fgets($handle);
			yield $data;
		}

		fclose($handle);
	}

	$path = 'atoz.php';

	foreach (getLines($path) as $line => $val) {
		if ($line > 10000) {
			break;
		}
		echo $val . "<br>";
	}
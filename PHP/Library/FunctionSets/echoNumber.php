<?php
  //有如下字符串，如何提取其中的数字？
  //字符串是 ： ‘Hello 123 world 456 !!’ ， 期望提取出来的数字是 123456 。
  
  preg_match_all('/(\d+)/','Hello 123 world 456 !!',$match);
	print_r(join($match[0]));

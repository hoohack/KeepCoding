<?php

  //用PHP如何获取文件行数？
  //对于小文件
  $lines=file('test.txt');
  $linesnum=count($lines);
  
  //对于大文件
  $file_path = 'test.txt';
  $line = 0;
  $fp = fopen($file_path , 'r') or die("open file failure!");
  if ($fp) {
    while (stream_get_line($fp,8192,"\n")) {
      $line++;
    }
    fclose($fp)；
  }
  echo $line；

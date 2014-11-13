<?php
  // PHP中如果不用strlen怎么获取一个字符串的长度?
  $str = 'PHP语言';
  function splitUTF($str){
      static $i = 0;
      if(mb_substr($str,$i,1,'GBK')){
          $i++;
          splitUTF($str,$i,1,'GBK');
      }
      return $i;
  }

  echo splitUTF( $str);
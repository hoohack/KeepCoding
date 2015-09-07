<?php
  //不运行，分析下以下PHP代码输出结果是多少？ 为什么会这样？
  $a = count ("sijiaomao")  + count(null) + count(false);
  echo $a;  //2
  
  //count函数
  //int count ( mixed $array_or_countable [, int $mode = COUNT_NORMAL ] )
  //返回$array_or_countable中的单元数目，通常是一个array，任何其它类型都只有一个单元。
  //如果$array_or_countable不是数组类型或者实现了 Countable 接口的对象，将返回 1，有一个例外，如果$array_or_countable是NULL则结果是 0。
  //所以上面输出是2

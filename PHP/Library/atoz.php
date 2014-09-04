<?php
    for($i = 'a'; $i <= 'z'; $i++) {
        echo $i . '<be>';
    }
    //这段代码原意是想打印出a到z,但是实际结果并不会如此，因为'z'+1='aa','aa' < 'z',所以循环还会继续，直到$i = 'zz'.
    //php手册解释如下
    /**
    * PHP follows Perl’s convention when dealing with arithmetic operations on character variables and not C’s.
    * For example, in PHP and Perl $a = ‘Z’; $a++; turns $a into ‘AA’, while in C a = ‘Z’; a++; turns a into ‘[‘ 
    * (ASCII value of ‘Z’ is 90, ASCII value of ‘[‘ is 91). Note that character variables can be incremented but not 
    * decremented and even so only plain ASCII characters (a-z and A-Z) are supported. Incrementing/decrementing other 
    * character variables has no effect, the original string is unchanged.
    */
    //要想达到效果，则有如下解决方法
    for($i = 97; $i < 122; $i++){
        echo chr($i) . "\n";
    }
    
    //或者
    for($i = ord('a'); $i < ord('z'); $i++){
        echo chr($i) . "\n";
    }
?>

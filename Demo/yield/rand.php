<?php
/*
 * 生成随机数
 */
function genRand($min, $max) {
    for ($i = 0; $i < 9000000; $i++) {
        yield mt_rand($min, $max);
    }
}


$fp = fopen('data.txt', 'w+');
if (!$fp) {
    exit('open file failed');
}

$result = genRand(10000, 99999);
foreach ($result as $val) {
    fwrite($fp, $val . "\n");
}

fclose($fp);
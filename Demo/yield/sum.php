<?php
/*
 * 普通加载文件，求和
 */
printf(' memory usage: %01.2f MB', memory_get_usage()/1024/1024);
echo "\n";
$startTime = microtime(true);
function readTxt($fileName) {
    $sum = 0;
    $str = file_get_contents($fileName);
    $data = explode("\n", $str);
    foreach ($data as $val) {
        $sum += $val;
    }

    // 174.16 MB
    printf(' memory usage: %01.2f MB', memory_get_usage()/1024/1024);
    echo "\n";
    return $sum;
}

$fileName = 'data.txt';
$sum = readTxt($fileName);

echo $sum . "\n";

$endTime = microtime(true);
echo "cost: " . round($endTime - $startTime, 4) . "s\n";
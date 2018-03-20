<?php
/*
 * 使用yield处理大文件demo
 */
printf(' memory usage: %01.2f MB', memory_get_usage()/1024/1024);
echo "\n";
$startTime = microtime(true);
function readTxt($fileName) {
    $fp = fopen($fileName, 'r');
    if (!$fp) {
        exit('open failed');
    }

    while (FALSE === feof($fp)) {
        yield fgets($fp);

        // 0.22 MB
        printf(' memory usage: %01.2f MB', memory_get_usage()/1024/1024);
        echo "\n";
    }

    fclose($fp);
}

$fileName = 'data.txt';
$sum = 0;
foreach(readTxt($fileName) as $key => $value) {
    $sum += $value;
}

echo $sum . "\n";

$endTime = microtime(true);

echo "cost: " . round($endTime - $startTime, 4) . "s\n";
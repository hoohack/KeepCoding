<?php
    // 找出Linux下指定目录中最大的10个文件
    $all_file = array();
    function get_max_file($dir) {
        $list = scandir($dir);
        foreach ($list as $file) {
            $file_location = $dir . '/' . $file;
            if (is_dir($file_location) && $file != "." && $file != ".." ) {
                get_max_file($file_location);
            } elseif ($file_location) {
                if ($file != '.' && $file != '..') {
                    $file_size = filesize($file_location);
                    $GLOBALS['all_file'][$file_location] = $file_size;
                }
            }
        }
    }
    get_max_file('./');
    arsort($all_file);
    $max_size = array_slice($all_file, 0, 10);
    echo "<pre>";
    var_dump($max_size);
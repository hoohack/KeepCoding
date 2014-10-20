<?php
	/*
	*copy_dir function
	*复制source文件夹到dest中
	*@param source string 源文件夹目录
	*@param dest string 目的位置
	*复制后文件权限为664,文件夹权限为777
	*return true/false
	*@author hhq
	*/
	function copy_dir($source, $dest) {
		// echo $source . '=>' . $dest . '<br>';
        $result = false;

        //如果是文件
        if (is_file($source)) {
            if (is_dir($dest)) {
            	//如果目标位置是目录，设置目标路径和文件名
                $dest_path = $dest . DIRECTORY_SEPARATOR . basename($source);
            }else {
            	//如果目标位置是文件，设置文件名即可
                $dest_path = $dest;
            }

            //执行拷贝文件的操作
            $result = @copy($source, $dest_path);
            @chmod($source, 0664);
        }elseif (is_dir($source)) {//如果source是目录
            if(is_dir($dest)) {
            	//如果dest是目录，则根据source设置dest的值
                $dest = $dest . basename($source);
                @mkdir($dest, 0777);
                @chmod($dest, 0777);
            }else {
            	//否则，直接创建文件夹
                @mkdir($dest, 0777);
                @chmod($dest, 0777);
            }

            //打开目录句柄
            $dirHandle = opendir($source);
            
            //遍历目录并递归操作
            while(false !== ($file = readdir($dirHandle))) {
                if($file != "." && $file != "..") {
                    $dest_path = $dest . DIRECTORY_SEPARATOR . $file;

                    $result = copy_dir($source . DIRECTORY_SEPARATOR . $file, $dest_path);
                }
            }

            //关闭目录句柄
            closedir($dirHandle);
        }else {
            $result = false;
        }

        return $result;
    }
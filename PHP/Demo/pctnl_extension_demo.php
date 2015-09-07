<?php
/**
 * @Author: huhuaquan
 * @Date:   2015-09-07 15:54:04
 * @Last Modified by:   huhuaquan
 * @Last Modified time: 2015-09-07 16:03:16
 */
	//PHP多进程demo
	//fork10个进程
	for ($i = 0; $i < 10; $i++) {
		$pid = pcntl_fork();
		if ($pid == -1) {
			echo "Could not fork!\n";
			exit(1);
		}
		if (!$pid) {
			echo "child process $i running\n";
			//子进程执行完毕之后就退出，以免继续fork出新的子进程
			exit($i);
		}
	}
	
	//等待子进程执行完毕，避免出现僵尸进程
	while (pcntl_waitpid(0, $status) != -1) {
		$status = pcntl_wexitstatus($status);
		echo "Child $status completed\n";
	}

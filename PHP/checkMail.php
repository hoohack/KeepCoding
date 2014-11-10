<?php
	// 有mail.log的一个文档，内容为若干邮件地址，
	// 其中用’\n’将邮件地址分隔，要求从中挑选出qq.com的邮件地址。

	//解法一
	$handle = fopen('mail.log', 'r');
	while (!feof($handle)) {
		$mail = fgets($handle);

		if (strpos($mail, '@qq.com') > 0) {
			$qq[] = $mail;
		}
	}

	fclose($handle);

	//解法二
	foreach (file('mail.log') as $mail) {
		if (strpos($mail, '@qq.com')) {
			$qq[] = $mail;
		}
	}

	//解法三
	if(preg_match_all('#[a-z\d\-.]+@qq\.com(?=[\r\n])#is', 
		file_get_contents('mail.log') . "\n", $matches)){
		echo '';
        $qq[] = $matches[0];
    }

    print_r($qq);
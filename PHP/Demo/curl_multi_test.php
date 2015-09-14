<?php
/**
 * @Author: huhuaquan
 * @Date:   2015-09-14 17:00:04
 * @Last Modified by:   huhuaquan
 * @Last Modified time: 2015-09-14 17:22:52
 */
//curl批处理demo

$max_size = 100;
$mh = curl_multi_init();
$options_arr = array(
	CURLOPT_HEADER => 0,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => 1,
	CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.130 Safari/537.36'	
);
for ($i = 0; $i < $max_size; $i++)
{
	$ch = curl_init();
	$options_arr[CURLOPT_URL] = 'http://www.zhihu.com/people/' . $user_list[$i] . '/about';
	curl_setopt_array($ch, $options_arr);
	$requestMap[$i] = $ch;
	curl_multi_add_handle($mh, $ch);
}

do {
	//执行请求
	while (($cme = curl_multi_exec($mh, $active)) == CURLM_CALL_MULTI_PERFORM);

	if ($cme != CURLM_OK) {break;}

	//获取当前解析的cURL的相关传输信息
	while ($done = curl_multi_info_read($mh))
	{
		//获取一个cURL连接资源句柄的信息
		$info = curl_getinfo($done['handle']);

		//如果设置了CURLOPT_RETURNTRANSFER，则返回获取的输出的文本流
		$tmp_result = curl_multi_getcontent($done['handle']);
		
		//返回一个保护当前会话最近一次错误的字符串
		$error = curl_error($handle['handle']);

		//do some thing with $tmp_result
		
		//移除curl批处理句柄资源中的某个句柄资源
		curl_multi_remove_handle($mh, $done['handle']);
	}
	if ($active)
	{
		//等待所有cURL批处理中的活动连接，此函数会阻塞，直到cURL批处理连接中有活动连接
		curl_multi_select($mh, 10);
	}
} while ($active);
//关闭连接
curl_multi_close($mh);
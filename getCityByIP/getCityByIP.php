<?php
	/**
	* 2014-6-5
	* getCityByIP function
	* 根据IP地址获取省份和城市信息
	* @param string $ip
	* @return array
	* @example echo getCityIp('58.254.92.215');
	* @author hhq
	*/
	function getCityByIP($ip) {
		$url = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip;
		$info = json_decode(file_get_contents($url));
		if ((string)$info->code === '1') {
			return false;
		} else {
			$data = (array)$info->data;
			return $data;
		}
	}

	print_r(getCityByIp('58.254.92.215'));
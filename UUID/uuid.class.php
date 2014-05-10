<?php
	/*
	*UUID class
	*return uuid
	*@author hhq
	*/
	class UUID {
		/*
		*getv3 function
		*返回版本3的UUID，形式如：xxxxxxxx-xxxx-3xxx-x(8|9|a|b)xxx-xxxxxxxxxxxx
		*@author hhq
		*/
		public static function getv3() {
			$microtime = microtime();

			list($usec, $sec) = explode(" ", $microtime);

			$dec_hex = dechex($usec * 1000000);
			$sec_hex = dechex($sec);

			self::adjust_length($dec_hex, 5);
			self::adjust_length($sec_hex, 6);

			$uuid = md5($dec_hex . $sec_hex);

			return sprintf('%08s-%04s-%04x-%04x-%12s',
 
			// 32 bits for "time_low"
			substr($uuid, 0, 8),
	 
			// 16 bits for "time_mid"
			substr($uuid, 8, 4),
	 
			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 3
			(hexdec(substr($uuid, 12, 4)) & 0x0fff) | 0x3000,
	 
			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			(hexdec(substr($uuid, 16, 4)) & 0x3fff) | 0x8000,
	 
			// 48 bits for "node"
			substr($uuid, 20, 12)
			);
			
		}

		/*
		*adjust_length function
		*@param string string 字符串参数
		*@param num    length 调整的长度
		*调整string的长度为length
		*@author hhq
		*/
		public static function adjust_length(&$string, $length) {
			$strlen = strlen($string);

			if($strlen < $length) {
				$padStr = mt_rand(0, 9);
				$string = str_pad($string, $length, "$padStr");
			}

			if($strlen > $length) {
				$string = substr($string, 0, $length);
			}
		}
	}
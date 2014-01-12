<?php
	/*
	 *获取用户请求的URL，通过此类调用相应的方法
	 *提取 uri 中的'分段', 映射到某个类的某个方法，从而调用该方法
	 * @package URI
	 * @author HHQ
	 * @file uri.class.php
	*/

	class URI {
		var $uri_segments;		//原始URI的分段信息
		
		var $route_segments;		//经过路由之后的分段信息
		
		var $uri_string;		//URI的路径信息，即URL中index.php后面的内容

		/*构造方法，初始化参数内容*/
		public function __construct() {
			$this->uri_segments = array();
			$this->route_setments = array();
			$this->uri_string = array();
		}
		
		/*
		 *分析URI，获取分析后的URI的分段信息
		 *如果检测函数执行成功则设置uri_string参数的值
		 */
		public function fetchUriString() {
			if($uri = $this->_detectUri()) {
				$this->setUriString($uri);
				return;
			}
		}

		/*
		 *设置uri_string参数的值
		 *如果分析uri后剩下'/'则设置为空值，反之设置为分析后的uri分段
		 */
		private function _setUriString($uri) {
			$this->uri_string = ($uri == '/') ? '' : $uri;
		}
		
		/*检测uri，得到uri分段信息*/
		private function _detectUri() {
			/*
			 *$_SERVER['REQUEST_URI']：访问此页面所需的 URI 
			 *$_SERVER['SCRIPT_NAME']：相对于网站根目录的路径及 PHP 程序文件名称
			 *如果请求为空，则返回空值
			 */
			if(!isset($_SERVER['RESUEST_URI']) OR !isset($_SERVER['SCRIPT_NAME'])) {
				return '';
			}

			$uri = $_SERVER['REQUEST_URI'];

			/*
			   *如果$uri包含$_SERVER['SCRIPTNAME'],则截取$uri中$_SERVER['SCRIPT_NAME']长度的部分
			   *即获得请求网站的参数部分
			 */
			if(strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
				$uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			}

			if($uri === '/' || empty($uri)) {
				return '';
			}

			/*根据URL的PATH解析URL，返回其组成部分*/
			$uri = parse_url($uri, PHP_URL_PATH);
			
			/*将$uri中的所有'//'或者'../'替换成'/'*/
			return str_replace(array('//', '../'), '/', trim($uri, '/'));
		}

		/*
		 *过滤掉一些恶意参数
		 */
		private function _filterUrl($str) {
			$bad = array('$', '(', ')', '%28', '%29');
			$good = array('&#36', '&#40', '&#41', '&#40', '&#41');

			return str_replace($bad, $good, $str);
		}

		/*分解URI分段信息
		  *将分解后的独立的分段信息保存在_uri_segments数组中
		 */
		public function explodeSegments() {
			foreach (explode("/", preg_replace("|/*(.+?)/*$|", "\\1", $this->uri_string)) as $val) {
				$val = trim($this->_filterUrl($val));

				if($val != '') {
					$this->segments[] = $val;
				}
			}	
		}

		public function segment_array() {
			return $this->segments;
		}

	}

/*End of the class*/

<?php
	/**
	  文件名:page.class.php
	  一个实现分页的类Page
	 @author hhq
	  */
	class Page {
		private $totalCount;		//数据表总记录数
		private $pageNumber;		//当前页数
		private $pageRows;		//每一页的总行数
		private $pageCount;		//总页数
		private $limitStatement;	//数据库查询时的limit语句，如limit 0,5 表示偏移量从0开始，返回5行记录
		private $pageType;		//分页的数据类型,如:文章，评论
		private $listCount;		//分页列表显示的个数
		private $uri;			//用户请求的URL

		/**
		  构造函数
		  参数介绍
		  pageRows默认为10
		  query是查询的参数，即url后面通过GET得到的参数列表
		  */
		public function __construct($totalCount, $pageRows=10, $query="") {
			$this->pageRows = $pageRows;
			$this->totalCount = $totalCount;
			$this->pageCount = ceil($this->totalCount / $this->pageRows);
			$this->uri = $this->getUri($query);//获取用户请求的URL
			$this->listCount = 10;

			//设置当前请求的页数
			if(isset($_GET['page'])) {
				$pageNumber = $_GET['page'];
			}else {
				$pageNumber = 1;
			}

			//排除非法参数
			if($totalCount > 0) {
				if(preg_match('/\D/', $pageNumber)) {
					$this->pageNumber = 1;//如果url的page参数是字母的话,设置为1
				}else {
					$this->pageNumber = $pageNumber;
				}
			}else {
				$this->pageNumber = 0;
			}

			$this->limitStatement = "LIMIT ".$this->setLimit();
		}

		//魔术函数__set，当对象给类的私有属性赋值时自动调用
		public function __set($propertyName, $propertyValue) {
			$propertyName = $propertyValue;
		}

		//魔术函数__get,原理跟__set类似
		public function __get($propertyName) {
			if($propertyName == "limitStatement" || $propertyName == "pageNumber") {
				return $this->$propertyName;
			}else {
				return null;
			}
		}

		//显示分页的格式
		public function showPage() {
			$pageMessage[0] = "共{$this->totalCount}&nbsp;{$this->pageType}";
			$pageMessage[1] = "每页显示{$this->pageRows}条&nbsp;&nbsp;";
			$pageMessage[2] = $this->firstPrevPage();
			$pageMessage[3] = $this->pageNumberList();
			$pageMessage[4] = $this->nextLastPage();
			
			$display = '<div style="font:12px \'\5B8B\4F53\',san-serif;">';
			for($i = 0; $i != count($pageMessage); ++$i) {
				$display .= $pageMessage[$i];
			}

			$display .= "</div>";
			return $display;
		}
		
		//获取首页和上一页的操作信息
		private function firstPrevPage() {
			$message = "";
			if($this->pageNumber > 1) {
				$message .= "&nbsp;<a href='{$this->uri}page=1'>首页</a>&nbsp;";
				$message .= "&nbsp;<a href='{$this->uri}page=".($this->pageNumber-1)."'>上一页</a>&nbsp;";
			}
			
			return $message;
		}
		
		//获取页数列表信息
		private function pageNumberList() {
			$pageListMessage = "&nbsp;";
			
			$inum = floor($this->listCount/2);
			for($i = $inum; $i >= 1; $i--) {
				$pageNumber = $this->pageNumber - $i;

				if($pageNumber >= 1) {
					$pageListMessage .= "<a href='{$this->uri}page={$pageNumber}'>{$pageNumber}</a>&nbsp;";
				}
			}

			if($this->pageNumber >= 1) {
				$pageListMessage .= "<b>{$this->pageNumber}</b>&nbsp;";
			}

			for($i = 1; $i <= $inum; $i++) {
				$pageNumber = $this->pageNumber + $i;
				if($pageNumber <= $this->pageCount) {
					$pageListMessage .= "<a href='{$this->uri}page={$pageNumber}'>{$pageNumber}</a>&nbsp;";
				}else {
					break;
				}
			}

			return $pageListMessage;
		}

		//获取下一页和尾页的操作信息
		private function nextLastPage() {
			$message = "";
			if($this->pageNumber != $this->pageCount) {
				$message .= "&nbsp;<a href='{$this->uri}page=".($this->pageNumber+1)."'>下一页</a>&nbsp;";
				$message .= "&nbsp;<a href='{$this->uri}page=".($this->pageCount)."'>尾页</a>";
			}

			return $message;
		}
		
		//获取用户当前请求的URL
		private function getUri($query) {
			$requestURI = $_SERVER['REQUEST_URI'];
			$url = strstr($requestURI, '?') ? $requestURI : $requestURI.'?';

			if(is_array($query)) {
				$url .= http_build_query($query);
			}else if($query != "") {
				$url .= "&".trim($query, "?&");	
			}

			$urlArr = parse_url($url);

			if(isset($urlArr['query'])) {
				parse_str($urlArr['query'], $urlArrs);
				unset($urlArrs['page']);
				$url = $urlArr['path'].'?'.http_build_query($urlArrs);
			}
			
			if(strstr($url, '?')) {
				if(substr($url, -1) != '?') {
					$url = $url.'&';
				}
			}else {
				$url = $url.'?';
			}

			return $url;
		}

		//设置SQL查询时的limit约束
		private function setLimit() {
			if($this->pageNumber > 0) {
				return ($this->pageNumber - 1) * $this->pageRows . ", {$this->pageRows}";	
			}else {
				return 0;
			}
		}
	}

//End of Page class

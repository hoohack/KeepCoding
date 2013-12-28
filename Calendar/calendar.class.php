<?php
	/**
	*filename:claendar.class.php
	*date:2013.12.20
	*author:hhq
	*A class that can display a claendar in the web page.
	*/

	 class Calendar {
	 	private $year;			//当前年份
	 	private $month;			//当前月份
	 	private $startDay;		//日历每个月开始的第一天为星期几
	 	private $daysOfMonth;	//当前月份的总天数
	 	private $currentTime;	//当前时间戳

	 	/*
	 	*构造方法
	 	*如果没有传参数则默认为当前年份和月份的日历
	 	*/
	 	public function __construct($config = array()) {
	 		date_default_timezone_set('PRC');

	 		if(count($config) > 0) {
	 			$this->initialize($config);
	 		}else {
	 			$this->currentTime = time();
	 			$this->year = isset($_GET['y']) ? $_GET['y'] : date('Y', $this->currentTime);
	 			$this->month = isset($_GET['m'])? $_GET['m'] : date('m', $this->currentTime);
	 			$this->daysOfMonth = $this->getTotalDays($this->month);
	 			$this->startDay = date('w', mktime(0, 0, 0, $this->month, 1, $this->year));
	 		}
	 	}

	 	/*
	 	*初始化函数
	 	*根据config数组来初始化一些日期属性
	 	*/
	 	private function initialize($config) {
	 		foreach ($config as $key => $val) {
	 			$this->$key = $val;
	 		}
	 	}

	 	/*
	 	*根据年份和月份显示一个日历
	 	*/
	 	public function display() {
	 		$out = '<table align="center">';
	 		$out .= $this->adjustDate();
	 		$out .= '<tr align="center"><td>'.$this->getMonthName($this->month).'</td></tr>';
	 		$out .= $this->weeksList();
	 		$out .= $this->daysList();
	 		$out .= "</table>";

	 		return $out;
	 	}

	 	/*
	 	*显示日历上方的星期列表
	 	*/
	 	private function weeksList() {
	 		$weeks = array('日', '一', '二', '三', '四', '五', '六');

	 		$out = '<tr>';
	 		for ($i=0; $i < count($weeks); $i++) { 
	 			$out .= '<td class="fontb">'.$weeks[$i].'</td>';
	 		}

	 		$out .= '</tr>';
	 		return $out;
	 	}

	 	/*
	 	*显示当前月份的日期列表
	 	*/
	 	private function daysList() {
	 		$out = '<tr>';
	 		$j = 0;

	 		for($i = 0; $i < $this->startDay; $i++) {
				++$j;
				$out .= '<td>&nbsp;</td>';
	 		}
	 		for($k = 1; $k <= $this->daysOfMonth; $k++) {
	 			++$j;
	 			if($k == date('d')) {
	 				$out .= '<td class="fontb">'.$k.'</td>';
	 			}else {
	 				$out .= '<td>'.$k.'</td>';
	 			}

	 			if($j%7 == 0) {
	 				$out .= '</tr><tr>';
	 			}
	 		}

	 		while($j%7 != 0) {
	 			++$j;
	 			$out .= '<td>&nbsp;</td>';
	 		}

	 		$out .= '</tr>';

	 		return $out;
	 	}

	 	/*
	 	*获得month月份的天数
	 	*/
	 	private function getTotalDays($month) {
	 		$dayData = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

	 		/*容错处理*/
	 		if($month < 1 OR $month > 12) {
	 			trigger_error("Error month value", E_USER_ERROR);
	 		}

	 		if($month == 2) {
	 			if(($this->year %400 == 0) OR ($this->year %4 == 0 AND $this->year %100 != 0)) {
	 				return 28;
	 			}else {
	 				return 29;
	 			}
	 		}

	 		return $dayData[$month-1];
	 	}

	 	/*
	 	*获得每个月份对应的简称
	 	*/
	 	private function getMonthName($month) {
	 		if(strlen($month) == 1) {
	 			$month = '0'.$month;
	 		}
	 		$monthNames = array('01' => 'jan', '02' => 'feb', '03' => 'mar', 
	 			'04' => 'apr', '05' => 'may', '06' => 'jun', 
	 			'07' => 'jul', '08' => 'aug', '09' => 'sep', 
	 			'10' => 'oct', '11' => 'nov', '12' => 'dec');

	 		if($month < 1 OR $month > 12) {
	 			return "";
	 		}

	 		return ucfirst($monthNames[$month]);
	 	}

	 	/*
	 	*获得一周的星期几的英文简称
	 	*/
	 	public function getDayName() {
	 		$dayNames = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

	 		return $dayNames;
	 	}

	 	private function frontData($year, $month) {
	 		if($month == 1) {
	 			$year = $year - 1;
	 			if($year < 1970) {
	 				$year = 1970;
	 			}
	 			$month = 12;
	 		}else {
	 			$month -= 1;
	 		}

	 		$data = 'y='.$year.'&m='.$month;
	 		return $data;
	 	}

	 	/*
	 	*获取下一个月的年份和月份的信息
	 	*/
	 	private function nextData($year, $month) {
	 		if($month == 12) {
	 			$year = $year + 1;
	 			if($year > 2038) {
	 				$year = 2038;
	 			}
	 			$month = 1;
	 		}else {
	 			$month += 1;
	 		}

	 		$data = 'y='.$year.'&m='.$month;
	 		return $data;
	 	}

	 	/*
	 	*根据用户的请求调整日历
	 	*/
	 	public function adjustDate($url='testCalendar.php') {
	 		if($this->year == 1970) {
	 			$preYear = 1970;
	 		}else {
	 			$preYear = $this->year-1;
	 		}
	 		if($this->year == 2038) {
	 			$nextYear = 2038;
	 		}else {
	 			$nextYear = $this->year+1;
	 		}

	 		$out = '<tr>';

	 		$out .= '<td><a href="'.$url.'?'.'y='.$preYear.'&m='.$this->month.'">'.'<<'.'</a></td>';
	 		$out .= '<td><a href="'.$url.'?'.$this->frontData($this->year, $this->month).'">'.'<'.'</a></td>';

	 		$out .= '<td colspan="3">';
	 		$out .= '<form>';
	 		$out .= '<select name="year" onchange="window.location=\''
	 		.$url.'?y=\'+this.options[selectedIndex].value+\'&m='.$this->month.'\'">';
	 		for($yearIndex = 1970; $yearIndex <= 2038; ++$yearIndex) {
	 			$selected = ($yearIndex == $this->year) ? "selected" : "";
	 			$out .= '<option '.$selected.' value="'.$yearIndex.'">'.$yearIndex.'</option>';
	 		}

	 		$out .= '</select>';
	 		$out .= '<select name="month" onchange="window.location=\''
	 		.$url.'?y='.$this->year.'&m=\'+this.options[selectedIndex].value">';
	 		for($monthIndex = 1; $monthIndex <= 12; ++$monthIndex) {
	 			$selected2 = ($monthIndex == $this->month) ? "selected" : "";
	 			$out .= '<option '.$selected2.' value="'.$monthIndex.'">'.$monthIndex.'</option>';
	 		}
	 		$out .= '</select>';
	 		$out .= '</form></td>';

	 		$out .= '<td><a href="'.$url.'?'.'y='.$nextYear.'&m='.$this->month.'">'.'>>'.'</a></td>';
	 		$out .= '<td><a href="'.$url.'?'.$this->nextData($this->year, $this->month).'">'.'>'.'</a></td>';
	 	
	 		$out .= '</tr>';
	 		return $out;
	 	}

	 }
/*End of the file*/
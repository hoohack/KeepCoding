<?php
	include_once 'Pizza.php';

	/**
	* 具体的产品
	* ChicagoStylePizza封装的是关于如何制造芝加哥风味的比萨
	*/
	class ChicagoStyleCheesePizza extends Pizza {
		public function __construct() {
			$this->name = "Chicago Style Sauce and Cheese Pizza";
		}
	}
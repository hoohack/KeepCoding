<?php
	include 'Pizza.php';

	/**
	* 具体的产品
	* NYStyleCheesePizza封装的是关于如何制造纽约风味的比萨
	*/
	class NYStyleCheesePizza extends Pizza {
		public function __construct() {
			$this->name = "NY Style Sauce and Cheese Pizza";
		}
	}
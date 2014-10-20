<?php
	/**
	* 产品类
	* 工厂产生产品，对于PizzaStore来说，产品就是Pizza
	*/
	abstract class Pizza {
		public $name;

		public function prepare() {
			echo "Preparing " . $this->name . "<br>";
		}

		public function bake() {
			echo "Baking " . "<br>";
		}

		public function cut() {
			echo "Cutting..." . "<br>";
		}

		public function box() {
			echo "Boxing.." . "<br>";
		}

		public function getName() {
			return $this->name . "<br>";
		}
	}
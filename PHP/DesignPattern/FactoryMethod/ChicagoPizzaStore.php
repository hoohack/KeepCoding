<?php

	include 'PizzaStore.php';
	include 'ChicagoStyleCheesePizza.php';
	include 'ChicagoStyleVegglePizza.php';

	/**
	* 具体创建者类
	* 继承自工厂方法类, 能产生产品的类
	*/
	class ChicagoPizzaStore extends PizzaStore {

		/**
		* 实现抽象方法createPizza，产生具体产品
		*/
		public function createPizza($type) {
			if ($type == "cheese") {
				return new ChicagoStyleCheesePizza();
			} else if ($type == "veggle") {
				return new ChicagoStyleVegglePizza();
			} else {
				return null;
			}
		}
	}
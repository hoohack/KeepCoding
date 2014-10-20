<?php

	include_once 'PizzaStore.php';
	include_once 'NYStyleCheesePizza.php';
	include_once 'NYStyleVegglePizza.php';

	/**
	* 具体创建者类
	* 继承自工厂方法类, 能产生产品的类
	*/
	class NYPizzaStore extends PizzaStore {

		/**
		* 实现抽象方法createPizza，产生具体产品
		*/
		public function createPizza($type) {
			if ($type == "cheese") {
				return new NYStyleCheesePizza();
			} else if ($type == "veggle") {
				return new NYStyleVegglePizza();
			} else {
				return null;
			}
		}
	}
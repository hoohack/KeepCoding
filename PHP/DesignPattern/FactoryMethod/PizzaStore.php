<?php
	/**
	* 抽象创建者类
	* 抽象产品由子类制造，创建者不需要真的知道在制造哪种具体产品
	*/
	abstract class PizzaStore {
		public function orderPizza($type) {
			$pizza = $this->createPizza($type);
			
			$pizza->prepare();
			$pizza->bake();
			$pizza->cut();
			$pizza->box();
			return $pizza;			
		}

		/**
		* 一个抽象的工厂方法，让子类实现此方法制造产品
		*/
		protected abstract function createPizza($type);
	}
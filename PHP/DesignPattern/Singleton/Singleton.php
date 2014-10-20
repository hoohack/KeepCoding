<?php
	class Singleton {
		/**
		* instance属性，保存本类的唯一示例
		* 访问性设置为private和static，因此不能在类外部被访问
		*/
		private static $instance;

		/**
		* 构造方法定义为私有的，则无法从自自身外部来创建示例的类
		*/
		private function __construct() {}

		/**
		* 返回本类的唯一示例
		* 方法在类内部，因此可以访问instance属性
		*/
		public function getInstance() {
			//如果instance属性为空，则创建一个对象示例并保存到instance属性中
			if (self::$instance === null) {
				self::$instance = new self();
			}

			//返回给调用代码
			return self::$instance;
		}
	}
<?php
	include_once 'NYPizzaStore.php';
	include_once 'ChicagoPizzaStore.php';

	class SinglePizzaStore {
		private static $instance;
		private $pizza;

		private function __construct($type) {
			$this->init($type);
		}

		private function init($type) {
			switch ($type) {
				case 'NY':
					$this->pizza = new NYPizzaStore();
					break;
				case 'Chicago':
					$this->pizza = new ChicagoStore();
					break;
			}
		}

		public static function getInstance($type) {
			if (self::$instance === null) {
				self::$instance = new self($type);
			}

			return self::$instance;
		}

		public function getPizza() {
			return $this->pizza;
		}
	}
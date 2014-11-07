<?php
	spl_autoload_register(null, false);
	spl_autoload_extensions('.php,.inc,.class,.interface');
	function myLoader1($class) {
		echo 'excute myLoader1' . ' find ' . $class . "\n";
		include strtolower($class) . '.php';
	}

	function myLoader2($class) {
		echo 'excute myLoader2' . ' find ' . $class;
	}

	spl_autoload_register('myLoader1', false);
	spl_autoload_register('myLoader2', false);
	$test = new SomeClass();
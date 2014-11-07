<?php
	include 'session.class.php';

	$session = new My_Session('localhost', 'root', 'root', 'test', 'tb_session');
	// var_dump($_SESSION);

	// $_SESSION['test'] = 'test';

	// echo $_SESSION['test'];

	

	$_SESSION['HHQ'] = 'hhq';

	var_dump($_SESSION);
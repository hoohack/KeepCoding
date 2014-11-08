<?php
	include 'session.class.php';

	$session = new My_Session();
	session_set_save_handler($session, true);
	session_start();
	$_SESSION['hhq'] = 'hhq';
	$_SESSION['kk'] = 'ksk';
	echo $_SESSION['kk'];
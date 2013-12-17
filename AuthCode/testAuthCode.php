<?php
	if(!isset($_SESSION['authcode'])) {
		session_start();
	}else {
		session_destroy();
		session_start();
	}
	require ('authcode.class.php');

	$code = new AuthCode();
	echo $code;
?>
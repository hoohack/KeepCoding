<?php
	if (isset($_GET['callback']) && !empty($_GET['callback'])) {
		echo $_GET['callback'] . '({"code":"CA1998","price":1780,"tickets":5})';
	}
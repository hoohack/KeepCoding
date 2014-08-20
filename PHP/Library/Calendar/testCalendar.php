<meta charset=utf8>
<?php
	include 'calendar.class.php';

	$cal = new Calendar();
	echo $cal->display();

?>

<html>
	<style>
		td,th {
			text-align: center;
			margin: 0 auto;
		}
		.fontb {
			color: white;
			background: blue;
		}
	</style>
</html>
<html>
	<head>
	<meta charset="utf8">
	<title>
		test	
	</title>
	<?php
		include 'database.class.php';

		//新建一个数据库对象
		$db = new Database();

		//需要插入的内容
		$param = array(":title" => "test",
					":content" => "hey");

		//insert语句
		$insertSQL = "INSERT INTO `article` (title, content) VALUES (:title, :content)";

		if(!$db->execute($insertSQL, $param)) {
			echo $db->errorMessage;
		}


		$selectSQL = "SELECT * FROM `article`";

		$result = $db->fetch($selectSQL);

		echo "<pre>";
		print_r($result);
		echo "</pre>";

		$db->close();
	?>
</head>
</html>
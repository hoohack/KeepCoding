<html>
	<head>
	<meta charset="utf8">
	<title>
		test	
	</title>
	<?php
		include 'database.class.php';

		//新建一个数据库对象
		$db = Database::getInstance();

		//需要插入的内容
		// $param = array(":title" => "test",
		// 			":content" => "hey");

		$param = array(":id" => "",
							":s_id" => "201130720104",
							":s_name" => "胡华泉");

		//insert语句
		// $insertSQL = "INSERT INTO `article` (title, content) VALUES (:title, :content)";
		$insertSQL = "INSERT INTO `student` (id, s_id, s_name) VALUES (:id, :s_id, :s_name)";

		if(!$db->execute($insertSQL, $param)) {
			echo $db->errorMessage;
		}else {
			echo "yes";
		}


		$selectSQL = "SELECT * FROM `student`";

		$result = $db->fetch($selectSQL);

		echo "<pre>";
		print_r($result);
		echo "</pre>";

		$db->close();
	?>
</head>
</html>

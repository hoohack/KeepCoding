<html>
	<head>
		<meta charset='utf8'>
	</head>
	<body>
		<title>测试分页例子</title>
	</body>
</html>

<?php
	include 'page.class.php';

	$page = new Page(1000);

	//根据下面的SQL语句查询数据库中的内容即可实现分类
	$sql = "SELECT * FROM `article` {$page->limitStatement}";

	echo 'SQL = "'.$sql.'"<p>';

	echo $page->showPage();
?>

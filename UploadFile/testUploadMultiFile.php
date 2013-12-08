<?php
	include "uploadfile.class.php";

	if(isset($_POST['fileSub'])) {
		$uploadFile = new UploadFile;
		if($uploadFile->upload('myfile')) {
			print_r($uploadFile->newFileName);
			echo "上传成功!<br>";
		}else {
			print_r($uploadFile->errorMessage);
		}
	}
?>

<html>
	<head>
		<meta charset=utf8>
		<title>上传多个文件</title>
	</head>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
		选择文件1:<input type="file" name="myfile[]"><br>
		选择文件2:<input type="file" name="myfile[]"><br>
		选择文件3:<input type="file" name="myfile[]"><br>
		<input type="submit" name="fileSub" value="上传">
	</form>
</html>

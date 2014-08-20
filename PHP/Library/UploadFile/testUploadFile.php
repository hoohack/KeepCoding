<?php
	include "uploadfile.class.php";

	if(isset($_POST['fileSub'])) {
		$uploadFile = new UploadFile;
		if($uploadFile->upload('myfile')) {
			print_r($uploadFile->originName);
			echo "上传成功!<br>";
		}else {
			print_r($uploadFile->errorMessage);
		}
	}
?>

<html>
	<head>
		<meta charset=utf8>
		<title="上传文件示例">
	</head>
	<body>
		<form action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
			
			<p>选择文件:</p>
			<input type="file" name="myfile">
			<input type="submit" name="fileSub" value="提交">
		</form>
	</body>
</html>
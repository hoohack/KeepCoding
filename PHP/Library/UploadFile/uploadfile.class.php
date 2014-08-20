<?php
	/**
	* filaname:uploadfile.class.php
	* 文件上传类 UploadFile
	* 本类实现上传文件的功能，支持单个文件上传，也支持多个文件上传
	* @author HHQ
	* date:2013/12/06
	*/

	class UploadFile {
		private $filePath;		//上传文件后保存的路径，默认为当前目录下的uploads目录
		private $permitSize;	//上传的文件被允许的大小，默认允许的大小在1000000字节(100MB)以内
		private $permitTypes;	//设置限制上传文件的类型,默认允许的类型为图片的GIF，PNG，JPG三种
		private $isRandName;	//设置是否随机重命名文件，false表示不随机,true表示随机，默认为true

		private $originName;	//源文件名
		private $tempFileName;	//临时文件名
		private $fileType;		//文件类型
		private $fileSize;		//文件大小
		private $newFileName;	//新文件名
		private $errorNumber;	//错误信息代号
		private $errorMessage;	//错误信息

		//构造函数，设置默认值
		public function __construct() {
			$this->filePath = "./uploads";
			$this->permitSize = 1000000;
			$this->permitTypes = array('jpg', 'gif', 'png');
			$this->isRandName = true;
			
			$this->errorNumber = 0;
			$this->errorMessage = "";
		}

		/**
		  * 当为私有属性直接赋值时调用的赋值函数，并可以屏蔽掉非法值
		  * 成员属性名:propertyName
		  * 成员属性值:propertyValue
		  * 要求检查permitSize,allType两个属性
		  */
		public function __set($propertyName, $propertyValue) {
			if($propertyName == "permitSize") {
				if($propertyValue<=0 && $propertyValue>$this->permitSize) {
					return;
				}
			}

			if($propertyName == "allType") {
				$allTypeArray = array("gif", "png", "jpg");
				if(!in_array($propertyValue, $allTypeArray)) {
					return;
				}
			}

			if($propertyName == "newFileName") {
				if($this->israndname) {
					$this->$propertyName = $this->proRandName();
					return;
				}
			}
			
			$this->$propertyName = $propertyValue;
		}
		
		/**
		  * 在直接获取属性值时自动调用一次，以属性名作为参数传入处理
		  * 成员属性名:propertyName
		  */
		public function __get($propertyName) {
			return $this->$propertyName;
		}

		/*检查存放文件上传的目录是否存在*/
		private function checkFilePath() {
			if(empty($this->filePath)) {
				$this->errorNumber = -5;//表示路径为空，警告用户必须输入路径
				return false;
			}
			if(!file_exists($this->filePath) || !is_writable($this->filePath)) {
				if(!@mkdir($this->filePath)) {
					$this->errorNumber = -4;//表示创建目录失败，提示用户重新指定上传目录
					return false;
				}
			}
			
			return true;
		}

		/*检查上传的文件类型是否正确*/
		private function checkFileType() {
			if(in_array(strtolower($this->fileType), $this->permitTypes)) {
				return true;
			}else {
				$this->errorNumber = -1;//表示上传的文件类型不被允许
				return false;
			}
		}
		
		/*检查上传的文件大小是否合法，必须小于1000000字节*/	
		private function checkFileSize() {
			if($this->fileSize > $this->permitSize) {
				$this->errorNumber = -2;
				return false;
			}else {
				return true;
			}
		}
		

		/*获取错误信息，根据不同的错误代号返回不同的错误信息*/
		private function getError() {
			$errorInfo = "上传文件<font color='red'>{$this->originName}</font>时出错";

			switch($this->errorNumber) {
				case 4 : $errorInfo .= "没有文件被上传";break;
				case 3 : $errorInfo .= "文件只有部分被上传";break;
				case 2 : $errorInfo .= "上传的文件的大小超过了HTML表单中MAX_FILE_SIZE选项指定的值";break;
				case 1 : $errorInfo .= "上传的文件的大小超过了php.ini中的upload_max_filesize选项限制的值";break;
				case -1 : $errorInfo .= "未允许的文件类型";break;
				case -2 : $errorInfo .= "文件过大，上传的文件不能超过{$this->permitSize}个字节";break;
				case -3 : $errorInfo .= "上传失败";break;
				case -4 : $errorInfo .= "建立存放上传文件的目录失败，请重新指定上传目录";break;
				case -5 : $errorInfo .= "必须指定上传文件的路径";break;
				default : $errorInfo .= "未知错误";break;
			}

			return $errorInfo."<br>";
		}
		
		/**处理上传文件的函数
		 参数：fileField是上传文件的表单名称
		 	isSuccess bool 标志是否上传成功
		 */
		public function upload($fileField) {
			$isSuccess = true;

			//上传前先检查文件的路径是否正确
			if(!$this->checkFilePath()) {
				$this->errorMessage = $this->getError();
				return false;
			}
			
			//设置文件的相关信息
			$fileName = $_FILES[$fileField]['name'];
			$tempName = $_FILES[$fileField]['tmp_name'];
			$fileSize = $_FILES[$fileField]['size'];
			$errorMessage = $_FILES[$fileField]['error'];

			//如果是多文件上传的话用一个循环设置文件的信息
			if(is_Array($fileName)) {
				$errors = array();
				for($i = 0; $i != count($fileName); ++$i) {
					//此处设置文件为判断文件大小和类型做准备，但是不会真正上传文件
					if($this->setFileMessage($fileName[$i], $tempName[$i], $fileSize[$i], $errorMessage[$i])) {
						//返回结果检查文件的大小和类型是否符合要求
						if(!$this->checkFileSize() || !$this->checkFileType()) {
							$errors = $this->getError();
							$isSuccess = false;
						}
					}else {
						$errors = $this->getError();
						$isSuccess = false;
					}

					if(!$isSuccess) {
						//如果文件不符合要求，则上传失败，此时重置文件的信息
						$this->setFileMessage();
					}
				}

				if($isSuccess) {
					$fileNames = array();

					for($i = 0; $i != count($fileName); ++$i) {
						if($this->setFileMessage($fileName[$i], $tempName[$i], $fileSize[$i], $errorMessage[$i])) {
							$this->setNewFileName();//设置文件的新名字

							//保存上传后的文件
							if(!$this->saveFile()) {
								$errors[] = $this->getError();
								return false;
							}

							$fileNames[] = $this->newFileName;
						}
					}
					
					$this->newFileName = $fileNames;
				}

				//返回结果前设置错误信息
				$this->errorMessage = $errors;
				return $isSuccess;
			}else {
				//上传单个文件时的处理，就是上传多个文件时的其中一步操作
				if($this->setFileMessage($fileName, $tempName, $fileSize, $errorMessage)) {
					if($this->checkFileSize() && $this->checkFileType()) {
						$this->setNewFileName();

						if($this->saveFile()) {
							return $isSuccess;
						}else {
							$isSuccess = false;
						}
					}else {
						$isSuccess = false;
					}
				}else {
					$isSuccess = false;
				}

				if(!$isSuccess) {
					$this->errorMessage = $this->getError();
				}
				
				return $isSuccess;
			}

		}//end of upload function

		//设置文件相关信息的方法，分别是文件名，临时名，文件大小，错误信息
		private function setFileMessage($fileName="", $tempName="", $fileSize=0, $errorNumber=0) {
			$this->errorMessage = $errorNumber;
			if($errorNumber) {
				return false;
			}//如果有错误就不继续执行了
			
			$this->originName = $fileName;
			$this->tempName = $tempName;
			$this->fileSize = $fileSize;
			$fileStr = explode(".", $fileName);
			$this->fileType = strtolower($fileStr[count($fileStr)-1]);
			return true;
		}
		
		//设置新的文件名，如果能用随机文件名，则获取随机文件名，否则直接用源文件名
		private function setNewFileName() {
			if(!$this->isRandName) {
				$this->newFileName = $this->originName;
			}else {
				$this->newFileName = $this->getRandName();
			}
		}

		//获得随机文件名
		private function getRandName() {
			$randName = date('YmdHis')."_".rand(100,999);
			return $randName.'.'.$this->fileType;
		}

		//保存上传文件到指定路径
		private function saveFile() {
			//如果没有错误则添加上传文件到指定目录
			if(!$this->errorNumber) {
				$path = rtrim($this->filePath, '/').'/';
				$path .= $this->newFileName;
				if(move_uploaded_file($this->tempName, $path)) {
					return true;
				}else {
					$this->errorNumber = -3;
					return false;
				}
			}else {
				return false;
			}
		}

	}
/**
  *end of this class file
*/
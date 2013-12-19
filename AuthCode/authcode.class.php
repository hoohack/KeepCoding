<?php
	/**
	*生成验证码的类，验证码个数为4个
	*@file authcode.class.php
	*@author hhq
	*@class name:AuthCode
	*/

	class AuthCode {
		private $width;				//图片的宽度
		private $height;			//图片的高度
		private $authImage;			//验证码图片
		private $codeCount;			//验证码数量
		private $authString;		//验证码字符串
		
		/**
		*构造方法，初始化各个参数
		*参数列表
		*@param int $width	//设置验证码图片的宽度，默认值为90像素
		*@param int $height 	//设置验证码图片的高度，默认值为30像素
		*@param	int codeCount	//设置验证码的个数，默认值为4个
		 */
		public function __construct($width=90, $height=30, $codeCount=4) {
			$this->width = $width;
			$this->height = $height;
			$this->codeCount = $codeCount;
			$this->authString = $this->createAuthString();//获得本次的验证码
		}
	
		/*随机生成用户指定个数的字符串*/
		private function createAuthString() {
			$code = "23456789abcdefghijkmnpqrstuvwxyABCDEFGHIJKMNPQRSTUVWXY";
			$str = "";

			//生成随机验证码
			for($codeIndex = 0; $codeIndex != $this->codeCount; ++$codeIndex) {
				$authChar = $code{rand(0, strlen($code)-1)};

				$str .= $authChar;
			}

			return $str;
		}

		/*重写toString方法，输出验证吗图片；同时在SESSION中保存了验证码的值，使用echo方法输出对象即可看到验证码图片*/
		public function __toString() {
			$_SESSION["authcode"] = $this->authString;

			$this->outputImage();

			return '';
		}

		/*输出图像*/
		private function outputImage() {
			$this->createImage();
			$this->setDisturbElements();
			$this->outputText();
			$this->renderImage();
		}

		/*创建图片资源，并初始化背景*/
		private function createImage() {
			$this->authImage = imagecreatetruecolor($this->width, $this->height);

			$backgroundColor = imagecolorallocate($this->authImage, rand(225, 255), rand(225, 255), rand(225, 255));

			@imagefill($this->authImage, 0, 0, $backgroundColor);

			$borderColor = imagecolorallocate($this->authImage, 0, 0, 0);
			imagerectangle($this->authImage, 0, 0, $this->width-1, $this->height-1, $borderColor);
		}
		
		/*设置干扰因素，在图片后面添加点和线的干扰*/
		private function setDisturbElements() {
			$lineCount = 10;
			$pointCount = 100;

			for($i = 0; $i != $pointCount; ++$i) {
				$pointColor = imagecolorallocate($this->authImage, rand(0, 255), rand(0, 255), rand(0, 255));
				imagesetpixel($this->authImage, rand(1, $this->width-2), rand(1, $this->height-2), $pointColor);
			}

			for($i = 0; $i != $lineCount; ++$i) {
				$lineColor = imagecolorallocate($this->authImage, rand(0, 255), rand(0, 255), rand(0, 255));
				imageline($this->authImage, rand(1, $this->width/2), rand(1, $this->height/2), 
						rand($this->width/2+1, $this->width-1), rand($this->height/2+1, $this->height-1), $lineColor);
			}
		}

		/*将随机生成的字符串添加到图像中*/
		private function outputText() {
			for($i = 0; $i < $this->codeCount; ++$i) {
				$fontColor = imagecolorallocate($this->authImage, rand(0, 128), rand(0, 128), rand(0, 128));
				$fontSize = rand(4, 5);
				$x = floor($this->width/$this->codeCount)*$i + 3;//为了让四个字符有足够的位置输出
				$y = rand(0, $this->height - imagefontheight($fontSize));
				imagechar($this->authImage, $fontSize, $x, $y, $this->authString{$i}, $fontColor);
			}
		}

		/*检测GD支持的图像类型，并输出图像*/
		private function renderImage() {
			if(imagetypes() & IMG_GIF) {
				header("Content-type: image/gif");
				imagegif($this->authImage);
			}elseif(imagetypes() & IMG_JPG) {
				header("Content-type: image/jpeg");
				imagejpeg($this->authImage);
			}elseif(imagetypes() & IMG_PNG) {
				header("Content-type: image/png");
				imagepng($this->authImage);
			}elseif(imagetypes() & IMG_WBMP) {
				header("Content-type: image/vnd.wap.wbmp");
				imagewbmp($this->authImage);
			}else {
				trigger_error("php不支持图像创建", E_USER_ERROR);
			}
		}

		/*析构方法，在对象结束之前自动销毁图像资源并释放内存*/
		public function __destruct() {
			imagedestroy($this->authImage);
		}
	}

/*End of the file*/

<?php
	/**
	*生成验证码的类，验证码个数为4个
	* file name authcode.class.php
	* class name:AuthCode
	* @author hhq
	*/

	class AuthCode {
		private $width;				//图片的宽度
		private $height;			//图片的高度
		private $authImage;			//验证码图片
		private $codeCount;			//验证码数量
		private $authString;		//验证码字符串
		private $fontSize;			//字体大小

		/**
		 * __construct function
		 * 功能 		构造方法，初始化各个参数
		 * @param	int		$width		//设置验证码图片的宽度，默认值为90像素
		 * @param	int		$height		//设置验证码图片的高度，默认值为50像素
		 * @param	int		$codeCount	//设置验证码的个数，默认值为4个
		 * @author	hhq
		 */
		public function __construct($width=90, $height=30, $codeCount=4) {
			$this->width = $width;
			$this->height = $height;
			$this->codeCount = $codeCount;
			$this->fontSize = 16;
			$this->authString = $this->createAuthString();//获得本次的验证码
		}

		/**
		 * createAuthString function
		 * 功能		随机生成用户指定个数的字符串
		 * @access	private
		 * @return	string
		 * @author	hhq
		 */
		private function createAuthString() {
			//验证码中可用的字符
			$code = "23456789abcdefghijkmnpqrstuvwxyABCDEFGHIJKMNPQRSTUVWXY";
			
			//生成的验证码
			$authcode = "";

			//生成随机验证码,从可用字符中随机选择一个,循环codeCount次
			for($codeIndex = 0; $codeIndex != $this->codeCount; ++$codeIndex) {
				$authChar = $code{rand(0, strlen($code)-1)};

				$authcode .= $authChar;
			}

			return $authcode;
		}

		/**
		 * function __toString
		 * 功能	重写toString方法，输出验证吗图片；同时在SESSION中保存了验证码的值，使用echo方法输出对象即可看到验证码图片
		 * @access	public
		 * @return	string
		 */
		public function __toString() {
			$_SESSION["authcode"] = $this->authString;
	
			//输出图像
			$this->outputImage();

			return '';
		}

		/**
		 * outputImage function
		 * 功能	输出图像
		 * @access	public
		 * @author	hhq
		 */
		private function outputImage() {
			$this->createImage();
			$this->setDisturbElements();
			$this->outputText();
			$this->renderImage();
		}
		
		/**
		 * createImage function
		 * 功能	创建图片资源，并初始化背景
		 * @access	private
		 * @author	hhq
		 */
		private function createImage() {
			$this->authImage = imagecreatetruecolor($this->width, $this->height);

			$backgroundColor = imagecolorallocate($this->authImage, rand(225, 255), rand(225, 255), rand(225, 255));

			@imagefill($this->authImage, 0, 0, $backgroundColor);

			$borderColor = imagecolorallocate($this->authImage, 0, 0, 0);
			imagerectangle($this->authImage, 0, 0, $this->width-1, $this->height-1, $borderColor);
		}
		
		/**
		 * setDisturbElements function
		 * 功能	设置干扰因素，在图片后面添加点和线的干扰
		 * @access	private
		 * @author	hhq
		 */
		private function setDisturbElements() {
			$lineCount = 3;
			$pointCount = 50;

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
		
		/**
		 * outputText function
		 * 功能	将随机生成的字符串添加到图像中
		 * @access	private
		 * @author	hhq
		 */
		private function outputText() {
			for($i = 0; $i < $this->codeCount; ++$i) {
				$fontColor = imagecolorallocate($this->authImage, rand(0, 128), rand(0, 128), rand(0, 128));
				$x = floor($this->width/$this->codeCount)*$i + 3;//为了让四个字符有足够的位置输出
				$y = rand(1, $this->height - imagefontheight($this->fontSize));
				if($y > 10) {
					$y = 10;
				}
				imagechar($this->authImage, $this->fontSize, $x, $y, $this->authString{$i}, $fontColor);
			}
		}
		
		/**
		 * renderImage function
		 * 功能	检测GD支持的图像类型，并输出图像
		 * @access	private
		 * @author	hhq
		 */
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
		
		/**
		 * __destrut function
		 * 功能	析构方法，在对象结束之前自动销毁图像资源并释放内存
		 * @author	hhq
		 */
		public function __destruct() {
			$y = rand(1, $this->height - imagefontheight($this->fontSize));
			//echo $y;
			//echo $this->fontSize;
			//echo imagefontheight($this->fontSize);
			if($this->authImage) {
				imagedestroy($this->authImage);
			}
		}
	}

/*End of the file*/

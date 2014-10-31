<?php
	class LoggedException extends Exception {
		public function __construct($message = null, $code = 0, 
			$file = "/var/log/phpException.log") {
			$this->log($file);
			parent::__construct($message, $code);
		}

		protected function log($file) {
			file_put_contents($file, $this->__toString(), FILE_APPEND);
		}
	}

	// $e = new LoggedException();
	// throw $e;
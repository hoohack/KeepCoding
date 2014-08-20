<?php
	/*
	*file:database.class.php
	*数据库处理类,通过PDO类写出自己的数据库类,便于支持多种数据库和防SQL注入
	*实现数据库的连接、断开，增删查改等相关操作
	*author:hhq
	*/

	class DataBase {
		private $username;				//用户名
		private $password;				//密码
		private $SQLStatement;			//SQL语句
		private $dbname;				//数据库名字
		private $errorMessage;			//错误信息
		private $dbh;					//PDO对象
		private $dsn;					//数据源名，即不同的数据库模式如mysql,orcle
		private $driveropt;				//PDO类的参数选项
		private $stmt;					//PDO准备语句

		public function __construct($dsn="mysql:dbname=SCAUZF;host=127.0.0.1", $username="root", $password="root", $dbname="SCAUZF", $driveropt=false) {
			$this->dsn = $dsn;
			$this->username = $username;
			$this->password = $password;
			$this->dbname = ":dbname";

			//设置为持久连接
			$this->driveropt = array(PDO::ATTR_PERSISTENT => true);

			try {
				$this->dbh = new PDO($this->dsn, $this->username, $this->password, $this->driveropt);
			}catch(PDOException $e) {
				trigger_error("数据库连接失败: ".$e->getMessage(), E_USER_ERROR);
			}

			//将返回的空字符串转换为SQL的NULL
			$this->dbh->setAttribute(PDO::ATTR_ORACLE_NULLS, true);
		}

		public function __set($propertyName, $propertyValue) {
			$this->$propertyName = $propertyValue;
		}

		public function __get($propertyName) {
			if($propertyName == "password") {
				return null;
			}else {
				return $this->$propertyName;
			}
		}

		/**执行数据库的增，改，删，即没有结果集
			先进行PDO的预处理，然后执行一个准备好的预处理查询
			如果执行成功返回true，否则返回false
			param是一个参数关联数组，关联到SQL语句的字段
		*/
		public function execute($SQLStatement, $param = array()) {
			$this->stmt = $this->dbh->prepare($SQLStatement);

			$this->stmt->execute($param);
			// print_r($param);
			if($this->stmt) {
				return true;
			}else {
				$this->errorMessage = $this->stmt->errorInfo();
				return false;
			}
		}

		/**执行数据库的查询操作，返回结果集中的所有行
			column指明返回所查询行中的第几列，如果为0则返回一整行
		*/
		public function fetchAll($SQLStatement, $column=0) {
			$this->stmt = $this->dbh->prepare($SQLStatement);

			$this->stmt->execute();

			if($this->stmt) {
				if($column) {
					return $this->stmt->fetchAll(PDO::FETCH_BOTH, $column);
				}else {
					return $this->stmt->fetchAll(PDO::FETCH_BOTH);
				}
			}
		}

		/**执行数据库的查询操作，返回结果集中的一行
			column指明返回所查询行中的第几列，如果为0则返回一整行
		*/
		public function fetch($SQLStatement, $column=0) {
			$this->stmt = $this->dbh->prepare($SQLStatement);

			$this->stmt->execute();

			if($this->stmt) {
				if($column) {
					return $this->stmt->fetch(PDO::FETCH_BOTH, $column);
				}else {
					return $this->stmt->fetch(PDO::FETCH_BOTH);
				}
			}
		}

		//断开连接
		public function close() {
			$this->dbh = null;
			$this->stmt = null;
		}

	}

/**end of this class*/
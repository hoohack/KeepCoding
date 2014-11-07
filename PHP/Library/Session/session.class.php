<?php
    /**
    * Session类
    * 使用mysql数据库存储session
    * tb_session
    *   key varchar(255) not null (PK)
    *   value text
    *   created_time int(11) unsigned not null
    */
    class My_Session {
        private $_db;

        private $_table;

        private $_gc_lifetime;
        
        public function __construct($host, $username, $pwd, $db, $table) {
            if (!($this->_db = mysql_connect($host, $username, $pwd))) {
                trigger_error('Conncet database failed', E_USER_ERROR);
            }

            if (!($selected = mysql_select_db($db, $this->_db))) {
                trigger_error('Select database failed', E_USER_ERROR);
            }

            $this->_table = $table;

            session_set_save_handler(array(&$this, 'open'), array(&$this, 'close'), array(&$this, 'read'), array(&$this, 'write'), array(&$this, 'destroy'), array(&$this, 'gc'));

            if ($this->_gc_lifetime > 0) {
                ini_set('session.gc_maxlifetime', $this->_gc_lifetime);
            } else {
                $this->_gc_lifetime = ini_get('session.gc_maxlifetime');
            }

            return session_start();
        }

        /**
        * 
        * 打开session
        *
        */
        public function open() {
            return true;
        }
        
        /**
        * 
        * 保存session数据
        *
        */
        public function write($session_key, $value) {
            echo 'write';
            $now_time = time();
            $session_key = mysql_real_escape_string($session_key);
            $value = mysql_real_escape_string($value);

            $sql = "INSERT INTO `$this->_table` VALUES ('$session_key', '$value', $now_time)";
            // echo $sql;
            return mysql_query($sql, $this->_db);
        }
        
        /**
        *
        * 返回特定session key的数据
        *
        */
        public function read($session_key) {
            echo 'read';
            if ($session_key !== NULL) {
                $session_key = mysql_real_escape_string($session_key);
                // var_dump($session_key);
                $sql = "SELECT `value` FROM `$this->_table` WHERE `key` = '$session_key' LIMIT 1";

                if ($result = mysql_fetch_assoc(mysql_query($sql, $this->_db))) {
                    return $result['value'];
                }
                print_r($result);
            }

            return '';
        }
        
        /**
        *
        * 删除session数据
        *
        */
        public function destroy($session_key) {
            $sql = "DELETE FROM `$this->_table` WHERE `key` = '$session_key' LIMIT 1";
            return mysql_query($sql, $this->_db);
        }
        
        /**
        *
        * 进行一些清理操作
        *
        */
        public function gc() {
            $expire = time() - $this->_gc_lifetime;
            $sql = "DELETE FROM `$this->_table` WHERE `created_time` < $expire";
            return mysql_query($sql, $this->_db);
        }

        public function close() {
            $this->gc($this->_gc_lifetime);
            return mysql_close($this->_db);
        }
  }
//End of session class
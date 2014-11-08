<?php
    /**
    *
    * Session类，实现SessionHandlerInterface接口
    * PHP version >= PHP 5.4.0
    * 使用mysql数据库存储session
    * 执行顺序
    * open -> read -> write -> close -> gc
    * tb_session
    *   key varchar(255) not null (PK)
    *   value text
    *   created_time int(11) unsigned not null
    * @date 2014/11/8
    *
    */
    class My_Session implements SessionHandlerInterface {
        //数据库连接句柄
        private $_db_link;

        //数据库表名
        private $_table;

        //session生存时间
        private $_gc_lifetime;

        /**
        * 
        * 打开session
        *
        */
        public function open($save_path, $session_name) {
            $this->_save_path = $save_path;
            if (!is_dir($this->_save_path)) {
                mkdir($this->save_path, 0777);
            }
            $host = 'localhost';
            $username = 'root';
            $pwd = 'root';
            $db = 'test';
            $this->_table = 'tb_session';
            if (!($this->_db_link = mysql_connect($host, $username, $pwd))) {
                trigger_error('Conncet database failed', E_USER_ERROR);
            }

            if (!($selected = mysql_select_db($db, $this->_db_link))) {
                trigger_error('Select database failed', E_USER_ERROR);
            }
            if ($this->_gc_lifetime > 0) {
                ini_set('session.gc_maxlifetime', $this->_gc_lifetime);
            } else {
                $this->_gc_lifetime = ini_get('session.gc_maxlifetime');
            }
            return true;
        }
        
        /**
        * 
        * 保存session数据
        *
        */
        public function write($session_key, $value) {
            $now_time = time();
            $session_key = mysql_real_escape_string($session_key);
            $value = mysql_real_escape_string($value);

            $sql = "INSERT INTO `$this->_table` (`key`, `value`, created_time) VALUES ('$session_key', '$value', $now_time)";
            return mysql_query($sql, $this->_db_link);
        }
        
        /**
        *
        * 返回特定session key的数据
        *
        */
        public function read($session_key) {
            if (isset($session_key) && !empty($session_key)) {
                $session_key = mysql_real_escape_string($session_key);
                $sql = "SELECT `value` FROM `$this->_table` WHERE `key` = '$session_key' LIMIT 1";

                if ($result = mysql_fetch_assoc(mysql_query($sql, $this->_db_link))) {
                    return $result['value'];
                }
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
            return mysql_query($sql, $this->_db_link);
        }
        
        /**
        *
        * 进行一些清理操作
        *
        */
        public function gc($maxlifetime) {
            $maxlifetime = $this->_gc_lifetime;
            $expire = time() - $maxlifetime;
            $sql = "DELETE FROM `$this->_table` WHERE `created_time` < $expire";
            return mysql_query($sql, $this->_db_link);
        }

        public function close() {
            $this->gc($this->_gc_lifetime);
            return mysql_close($this->_db_link);
        }
  }
//End of session class
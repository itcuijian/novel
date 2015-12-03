<?php
	//数据库连接类
	class DB {
		
		//获取对象句柄
		static public function getDB() {
			$_mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			if (mysqli_connect_errno()) {
				echo '数据库连接错误！错误代码：'.mysqli_connect_error();
				exit();
			}
			$_mysqli->set_charset('utf8');
			return $_mysqli;
		}
		
		//清理
		static public function unDB(&$_result, &$_db) {	
			if (is_object($_result)) {
				//清理结果集
				$_result->free();
				$_result = null;
			}
			if (is_object($_db)) {
				$_db->close();
				$_db = null;
			}
		}

		
	}
?>
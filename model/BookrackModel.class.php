<?php

//书籍模型类
class BookrackModel extends Model{

	private $limit;


	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}


	//获取用户书架的书籍数量
	public function getNumber($rid){
		$sql = "SELECT COUNT(*) FROM bookrack WHERE rid='$rid'";

		return parent::total($sql);
	}


	//获取某本书的订阅数量
	public function getRacks($bid){
		$sql = "SELECT COUNT(*) count FROM bookrack WHERE bid='$bid'";

		return parent::total($sql);
	}


	//获取书架中所有的书籍
	public function getBookrack($rid){
		$sql = "SELECT b.kid,b.name,b.aid aid,br.bid,b.time,br.sid 
		          FROM bookrack br,book b 
		          WHERE br.rid='$rid' AND br.bid=b.id 
		          ORDER BY b.time DESC
		          $this->limit";

		return parent::all($sql);
	}


	//检验是否有记录
	public function checkId($bid, $rid){
		$sql = "SELECT bid FROM bookrack WHERE bid='$bid' AND rid='$rid' LIMIT 0,1";

		return parent::one($sql);
	}


	//添加
	public function add($sid, $bid, $rid){
		$sql  = "INSERT INTO bookrack(sid,bid,rid) VALUES('$sid','$bid','$rid')";

		return parent::aud($sql);
	}


	//更新章节记录
	public function updateSid($sid, $bid, $rid){
		$sql = "UPDATE bookrack SET sid='$sid' WHERE bid='$bid' AND rid='$rid'";

		return parent::aud($sql);
	}

	//删除
	public function delete($bid, $rid){
		$sql = "DELETE FROM bookrack WHERE bid='$bid' AND rid='$rid'";

		return parent::aud($sql);
	}

	
	
}

?>
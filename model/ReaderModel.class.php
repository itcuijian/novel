<?php

class ReaderModel extends Model{
	private $limit;


	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}


	//检验邮箱是否已存在
	public function checkEmail($email){
		$sql = "SELECT id FROM reader WHERE email='$email'";

		return parent::one($sql);
	}


	//获取记录数量
	public function getReaderToatal($key=""){
		$sql = "SELECT COUNT(*) FROM reader WHERE reader LIKE '%$key%' OR email LIKE '%$key%'";

		return parent::total($sql);
	}


	//获取所有数据
	public function getAllReader($key=""){
		$sql = "SELECT id,email,reader,state FROM reader WHERE reader LIKE '%$key%' OR email LIKE '%$key%' $this->limit";

		return parent::all($sql);
	}

	//修改头像
	public function updateFace($id, $face){
		$sql = "UPDATE reader SET face='$face' WHERE id='$id'";

		return parent::aud($sql);
	}


	//检验昵称是否已存在
	public function checkReader($reader, $id){
		$sql = "SELECT id FROM reader WHERE reader='$reader' AND id!='$id'";

		return parent::one($sql);
	}


	//获取一条数据
	public function getOneReader($id){
		$sql = "SELECT * FROM reader WHERE id=$id";

		return parent::one($sql);
	}

	//读者登录检验
	public function checkLogin($email, $pass){
		$sql = "SELECT id,reader,face FROM reader WHERE email='$email' AND pass='$pass'";

		return parent::one($sql);
	}

	//添加数据
	public function add($email, $reader, $pass, $time){
		$sql = "INSERT INTO reader(email,reader,pass,time) VALUES('$email','$reader','$pass', $time)";

		return parent::aud($sql);
	}

	//后台修改数据
	public function update($id, $reader, $pass, $state){
		$sql = "UPDATE reader SET reader='$reader',pass='$pass',state='$state' WHERE id='$id'";

		return parent::aud($sql);
	}


	//前台修改数据
	public function updateFront($id, $reader, $adress, $sex, $pass, $info){
		$sql = "UPDATE reader SET reader='$reader',adress='$adress',sex='$sex',pass='$pass',info='$info' WHERE id='$id'";

		return parent::aud($sql);
	}

	//删除数据
	public function delete($id){
		$sql = "DELETE FROM reader WHERE id='$id'";

		return parent::aud($sql);
	}


	//修改状态
	public function changeState($id, $state){
		$sql = "UPDATE reader SET state='$state' WHERE id='$id'";

		return parent::aud($sql);
	}
}

?>
<?php

//作者数据模型
class AuthorModel extends Model{

	private $limit;

	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}


	//获取记录数量
	public function getAuthorTotal($key=""){
		$sql = "SELECT COUNT(*) FROM author WHERE name LIKE '%$key%' OR pseudonym LIKE '%$key%' OR email LIKE '%$key%'";

		return parent::total($sql);
	}


	//获取全部数据
	public function getAllAuthor($key=""){
		$sql = "SELECT * FROM author WHERE name LIKE '%$key%' OR pseudonym LIKE '%$key%' OR email LIKE '%$key%' ORDER BY id DESC $this->limit";

		return parent::all($sql);
	}


	//获取特定一条数据
	public function getOneAuthor($id){
		$sql = "SELECT * FROM author WHERE id='$id'";

		return parent::one($sql);
	}


	//检验登录
	public function login($email, $pass){
		$sql = "SELECT id,pseudonym FROM author WHERE email='$email' AND pass='$pass'";

		return parent::one($sql);
	}


	//检验邮箱是否已存在
	public function checkEmail($email){
		$sql = "SELECT id FROM author WHERE email='$email'";

		return parent::one($sql);
	}


	//检验笔名是否已存在
	public function checkPseudonym($pseudonym){
		$sql = "SELECT id FROM author WHERE pseudonym='$pseudonym'";

		return parent::one($sql);
	}


	//增加数据
	public function add($email, $name, $pass, $pseudonym){
		$sql = "INSERT INTO author(email,name,pass,pseudonym) VALUES('$email','$name','$pass','$pseudonym')";

		return parent::aud($sql);
	}


	//修改数据
	public function update($id, $name, $pseudonym, $pass){
		$sql = "UPDATE author SET name='$name',pseudonym='$pseudonym',pass='$pass' WHERE id='$id'";

		return parent::aud($sql);
	}


	//删除数据
	public function delete($id){
		$sql = "DELETE FROM author WHERE id='$id'";

		return parent::aud($sql);
	}
}

?>
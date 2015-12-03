<?php

class ManageModel extends Model{
	private $limit;

	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}


	//获取后台用户
	public function getLoginManage($user, $pass){
		$sql = "SELECT m.user,m.level,m.pass,l.name FROM manage m,level l WHERE m.user='$user' AND m.level = l.id";

		return parent::one($sql);
	}


	//获取所有权限等级
	public function getAllLevel()
	{
		$sql = "SELECT id,name FROM level";

		return parent::all($sql);
	}

	//获取记录总数量
	public function getManageTotal(){
		$sql = "SELECT COUNT(*) FROM manage";

		return parent::total($sql);
	}


	//获取所有记录
	public function getAllManage($key="")
	{
		$sql = "SELECT * FROM
				(SELECT m.id,m.user,l.name FROM manage m,level l WHERE l.id=m.level) a 
				WHERE a.user LIKE '%$key%' OR a.name LIKE '%$key%'
				$this->limit";

		return parent::all($sql);
	}


	//后台模糊查找的数量
	public function getNumberBy($key="")
	{
		$sql = "SELECT COUNT(*) FROM
				(SELECT m.id,m.user,l.name FROM manage m,level l WHERE l.id=m.level) a 
				WHERE a.user LIKE '%$key%' OR a.name LIKE '%$key%'";

		return parent::total($sql);
	}


	//获取一条数据
	public function getOneManage($id){
		$sql = "SELECT user,level,pass FROM manage WHERE id='$id'";

		return parent::one($sql);
	}

	//新增数据
	public function add($user, $pass, $level){
		$sql = "INSERT INTO manage(user,pass,level) VALUES('$user','$pass','$level')";

		return parent::aud($sql);
	}

	//更新数据
	public function update($id, $user, $pass, $level){
		$sql = "UPDATE manage SET user='$user',pass='$pass',level='$level' WHERE id='$id' LIMIT 1";

		return parent::aud($sql);
	}

	//删除
	public function delete($id)
	{
		$sql = "DELETE FROM manage WHERE id='$id'";

		return parent::aud($sql);
	}
}

?>
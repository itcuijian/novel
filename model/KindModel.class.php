<?php

//作者数据模型
class KindModel extends Model{

	private $limit;


	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}


	//获取非主类别
	public function getChild(){
		$sql = "SELECT id,name FROM kind WHERE pid<>0";

		return parent::all($sql);
	}


	//前台获取主类别
	public function getFronKind(){
		$sql = "SELECT id,name FROM kind WHERE pid=0";

		return parent::all($sql);
	}


	//主页获取6个主类别
	public function getSixKind(){
		$sql = "SELECT id,name FROM kind WHERE pid=0 LIMIT 0,6";

		return parent::all($sql);
	}

	//排行榜获取7个主类别
	public function getSevenKind(){
		$sql = "SELECT id,name FROM kind WHERE pid=0 LIMIT 0,7";

		return parent::all($sql);
	}

	//前台获取子类别
	public function getFronKChild($pid){
		$sql = "SELECT id,name FROM kind WHERE pid='$pid'";

		return parent::all($sql);
	}

	//获取主类别数量
	public function getKindToatal($key=""){
		$sql = "SELECT COUNT(*) FROM kind WHERE pid=0 AND name LIKE '%$key%'";

		return parent::total($sql);
	}


	//检查类别名称是否重复
	public function checkName($name){
		$sql = "SELECT id FROM kind WHERE name='$name'";

		return parent::one($sql);
	}


	//获取所有主类别
	public function getAllKind($key=''){
		$sql = "SELECT id,name,info FROM kind WHERE pid=0 AND name LIKE '%$key%' $this->limit";

		return parent::all($sql);
	}


	//获取主类别下子类别的数量
	public function getChildTotal($pid, $key=''){
		$sql = "SELECT COUNT(*) FROM kind WHERE pid='$pid' AND name LIKE '%$key%'";

		return parent::total($sql);
	}


	//获取主类别下的子类别
	public function getAllChild($pid, $key=''){
		$sql = "SELECT id,name,info FROM kind WHERE pid='$pid' AND name LIKE '%$key%' $this->limit";

		return parent::all($sql);
	}


	//获取单个类型
	public function getOneKind($id){
		$sql = "SELECT k1.name,k1.info,k2.id iid,k2.name nname FROM kind k1 LEFT JOIN kind k2 ON k1.pid=k2.id WHERE k1.id='$id'";

		return parent::one($sql);
	}


	//新增类别
	public function add($name, $info, $pid){
		$sql = "INSERT INTO kind(name,info,pid) VALUES('$name','$info','$pid')";

		return parent::aud($sql);
	}


	//修改类别
	public function update($id, $name, $info){
		$sql = "UPDATE kind SET name='$name',info='$info' WHERE id='$id'";

		return parent::aud($sql);
	}


	//删除
	public function delete($id){
		$sql = "DELETE FROM kind WHERE id='$id' LIMIT 1";

		return parent::aud($sql);
	}
}

?>
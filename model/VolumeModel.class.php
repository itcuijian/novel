<?php

//分卷模型类
class VolumeModel extends Model{

	private $limit;


	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}


	//获取书籍的分卷数量
	public function getAllVolumeTotal($bid){
		$sql = "SELECT COUNT(*) FROM volume WHERE bid='$bid'";

		return parent::total($sql);
	}


	//获取某本书的分卷
	public function getVolumeOfBook($bid){
		$sql = "SELECT id,name FROM volume WHERE bid='$bid'";

		return parent::all($sql);
	}


	//获取书籍的所有分卷
	public function getAllVolume($bid){
		$sql = "SELECT id,name,time FROM volume WHERE bid='$bid' $this->limit";

		return parent::all($sql);
	}


	//获取书籍的所有分卷，不带limit
	public function getVolumes($bid){
		$sql = "SELECT id,name FROM volume WHERE bid='$bid'";

		return parent::all($sql);
	}


	//新增分卷
	public function add($bid, $name, $time){
		$sql = "INSERT INTO volume(name,bid,time) VALUES('$name','$bid','$time')";

		return parent::aud($sql);
	}

	//更新分卷
	public function update($id, $name){
		$sql = "UPDATE volume SET name='$name' WHERE id='$id'";

		return parent::aud($sql);
	}


	//删除
	public function delete($id){
		$sql = "DELETE FROM volume WHERE id='$id'";

		return parent::aud($sql);
	}


	//删除分卷，根据书籍编号
	public function deleteByBid($bid){
		$sql = "DELETE FROM volume WHERE bid='$bid'";

		return parent::aud($sql);
	}


}

?>
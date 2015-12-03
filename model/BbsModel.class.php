<?php

//书籍模型类
class BbsModel extends Model{

	private $limit;


	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}

	//获取总数量
	public function getAllTotal(){
		$sql = "SELECT COUNT(*) FROM bbs";

		return parent::total($sql);
	}


	//获取除了公告之外的帖子总量
	public function getTotalExceptNotice(){
		$sql = "SELECT COUNT(*) FROM bbs WHERE rid<>6";

		return parent::total($sql);
	}


	//获取通过审核总数量
	public function getNumberOfState(){
		$sql = "SELECT COUNT(*) FROM bbs WHERE state!=0";

		return parent::total($sql);
	}


	//获取用户的帖子数量
	public function getNumberByRid($rid, $key=""){
		$sql = "SELECT COUNT(*) FROM bbs WHERE rid='$rid' AND title LIKE '%$key%'";

		return parent::total($sql);
	}


	//获取用户的所有帖子
	public function getAllByRid($rid, $key=""){
		$sql = "SELECT id,time,title FROM bbs WHERE rid='$rid' AND title LIKE '%$key%' ORDER BY time DESC";

		return parent::all($sql);
	}


	//获取某帖子
	public function getBBs($id){
		$sql = "SELECT b.title,b.content,r.reader,b.time,b.state FROM bbs b,reader r WHERE b.id='$id' AND b.rid=r.id";

		return parent::one($sql);
	}


	//获取所有帖子
	public function getAllbbs(){
		$sql = "SELECT b.id,b.title,r.reader,b.state,b.time,r.face 
				  FROM bbs b,reader r
				 WHERE b.rid=r.id 
				 ORDER BY b.state DESC,b.time DESC
				 $this->limit";

		return parent::all($sql);
	}


	//获取初公告之外的所有帖子
	public function getAllEceptNotice($key=""){
		$sql = "SELECT * FROM
				(SELECT b.id,b.title,r.reader,b.state,b.time,r.face 
				  FROM bbs b,reader r
				 WHERE b.rid=r.id AND b.rid<>6 
				 ORDER BY b.state DESC,b.time DESC) a
				 WHERE a.title LIKE '%$key%' OR a.reader LIKE '%$key%'
				 $this->limit";

		return parent::all($sql);
	}
	

	//后台模糊查找时的数量
	public function getNumberBy($key=""){
		$sql = "SELECT COUNT(*) FROM
				(SELECT b.id,b.title,r.reader,b.state,b.time,r.face 
				  FROM bbs b,reader r
				 WHERE b.rid=r.id AND b.rid<>6 
				 ORDER BY b.state DESC,b.time DESC) a
				 WHERE a.title LIKE '%$key%' OR a.reader LIKE '%$key%'";

		return parent::total($sql);
	}


	//添加
	public function add($rid, $title, $content, $time){
		$sql = "INSERT INTO bbs(rid,title,content,time) VALUES('$rid','$title','$content','$time')";

		return parent::aud($sql);
	}


	//发表公告
	public function notice($rid, $title, $content, $time, $state){
		$sql = "INSERT INTO bbs(rid,title,content,time,state) VALUES('$rid','$title','$content','$time','$state')";

		return parent::aud($sql);
	}


	//修改公告
	public function updateNotice($id, $title, $content){
		$sql = "UPDATE bbs SET title='$title',content='$content' WHERE id='$id'";

		return parent::aud($sql);
	}


	//更改状态
	public function updateState($id, $state){
		$sql = "UPDATE bbs SET state='$state' WHERE id='$id'";

		return parent::aud($sql);
	}


	//删除
	public function delete($id){
		$sql = "DELETE FROM bbs WHERE id='$id'";

		return parent::aud($sql);
	}

	
}

?>
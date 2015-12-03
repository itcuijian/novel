<?php

//章节模型类
class SectionModel extends Model{
	private $limit;


	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}


	//获取所有章节的数量
	public function getAllTotal(){
		$sql = "SELECT COUNT(*) FROM section";

		return parent::total($sql);
	}


	//获取所有章节
	public function getSection($key=""){
		$sql = "SELECT * FROM
				(SELECT s.id,s.title,b.name,s.state,s.time 
		          FROM section s,book b 
		          WHERE s.bid=b.id 
		          ORDER BY s.state ASC,s.time DESC) a 
				  WHERE a.title LIKE '%$key%' OR a.name LIKE '%$key%'
		          $this->limit";

		return parent::all($sql);
	}


	//后台模糊查找时用到的数量
	public function getNumberBy($key=""){
		$sql = "SELECT COUNT(*) FROM
				(SELECT s.id,s.title,b.name,s.state,s.time 
		          FROM section s,book b 
		          WHERE s.bid=b.id 
		          ORDER BY s.state ASC,s.time DESC) a 
				  WHERE a.title LIKE '%$key%' OR a.name LIKE '%$key%'";

		return parent::total($sql);
	}


	//获取某分卷下所有章节
	public function getSectionOfVolume($vid){
		$sql = "SELECT id,title FROM section WHERE vid='$vid'";

		return parent::all($sql);
	}


	//获取章节细节
	public function getDetails($id){
		$sql = "SELECT s.title,b.name,s.state,s.time,v.name vname,s.content,s.count,a.pseudonym,s.bid 
		          FROM section s,book b,volume v,author a 
		          WHERE s.id='$id' AND s.bid=b.id AND s.vid=v.id AND b.aid=a.id";

		return parent::one($sql);
	}


	//获取某一书籍章节的数量
	public function getAllSectionTotal($bid){
		$sql = "SELECT COUNT(*) FROM section WHERE bid='$bid'";

		return parent::total($sql);
	}


	//获取书籍的所有章节
	public function getAllSection($bid){
		$sql = "SELECT s.id,s.title,s.time,s.state,s.count,v.name FROM section s, book b,volume v
					WHERE s.bid=b.id AND s.bid='$bid' AND s.vid=v.id ORDER BY id DESC $this->limit";

		return parent::all($sql);
	}


	//获取最新的章节
	public function getLatest($bid){
		$sql = "SELECT s.id,s.title,s.time,v.name,s.content FROM section s,volume v 
					WHERE s.vid=v.id AND s.bid='$bid' ORDER BY s.time DESC LIMIT 0,1";

		return parent::one($sql);
	}


	//获取某本书的第一章
	public function getFirst($bid){
		$sql = "SELECT id FROM section WHERE bid='$bid' ORDER BY id ASC LIMIT 0,1";

		return parent::one($sql);
	}


	//获取某章节的上一章
	public function getBefore($id, $bid){
		$sql = "SELECT id FROM section WHERE id<'$id' AND bid='$bid' ORDER BY id DESC LIMIT 0,1";

		return parent::one($sql);
	}


	//获取某章节的下一章
	public function getNext($id, $bid){
		$sql = "SELECT id FROM section WHERE id>'$id' AND bid='$bid' ORDER BY id ASC LIMIT 0,1";

		return parent::one($sql);
	}

	//获取某一个章节
	public function getOneSection($id){
		$sql = "SELECT title,vid,count,content,time FROM section WHERE id='$id'";

		return parent::one($sql);
	}


	//添加章节
	public function add($title, $vid, $content, $count, $bid, $time){
		$sql = "INSERT INTO section(title,vid,content,count,bid,time) 
					VALUES('$title','$vid','$content','$count','$bid','$time')";

		return parent::aud($sql);
	}


	//更新章节
	public function update($id, $title, $content, $count, $vid, $time){
		$sql = "UPDATE section SET title='$title',content='$content',count='$count',vid='$vid',time='$time' WHERE id='$id'";

		return parent::aud($sql);
	}


	//更新状态
	public function updateState($id, $state){
		$sql  = "UPDATE section SET state='$state' WHERE id='$id'";

		return parent::aud($sql);
	}


	//删除章节
	public function delete($id){
		$sql = "DELETE FROM section WHERE id='$id'";

		return parent::aud($sql);
	}


	//删除，根据书籍编号
	public function deleteByBid($bid){
		$sql = "DELETE FROM section WHERE bid='$bid'";

		return parent::aud($sql);
	}


}


?>
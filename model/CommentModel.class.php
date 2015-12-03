<?php

//书籍模型类
class CommentModel extends Model{

	private $limit;


	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}


	//获取所有评论数量
	public function getAllTotal($key=""){
		$sql = "SELECT COUNT(*) FROM comment WHERE content LIKE '%$key%'";

		return parent::total($sql);
	}


	//后台模糊查找时用的数量
	public function getNumberBy($key=""){
		$sql = "SELECT COUNT(*) FROM
				(SELECT c.id,c.content,r.reader,c.time 
				  FROM comment c,reader r 
				 WHERE c.rid=r.id
				 ORDER BY c.time DESC) a
				 WHERE a.content LIKE '%$key%' OR a.reader LIKE '%$key%'";

		return parent::total($sql);
	}


	//获取所有评论
	public function getAllComment($key=""){
		$sql = "SELECT * FROM
				(SELECT c.id,c.content,r.reader,c.time 
				  FROM comment c,reader r 
				 WHERE c.rid=r.id
				 ORDER BY c.time DESC) a
				 WHERE a.content LIKE '%$key%' OR a.reader LIKE '%$key%'
				 $this->limit";

		return parent::all($sql);
	}


	//获取某的数量
	public function getNumberByOid($oid, $attr){
		$sql = "SELECT COUNT(*) FROM comment WHERE oid='$oid' AND attr='$attr'";

		return parent::total($sql);
	}


	//获取某用户的论坛评论数量
	public function getNumberByRid($rid, $attr){
		$sql = "SELECT COUNT(*) FROM comment WHERE rid='$rid' AND attr='$attr'";

		return parent::total($sql);
	}


	//获取某用户的评论数量
	public function getNumberByReader($rid){
		$sql = "SELECT COUNT(*) FROM comment WHERE rid='$rid'";

		return parent::total($sql);
	}


	//获取某用户的所有评论
	public function getAllByReader($rid){
		$sql = "SELECT id,content,time,attr,oid FROM comment WHERE rid='$rid' ORDER BY time DESC $this->limit";

		return parent::all($sql);
	}

	//获取某的评论
	public function getComments($oid, $attr){
		$sql = "SELECT c.content,r.reader,r.face,c.time 
				FROM comment c,reader r 
				WHERE c.oid='$oid' AND c.attr='$attr' AND c.rid=r.id  
				ORDER BY c.time DESC";

		return parent::all($sql);
	}


	//获取帖子及其所有评论
	public function getAllByOid($oid, $attr){
		$sql = "SELECT b.id,b.content,b.time,r.reader,r.face,b.rid,b.title 
				FROM bbs b,reader r 
				WHERE b.id='$oid' AND b.rid=r.id
				UNION
				SELECT c.id,c.content,c.time,r.reader,r.face,c.rid,NULL 
				FROM comment c,reader r 
				WHERE c.oid='$oid' AND c.rid=r.id AND c.attr='$attr'
				ORDER BY time ASC
				$this->limit";

		return parent::all($sql);
	}


	//获取某的最新评论
	public function getLastByOid($oid, $attr){
		$sql = "SELECT c.time,r.reader 
		          FROM comment c,reader r
		         WHERE c.oid='$oid' AND c.rid=r.id AND c.attr='$attr' 
		         ORDER BY c.time DESC 
		         LIMIT 0,1";

        return parent::one($sql);
	}


	//添加
	public function add($content, $rid, $time, $attr, $oid){
		$sql = "INSERT INTO comment(content,rid,time,attr,oid) VALUES('$content','$rid','$time','$attr','$oid')";

		return parent::aud($sql);
	}


	//删除
	public function delete($id){
		$sql = "DELETE FROM comment WHERE id='$id'";

		return parent::aud($sql);
	}

	

	
}

?>
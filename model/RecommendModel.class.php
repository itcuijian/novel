<?php

//书籍模型类
class RecommendModel extends Model{

	private $limit;


	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}

	//获取全部推荐的数量
	public function getTotalOfAll($key=""){
		$sql = "SELECT COUNT(*) FROM recommend WHERE title LIKE '%$key%' OR attr LIKE '%$key%'";

		return parent::total($sql);
	}

	//获取全部推荐
	public function getAllRecommend($key=""){
		$sql = "SELECT id,title,attr,href 
				FROM recommend 
				WHERE title LIKE '%$key%' OR attr LIKE '%$key%' 
				ORDER BY id DESC 
				$this->limit";

		return parent::all($sql);
	}

	//添加推荐
	public function add($title, $attr, $href){
		$sql = "INSERT INTO recommend(title,attr,href) VALUES('$title','$attr','$href')";

		return parent::aud($sql);
	}

	//获取一条推荐
	public function getOneRecommend($id){
		$sql = "SELECT id,title,attr,href FROM recommend WHERE id='$id'";

		return parent::one($sql);
	}

	
	//获取第i条推荐
	public function getOneBy($i){
		$sql = "SELECT title,attr,href FROM recommend ORDER BY id DESC LIMIT $i,1";

		return parent::one($sql);
	}

	
	//获取8条数据
	public function getMoreBy($i){
		$sql = "SELECT title,attr,href FROM recommend ORDER BY id DESC LIMIT $i,8";

		return parent::all($sql);
	}


	//修改
	public function update($id, $title, $attr, $href){
		$sql = "UPDATE recommend SET title='$title',attr='$attr',href='$href' WHERE id='$id'";

		return parent::aud($sql);
	}

	//删除
	public function delete($id){
		$sql = "DELETE FROM recommend WHERE id='$id'";

		return parent::aud($sql);
	}
	
}

?>
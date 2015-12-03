<?php

//书籍模型类
class BookModel extends Model{

	private $limit;


	//拦截器(__set)
	public function __set($_key, $_value) {
		$this->$_key = Tool::mysqlString($_value);
	}
		
	//拦截器(__get)
	public function __get($_key) {
		return $this->$_key;
	}
	
	
	//获取书籍的总数量
	public function getBookTotal(){
		$sql = "SELECT COUNT(*) FROM book";
		
		return parent::total($sql);
	}


	//最新推荐(4本)
	public function getFour(){
		$sql = "SELECT surface,name,id,info FROM book WHERE `check`=1 ORDER bY id DESC LIMIT 0,4";

		return parent::all($sql);
	}


	//获取某类别书籍的数量
	public function getNumberOfKind($kid){
		$sql = "SELECT COUNT(*) FROM book WHERE kid IN ($kid)";

		return parent::total($sql);
	}


	//分类推荐第一本书
	public function getFirst($kid){
		$sql = "SELECT b.id bid,b.name bname,b.info,b.surface,a.pseudonym 
		          FROM book b,kind k,author a 
		         WHERE b.kid=k.id AND b.aid=a.id AND k.pid='$kid' AND b.check <> 0 AND CHAR_LENGTH(b.name) < 8
		         ORDER BY b.id DESC
		         LIMIT 1,1";

		return parent::one($sql);
	}


	//分类推荐第二至第六本书
	public function getNext($kid){
		$sql = "SELECT b.id bid,b.name bname,k.name kname 
		          FROM book b,kind k 
		         WHERE b.kid=k.id AND k.pid='$kid' AND b.check <> 0 AND CHAR_LENGTH(b.name) < 8
		         ORDER BY b.id DESC
		         LIMIT 2,5";

		return parent::all($sql);
	}


	//首页显示的最近更新
	public function getBookOfindex(){
		$sql = "SELECT b.name bname,b.time,b.id,k.name kname,b.count,a.pseudonym,b.aid
		          FROM book b,kind k,author a 
		          WHERE b.kid=k.id AND b.check=1 AND b.aid=a.id 
		          ORDER BY b.time DESC
		          LIMIT 0,10";

        return parent::all($sql);
	}

	//书库
	public function getBooks($kid){
		$sql = "SELECT b.name bname,b.time,b.id,k.name kname,b.count,a.pseudonym,b.aid,b.click
		          FROM book b,kind k,author a 
		          WHERE b.kid=k.id AND b.check=1 AND b.aid=a.id AND b.kid IN ($kid) 
		          ORDER BY b.time DESC
		          $this->limit";

        return parent::all($sql);
	}
	
	
	//获取所有书籍
	public function getAllBook($key=""){
		$sql = "SELECT * FROM 
				(SELECT b.id,b.name,b.state,b.check,a.pseudonym 
		        FROM book b,author a 
				WHERE b.aid=a.id
				ORDER BY b.check ASC,b.time DESC) c
				WHERE c.name LIKE '%$key%' OR c.pseudonym LIKE '%$key%'
				$this->limit";
		
		return parent::all($sql);
	}


	//后台模糊查找的数量
	public function getNumberBy($key=""){
		$sql = "SELECT COUNT(*) FROM 
				(SELECT b.id,b.name,b.state,b.check,a.pseudonym 
		        FROM book b,author a 
				WHERE b.aid=a.id
				ORDER BY b.check ASC,b.time DESC) c
				WHERE c.name LIKE '%$key%' OR c.pseudonym LIKE '%$key%'";
		
		return parent::total($sql);
	}


	//获取一本书
	public function getBook($id){
		$sql = "SELECT b.name,b.state,b.check,a.pseudonym,k.name kname,b.surface,b.info,b.count,b.click,b.keyword,b.kid 
		          FROM book b,author a,kind k 
		          WHERE b.id='$id' AND b.aid=a.id AND k.id=b.kid";

        return parent::one($sql);
	}


	//获取某一作者所有的作品数量
	public function getAllBookOfAtotal($aid){
		$sql = "SELECT COUNT(*) FROM book WHERE aid='$aid'";

		return parent::total($sql);
	}


	//检查书名是否已存在，更新使用
	public function checkExName($id, $name){
		$sql = "SELECT id FROM book WHERE name='$name' AND id!='$id'";

		return parent::one($sql);
	}


	//检查书名是否已经存在，新增时用
	public function checkName($name){
		$sql = "SELECT id FROM book WHERE name='$name'";

		return parent::one($sql);
	}


	//获取某一作品的数据
	public function getOneBook($id){
		$sql = "SELECT name,kid,keyword,state,info,surface,click,count FROM book WHERE id='$id'";

		return parent::one($sql);
	}


	//获取某一作者的书籍 
	public function getAllBookOfAuthor($aid){
		$sql = "SELECT id,name,time,count,state,click FROM book WHERE aid='$aid' ORDER BY time DESC $this->limit";

		return parent::all($sql);
	}



	//更新总字数
	public function updateCount($id, $count)
	{
		$sql = "UPDATE book SET count='$count' WHERE id='$id'";

		return parent::aud($sql);
	}



	//更新封面
	public function updateSurface($id, $surface){
		$sql = "UPDATE book SET surface='$surface' WHERE id='$id'";

		return parent::aud($sql);
	}


	//更新状态
	public function updateState($id, $state){
		$sql = "UPDATE book SET state='$state' WHERE id='$id'";

		return parent::aud($sql);
	}


	//增加点击量
	public function addClick($id){
		$sql = "UPDATE book SET click=click+1 WHERE id='$id'";

		return parent::aud($sql);
	}


	//新增
	public function add($name, $kid, $aid, $keyword, $info, $publish, $time)
	{
		$sql = "INSERT INTO book(name,kid,aid,keyword,info,publish,time) VALUES('$name','$kid','$aid','$keyword','$info','$publish','$time')";

		return parent::aud($sql);
	}


	//更新
	public function update($id, $name, $keyword, $info, $time){
		$sql = "UPDATE book SET name='$name',keyword='$keyword',info='$info',time='$time' WHERE id='$id'";

		return parent::aud($sql);
	}


	//审核
	public function updateCheck($id, $check){
		$sql = "UPDATE book SET `check`=$check WHERE id='$id'";

		return parent::aud($sql);
	}


	//删除作品
	public function delete($id){
		$sql = "DELETE FROM book WHERE id='$id'";

		return parent::aud($sql);
	}


	//点击排行榜
	public function getRankOfClick(){
		$sql = "SELECT b.name bname,b.time,b.id,k.name kname,b.click,a.pseudonym,b.aid
		          FROM book b,kind k,author a 
		          WHERE b.kid=k.id AND b.check=1 AND b.aid=a.id 
		          ORDER BY b.click DESC
		          $this->limit";

        return parent::all($sql);
	}


	//订阅排行榜
	public function getRankOfRack(){
		$sql = "SELECT b.name bname,b.time,b.id,k.name kname,b.click,a.pseudonym,b.aid
		          FROM book b,kind k,author a 
		          WHERE b.kid=k.id AND b.check=1 AND b.aid=a.id 
		          ORDER BY (SELECT COUNT(*) FROM bookrack where bid=b.id) DESC
		          $this->limit";

        return parent::all($sql);
	}


	//新书推送榜
	public function getRankOfNew(){
		$sql = "SELECT rs.bname,rs.kname,rs.click,rs.pseudonym,rs.aid,rs.id,rs.time FROM 
				(SELECT b.name bname,b.time,b.id,k.name kname,b.click,a.pseudonym,b.aid
						          FROM book b,kind k,author a 
						          WHERE b.kid=k.id AND b.check=1 AND b.aid=a.id 
						          ORDER BY b.id DESC LIMIT 0,40) rs 
				ORDER BY rs.click DESC
				$this->limit";

        return parent::all($sql);
	}


	//分类排行
	public function getRankOfKind($kid){
		$sql = "SELECT b.name bname,b.time,b.id,k.name kname,b.count,a.pseudonym,b.aid,b.click
		          FROM book b,kind k,author a 
		          WHERE b.kid=k.id AND b.check=1 AND b.aid=a.id AND b.kid IN ($kid) 
		          ORDER BY b.click DESC
		          $this->limit";

        return parent::all($sql);
	}


	//模糊查找
	public function getBookByKey($key){
		$sql = "SELECT id,name,kname,pseudonym,keyword,info,surface FROM
					(SELECT b.id,b.name,k.name kname,a.pseudonym,b.keyword,b.info,b.surface,b.time 
					FROM book b,author a,kind k 
					WHERE b.aid=a.id AND b.kid=k.id AND b.check=1) a 
				WHERE a.name LIKE '%$key%'
				OR a.kname LIKE '%$key%'
				OR a.keyword LIKE '%$key%'
				OR a.pseudonym LIKE '%$key%'
				ORDER BY a.time DESC
				$this->limit";

		return parent::all($sql);		
	}


	//模糊查找的数量
	public function getNumberByKey($key){
		$sql = "SELECT COUNT(*) FROM
					(SELECT b.id,b.name,k.name kname,a.pseudonym,b.keyword,b.info,b.surface,b.time 
					FROM book b,author a,kind k 
					WHERE b.aid=a.id AND b.kid=k.id AND b.check=1) a 
				WHERE a.name LIKE '%$key%'
				OR a.kname LIKE '%$key%'
				OR a.keyword LIKE '%$key%'
				OR a.pseudonym LIKE '%$key%'";

		return parent::total($sql);
	}


	//书名的模糊查找
	public function getBookByName($key){
		$sql = "SELECT id,name,kname,pseudonym,keyword,info,surface FROM
					(SELECT b.id,b.name,k.name kname,a.pseudonym,b.keyword,b.info,b.surface,b.time 
					FROM book b,author a,kind k 
					WHERE b.aid=a.id AND b.kid=k.id AND b.check=1) a 
				WHERE a.name LIKE '%$key%'
				ORDER BY a.time DESC
				$this->limit";

		return parent::all($sql);
	}


	//书名模糊查找的数量
	public function getNumberByName($key){
		$sql = "SELECT COUNT(*) FROM
					(SELECT b.id,b.name,k.name kname,a.pseudonym,b.keyword,b.info,b.surface,b.time 
					FROM book b,author a,kind k 
					WHERE b.aid=a.id AND b.kid=k.id AND b.check=1) a 
				WHERE a.name LIKE '%$key%'";

		return parent::total($sql);
	}


	//作者的模糊查找
	public function getBookByAuthor($key){
		$sql = "SELECT id,name,kname,pseudonym,keyword,info,surface FROM
					(SELECT b.id,b.name,k.name kname,a.pseudonym,b.keyword,b.info,b.surface,b.time 
					FROM book b,author a,kind k 
					WHERE b.aid=a.id AND b.kid=k.id AND b.check=1) a 
				WHERE a.pseudonym LIKE '%$key%'
				ORDER BY a.time DESC
				$this->limit";

		return parent::all($sql);
	}

	//作者模糊查找的数量
	public function getNumberByAuthor($key){
		$sql = "SELECT COUNT(*) FROM
					(SELECT b.id,b.name,k.name kname,a.pseudonym,b.keyword,b.info,b.surface,b.time 
					FROM book b,author a,kind k 
					WHERE b.aid=a.id AND b.kid=k.id AND b.check=1) a 
				WHERE a.pseudonym LIKE '%$key%'";

		return parent::total($sql);
	}

	//关键字的模糊查找
	public function getBookByWord($key){
		$sql = "SELECT id,name,kname,pseudonym,keyword,info,surface FROM
					(SELECT b.id,b.name,k.name kname,a.pseudonym,b.keyword,b.info,b.surface,b.time 
					FROM book b,author a,kind k 
					WHERE b.aid=a.id AND b.kid=k.id AND b.check=1) a 
				WHERE a.keyword LIKE '%$key%'
				ORDER BY a.time DESC
				$this->limit";

		return parent::all($sql);
	}

	//关键字模糊查找的数量
	public function getNumberByWord($key){
		$sql = "SELECT COUNT(*) FROM
					(SELECT b.id,b.name,k.name kname,a.pseudonym,b.keyword,b.info,b.surface,b.time 
					FROM book b,author a,kind k 
					WHERE b.aid=a.id AND b.kid=k.id AND b.check=1) a 
				WHERE a.keyword LIKE '%$key%'";

		return parent::total($sql);
	}

	//类型的模糊查找
	public function getBookByKind($key){
		$sql = "SELECT id,name,kname,pseudonym,keyword,info,surface FROM
					(SELECT b.id,b.name,k.name kname,a.pseudonym,b.keyword,b.info,b.surface,b.time 
					FROM book b,author a,kind k 
					WHERE b.aid=a.id AND b.kid=k.id AND b.check=1) a 
				WHERE a.kname LIKE '%$key%'
				ORDER BY a.time DESC
				$this->limit";

		return parent::all($sql);
	}

	//类型模糊查找的数量
	public function getNumberByKind($key){
		$sql = "SELECT COUNT(*) FROM
					(SELECT b.id,b.name,k.name kname,a.pseudonym,b.keyword,b.info,b.surface,b.time 
					FROM book b,author a,kind k 
					WHERE b.aid=a.id AND b.kid=k.id AND b.check=1) a 
				WHERE a.kname LIKE '%$key%'";

		return parent::total($sql);
	}
	
}

?>
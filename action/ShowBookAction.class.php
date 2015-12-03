<?php 
//前台书籍控制类
class ShowBookAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new BookModel());
	}

	public function action(){
		$this->show();
	}


	//显示
	private function show(){
		if(isset($_COOKIE["id"])){
			$rid = $_COOKIE["id"];
			$this->tpl->assign("aid", $rid);
		}
		else
			$this->tpl->assign("aid", null);

		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$object = $this->model->getBook($id);
			$this->tpl->assign("bname", $object->name);
			$this->tpl->assign("pseudonym", $object->pseudonym);
			$this->tpl->assign("kname", $object->kname);
			$this->tpl->assign("count", $object->count);
			$this->tpl->assign("click", $object->click);
			$this->tpl->assign("surface", $object->surface);
			$this->tpl->assign("info", html_entity_decode($object->info));
			$this->tpl->assign("id", $id);

			//关键字
			$keyword = array();
			$keyword = explode(",", $object->keyword);
			$str = "";
			for($i=0;$i<count($keyword);$i++){
				$str .= '<a href="search.php?type=keyword&key='.$keyword[$i].'">'.$keyword[$i].'</a>';
			}
			$this->tpl->assign("keyword", $str);

			//最新章节
			$section = new SectionModel();
			$object1 = $section->getLatest($id);
			$this->tpl->assign("vname", $object1->name);
			$this->tpl->assign("title", $object1->title);
			$this->tpl->assign("sid", $object1->id);
			$content = Tool::trimspecial($object1->content);
			$content = mb_substr($content, 0, 44,"utf8")."...";
			$this->tpl->assign("content", $content);

			//获取第一章
			$object2 = $section->getFirst($id);
			$this->tpl->assign("fid", $object2->id);

			//增加点击量
			$this->model->addClick($id);

			//书评
			$comment = new CommentModel();
			parent::page($comment->getNumberByOid($id, 'b'));         //分页
			$object3 = $comment->getComments($id, 'b');
			if(!empty($object3))
			foreach($object3 as $value){
				$value->time = date('Y-m-d H:i:s', $value->time);
			}
			$this->tpl->assign('AllComment', $object3);
		}
	}
	
}

?>
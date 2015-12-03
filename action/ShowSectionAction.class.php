<?php 
//前台章节控制类
class ShowSectionAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new SectionModel());
	}

	public function action(){
		$this->show();
	}


	//显示
	private function show(){
		if(isset($_COOKIE["id"])){
			$this->tpl->assign("aid", $_COOKIE["id"]);
			$this->tpl->assign("allsection", true);
		}
		else{
			$this->tpl->assign("aid", null);
		}

		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$object1 = $this->model->getDetails($id);
			$this->tpl->assign("id", $id);
			$this->tpl->assign("title", $object1->title);
			$this->tpl->assign("bname", $object1->name);
			$this->tpl->assign("pseudonym", $object1->pseudonym);
			$this->tpl->assign("time", date("Y-m-d H:i:s", $object1->time));
			$this->tpl->assign("count", $object1->count);
			$this->tpl->assign("vname", $object1->vname);
			$this->tpl->assign("bid", $object1->bid);
			$this->tpl->assign("content", html_entity_decode($object1->content));

			//上一章、下一章
			$object3 = $this->model->getBefore($id, $object1->bid);
			if(!empty($object3)){
				$this->tpl->assign("before", "section.php?id=".$object3->id);
				$this->tpl->assign("bclick", "");
			}
			else{
				$this->tpl->assign("before", "javascript:;");
				$this->tpl->assign("bclick", "aclick()");
				$this->tpl->assign("tip", "已经是第一章啦！！");
			}
			$object4 = $this->model->getNext($id, $object1->bid);
			if(!empty($object4)){
				$this->tpl->assign("next", "section.php?id=".$object4->id);
				$this->tpl->assign("nclick", "");
			}
			else{
				$this->tpl->assign("next", "javascript:;");
				$this->tpl->assign("nclick", "aclick()");
				$this->tpl->assign("tip", "已经是最后一章啦！！");
			}

			//分类
			$kind = new KindModel();
			$book = new BookModel();
			$object = $book->getBook($object1->bid);
			$this->tpl->assign("cname", $object->kname);
			$object2 = $kind->getOneKind($object->kid);
			$this->tpl->assign("kname", $object2->nname);
			$this->tpl->assign("kid", $object2->iid);

			//订阅
			if(isset($_COOKIE["id"])){
				$bookrack = new BookrackModel();
				$object5 = $bookrack->checkId($object1->bid, $_COOKIE["id"]);
				if(empty($object5))
					$this->tpl->assign("allsection", false);
				else{
					$bookrack->updateSid($id, $object1->bid, $_COOKIE["id"]);
				}
			}

			//书评
			$comment = new CommentModel();
			parent::page($comment->getNumberByOid($id, 's'));         //分页
			$object3 = $comment->getComments($id, 's');
			if(!empty($object3))
			foreach($object3 as $value){
				$value->time = date('Y-m-d H:i:s', $value->time);
			}
			$this->tpl->assign('AllComment', $object3);

		}
	}
	
}

?>
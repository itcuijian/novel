<?php
//书库流程控制类
class LibraryAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new BookModel());
	}


	public function action(){
		$this->show();
	}


	//显示
	private function show(){
		//类型
		$kind = new KindModel();
		$object1 = $kind->getFronKind();
		$this->tpl->assign("AllKind", $object1);

		if(isset($_GET["kid"]))
		{
			//获取分类
			$object = $_GET["kid"] ? $kind->getFronKChild($_GET["kid"]):$kind->getChild();
			$arr = array();
			for($i=0;$i<count($object);$i++){
				$arr[$i] = $object[$i]->id;
			}
			$kid = implode(',', $arr);


			//分页
			parent::page($this->model->getNumberOfKind($kid), 20);


			//根据分类来显示
			$object2 = $this->model->getBooks($kid);
			$section = new SectionModel();
			if(!empty($object2))
			foreach($object2 as $value){
				$object3 = $section->getLatest($value->id);
				$value->vname = $object3->name;
				$value->titlel = $object3->title;
				$value->sid = $object3->id;
				if(Validate::checkLength($object3->name.$object3->title, 25, "max"))
					$value->title = mb_substr($object3->title, 0, 10, "utf8")."...";
				else
					$value->title = $object3->title;
				

				$value->times = date("m-d H:i", $value->time);
				$value->timel = date("Y-m-d H:i:s", $value->time);

				if(Validate::checkLength($value->pseudonym, 4, "max"))
					$value->pseudonyms = mb_substr($value->pseudonym, 0, 4, "utf8")."...";
				else
					$value->pseudonyms = $value->pseudonym;

			}
			$this->tpl->assign("AllBook", $object2);

			//点击榜
			$this->rank();

		}
		
	}


	//排行榜
	private function rank(){
		$this->model->limit = "LIMIT 0,10";
		//点击榜
		$object1 = $this->model->getRankOfClick();
		$this->tpl->assign("click", $object1);
	}
}

?>
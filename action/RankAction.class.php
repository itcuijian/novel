<?php
//排行榜流程控制类
class RankAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new BookModel());
	}


	public function action(){
		$this->show();
	}


	//获取数据
	private function getObject($object){
		$section = new SectionModel();
		foreach($object as $value){
			$value->times = date("m-d H:i", $value->time);
			$value->time = date("Y-m-d H:i:s");
			$value->number = $value->click;

			$object3 = $section->getLatest($value->id);
			$value->titlel = $object3->name."：".$object3->title;
			$value->sid = $object3->id;
			if(Validate::checkLength($object3->name.$object3->title, 25, "max"))
				$value->title = mb_substr($object3->name."：".$object3->title, 0, 24, "utf8")."...";
			else
				$value->title = $object3->name."：".$object3->title;

			if(Validate::checkLength($value->pseudonym, 5, "max"))
				$value->pseudonyms = mb_substr($value->pseudonym, 0, 4, "utf8")."...";
			else
				$value->pseudonyms = $value->pseudonym;
		}

		return $object;
}


	//显示
	private function show(){
		//类型
		$kind = new KindModel();
		$object1 = $kind->getSevenKind();
		$this->tpl->assign("SevenKind", $object1);

		//排行
		if(isset($_GET["action"]))
			if($_GET["action"] == "click"){
				parent::page($this->model->getBookTotal());
				$object2 = $this->model->getRankOfClick();
				$object2 = $this->getObject($object2);
				
				
				$this->tpl->assign("head", "点击量");
				$this->tpl->assign("h3", "点击排行榜");		
			}
			elseif($_GET["action"] == "rack"){
				parent::page($this->model->getBookTotal());
				$object2 = $this->model->getRankOfRack();
				$object2 = $this->getObject($object2);

				$bookrack = new BookrackModel();
				foreach($object2 as $value){
					$value->number = $bookrack->getRacks($value->id);
				}

				$this->tpl->assign("head", "订阅量");
				$this->tpl->assign("h3", "订阅排行榜");
			}
			elseif($_GET["action"] == "new"){
				parent::page(40);
				$object2 = $this->model->getRankOfNew();
				$object2 = $this->getObject($object2);

				$this->tpl->assign("head", "点击量");
				$this->tpl->assign("h3", "新书推送榜");
			}
			elseif($_GET["action"] == "kind"){
				$kid = $_GET["kid"];

				//获取分类
				$object = $kind->getFronKChild($kid);
				$object3 = $kind->getOneKind($kid);
				$arr = array();
				for($i=0;$i<count($object);$i++){
					$arr[$i] = $object[$i]->id;
				}
				$kids = implode(',', $arr);
				parent::page($this->model->getNumberOfKind($kids));

				$object2 = $this->model->getRankOfKind($kids);
				$object2 = $this->getObject($object2);

				$this->tpl->assign("head", "点击量");
				$this->tpl->assign("h3", $object3->name."榜");
			}
			$this->tpl->assign("RankOfClick", $object2);
	}
}

?>
<?php 
//前台书籍控制类
class CatalogAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new VolumeModel());
	}

	public function action(){
		$this->show();
	}


	//显示
	private function show(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];

			//书籍
			$book = new BookModel();
			$object1 = $book->getBook($id);
			$this->tpl->assign("bname", $object1->name);
			$this->tpl->assign("pseudonym", $object1->pseudonym);
			$this->tpl->assign("cname", $object1->kname);
			$this->tpl->assign("id", $id);

			//类型
			$kind = new KindModel();
			$object3 = $kind->getOneKind($object1->kid);
			$this->tpl->assign("kname", $object3->nname);
			$this->tpl->assign("kid", $object3->iid);


			//分卷
			$volume = new VolumeModel();
			$section = new SectionModel();
			$object2 = $this->model->getVolumeOfBook($id);
			foreach($object2 as $value){
				$value->section = $section->getSectionOfVolume($value->id);
			}
			$this->tpl->assign("volume", $object2);
			
		}
	}
	
	
	
}

?>
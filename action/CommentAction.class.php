<?php

class CommentAction extends Action {

	//构造方法
	public function __construct(&$tpl){
		parent::__construct($tpl, new CommentModel());
	}


	//执行方法
	public function action(){
		switch($_GET["action"])
		{
			case "show":
				$this->show();
				break;

			case "delete":
				$this->delete();
				break;

			default:
				Tool::alertBack("非法操作！");
		}
	}


	//显示
	private function show(){
		$this->tpl->assign("show", true);
		$this->tpl->assign("titl", "列表");

		//模糊搜索
		if(isset($_GET['search'])){
			parent::page($this->model->getNumberBy($_GET['key']));
			$object = $this->model->getAllComment($_GET['key']);
		}
		else{
			parent::page($this->model->getAllTotal());
			$object = $this->model->getAllComment();
		}
		
		if(is_array($object))
		foreach($object as $value){
			$value->time = date("Y-m-d H:i:s", $value->time);
		}

		$this->tpl->assign('AllComment', $object);
	}



	//删除
	private function delete(){
		if(isset($_GET["id"])){
			if($this->model->delete($_GET["id"]))
				Tool::alertBack("删除成功！");
			else
				Tool::alertBack("删除失败！！");
		}
		else
			Tool::alertBack("没有此评论！！");
	}
}

?>
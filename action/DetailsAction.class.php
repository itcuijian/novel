<?php 
//前台论坛评论控制类
class DetailsAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new CommentModel());
	}

	public function action(){
		if(isset($_GET["action"])){
			if($_GET["action"] == "show")
				$this->show();
			elseif($_GET["action"] == "publish")
				$this->publish();
			else
				Tool::alertBack("非法操作！！");
		}

	}

	//显示
	private function show(){
		$this->tpl->assign("oid", $_GET["oid"]);

		//分页
		parent::page($this->model->getNumberByOid($_GET["oid"], "bbs") + 1);

		$object = $this->model->getAllByOid($_GET["oid"], "bbs");
		$bbs = new BbsModel();
		foreach($object as $value){
			$value->content = html_entity_decode($value->content);
			$value->time = date("Y-m-d H:i:s", $value->time);
			$value->bcount = $bbs->getNumberByRid($value->rid);
			$value->ccount = $this->model->getNumberByRid($value->rid, "bbs");
			$value->number = $this->model->getNumberByOid($_GET["oid"], "bbs");
		}
		$this->tpl->assign("AllComment", $object);
		
	}


	//发表
	public function publish(){
		if(isset($_COOKIE["id"])){
			if(isset($_POST["send"])){
				if(Validate::checkLength($_POST["content"], 1, "min"))
					Tool::alertBack("警告：内容不能为空！！");
				if(Validate::checkLength($_POST["content"], 200, "max"))
					Tool::alertBack("警告：内容不能超过200个字！！");

				$rid = $_COOKIE["id"];
				$content = $_POST["content"];
				$time = time();
				$attr = "bbs";
				$oid = $_GET["oid"];

				if($this->model->add($content, $rid, $time, $attr, $oid))
					Tool::alertLocation("发表成功！", "details.php?action=show&oid=".$oid."&page=".(ceil(($this->model->getNumberByOid($oid, "bbs") + 1) / 10)));
				else
					Tool::alertBack("发表失败！");
			}
		}
		else
			Tool::alertBack("登录之后才能发表评论！");

	}
			
	
	

	
}

?>
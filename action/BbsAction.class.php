<?php 
//前台论坛控制类
class BbsAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new BbsModel());
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
		//分页
		parent::page($this->model->getAllTotal());

		$object = $this->model->getAllbbs();
		$comment = new CommentModel();
		if(!empty($object))
		foreach($object as $value){
			$value->times = date("Y-m-d", $value->time);
			if($value->state == 1){
				$value->class = "notice";
				$value->top = "置顶";
			}
			else{
				$value->class = "normal";
				$value->top = "";
			}

			$value->count = $comment->getNumberByOid($value->id, "bbs");
			if($value->count == 0){
				$value->lastreader = $value->reader;
				$value->lasttime = date("Y-m-d H:i:s", $value->time);
			}
			else{
				$object1 = $comment->getLastByOid($value->id, "bbs");
				$value->lastreader = $object1->reader;
				$value->lasttime = date("Y-m-d H:i:s", $object1->time);
			}
		}
		
		$this->tpl->assign("AllBBs", $object);
	}


	//发表
	public function publish(){
		if(isset($_COOKIE["id"])){
			if(isset($_POST["send"])){
				if(Validate::checkLength($_POST["title"], 80, "max"))
					Tool::alertBack("警告：标题不能多于80个字！！");
				if(Validate::checkLength($_POST["title"], 1, "min"))
					Tool::alertBack("警告：标题不能为空！！");
				if(Validate::checkLength($_POST["content"], 1, "min"))
					Tool::alertBack("警告：内容不能为空！！");

				$rid = $_COOKIE["id"];
				$title = $_POST["title"];
				$content = $_POST["content"];
				$time = time();

				if($this->model->add($rid, $title, $content, $time))
					Tool::alertLocation("发表成功！", "bbs.php?action=show");
				else
					Tool::alertBack("发表失败！");
			}
		}
		else
			Tool::alertBack("登录之后才能发表！");

	}
			
	
	

	
}

?>
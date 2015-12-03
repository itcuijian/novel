<?php

class MbbsAction extends Action {

	//构造方法
	public function __construct(&$tpl){
		parent::__construct($tpl, new BbsModel());
	}


	//执行方法
	public function action(){
		if(isset($_GET["action"]))
		switch($_GET["action"])
		{
			case "show":
				$this->show();
				break;

			case "delete":
				$this->delete();
				break;

			case "detail":
				$this->detail();
				break;

			case "notice":
				$this->notice();

			case "add":
				$this->add();
				break;

			case "update":
				$this->update();
				break;

			default:
				Tool::alertBack("非法操作！");
		}
	}


	//显示
	private function show(){
		$this->tpl->assign("show", true);
		$this->tpl->assign("btitle", '主题帖子管理');
		$this->tpl->assign("titl", "列表");

		//模糊搜索
		if(isset($_GET['search'])){
			parent::page($this->model->getNumberBy($_GET['key']));
			$object = $this->model->getAllEceptNotice($_GET['key']);
		}
		else{
			parent::page($this->model->getTotalExceptNotice());
			$object = $this->model->getAllEceptNotice();
		}
		
		if(is_array($object)){
			foreach($object as $value){
				if($value->state == 0){
					$value->state = '<span style="color:green">普通</span>';
				}
				elseif($value->state == 1){
					$value->state = '<span style="color:#666">置顶</span>';
				}
			}
		}
		
		$this->tpl->assign("Allbbs", $object);	
	}


	//显示公告
	private function notice(){
		$this->tpl->assign("notice", true);
		$this->tpl->assign("btitle", '公告管理');
		$this->tpl->assign("titl", "列表");

		//模糊搜索
		if(isset($_POST['search'])){
			parent::page($this->model->getNumberByRid(6, $_POST['key']));
			$object = $this->model->getAllByRid(6, $_POST['key']);
		}
		else{
			parent::page($this->model->getNumberByRid(6));
			$object = $this->model->getAllByRid(6);
		}
		
		if(is_array($object)){
			foreach($object as $value){
				$value->time  = date("Y-m-d H:i:s", $value->time);
			}
		}

		$this->tpl->assign("AllNotice", $object);
	}


	//详情
	private function detail(){
		$this->tpl->assign("detail", true);
		$this->tpl->assign("titl", "详情");
		if(isset($_GET["id"]))
		{
			$object = $this->model->getBBs($_GET["id"]);
			if(is_object($object)){
				if($object->state == 0){
					$state = "普通";
					$send = "置顶";
				}
				elseif($object->state == 1){
					$state = "置顶";
					$send = "取消置顶";
				}
					

				$this->tpl->assign("send", $send);
				$this->tpl->assign("id", $_GET["id"]);
				$this->tpl->assign("reader", $object->reader);
				$this->tpl->assign("title", $object->title);
				$this->tpl->assign("state", $state);
				$this->tpl->assign("time", date("Y-m-d H:i:s", $object->time));
				$this->tpl->assign("content", html_entity_decode($object->content));
				$this->tpl->assign("prev", PREV_URL);


				//置顶
				if(isset($_POST["send"])){
					if($object->state == 0)
					{
						if($this->model->updateState($_GET["id"], 1))
							Tool::alertLocation("置顶成功！！", $_POST["prev"]);
						else
							Tool::alertBack("置顶失败！");
					}
					else{
						if($this->model->updateState($_GET["id"], 0))
							Tool::alertLocation("取消置顶成功！！", $_POST["prev"]);
						else
							Tool::alertBack("取消置顶失败！");
					}
				}
			}
			else
				Tool::alertBack("此帖子不存在！");		
		}
		else
			Tool::alertBack("非法操作！");
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
			Tool::alertBack("没有此主题！！");
	}


	//发表公告
	private function add(){
		//发表
		if(isset($_POST['send'])){
			if(Validate::checkLength($_POST["ntitle"], 80, "max"))
				Tool::alertBack("警告：标题不能多于80个字！！");
			if(Validate::checkLength($_POST["ntitle"], 1, "min"))
				Tool::alertBack("警告：标题不能为空！！");
			if(Validate::checkLength($_POST["ncontent"], 1, "min"))
				Tool::alertBack("警告：内容不能为空！！");

			$rid = 6;
			$title = $_POST['ntitle'];
			$content = $_POST['ncontent'];
			$time = time();
			$state = 1;

			if($this->model->notice($rid, $title, $content, $time, $state))
				Tool::alertLocation("发表成功！", "notice.php?action=notice");
			else
				Tool::alertBack("发表失败！");
		}
	}


	//修改公告
	private function update(){
		//修改
		if(isset($_POST['send'])){
			if(Validate::checkLength($_POST["ntitle"], 80, "max"))
				Tool::alertBack("警告：标题不能多于80个字！！");
			if(Validate::checkLength($_POST["ntitle"], 1, "min"))
				Tool::alertBack("警告：标题不能为空！！");
			if(Validate::checkLength($_POST["ncontent"], 1, "min"))
				Tool::alertBack("警告：内容不能为空！！");

			$id = $_POST['id'];
			$title = $_POST['ntitle'];
			$content = $_POST['ncontent'];

			if($this->model->updateNotice($id, $title, $content))
				Tool::alertBack("修改成功！");
			else
				Tool::alertBack("修改失败！");
		}
	}
}

?>
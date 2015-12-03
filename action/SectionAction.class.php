<?php 
//书籍控制类
class SectionAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new SectionModel());
	}

	public function action(){
		if($_GET["action"])
			switch($_GET["action"]){
				case 'show':
					$this->show();
					break;
					
				case "detail":
					$this->detail();
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
		if(isset($_GET['bid'])){
			parent::page($this->model->getAllSectionTotal($_GET['bid']));
			$object = $this->model->getAllSection($_GET['bid']);
		}
		else{
			//模糊搜索
			if(isset($_GET['search'])){
				parent::page($this->model->getNumberBy($_GET['key']));
				$object = $this->model->getSection($_GET['key']);
			}
			else{
				parent::page($this->model->getAllTotal());
				$object = $this->model->getSection();
			}
		}

		if(is_array($object))
		foreach($object as $value){
			if($value->state == 0)
				$value->state = '<span style="color:red">未审核</span>';
			elseif($value->state == 1)
				$value->state ='<span style="color:green">已审核</span>';
			$value->time = date("Y-m-d H:i:s", $value->time);
		}

		$this->tpl->assign("AllSection", $object);
	}
	
	
	//小说详情
	private function detail(){
		$this->tpl->assign("titl", "详情");
		$this->tpl->assign("detail", true);
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$this->tpl->assign("id", $id);
			$section = $this->model->getDetails($id);

			$this->tpl->assign("title", $section->title);
			$this->tpl->assign("name", $section->name);
			$this->tpl->assign("pseudonym", $section->pseudonym);
			$this->tpl->assign("vname", $section->vname);
			$this->tpl->assign("count", $section->count);
			$this->tpl->assign("bid", $section->bid);
			$this->tpl->assign("time", date("Y-m-d H:i:s", $section->time));
			$this->tpl->assign("content", html_entity_decode($section->content));
			$this->tpl->assign("prev", PREV_URL);

			//按钮的value
			if($section->state == 0)
				$send = "通过审核";
			elseif($section->state == 1)
				$send = "取消审核";
			$this->tpl->assign("send", $send);


			//审核
			if(isset($_POST["send"])){
				if($section->state == 0){
					if($this->model->updateState($id, 1))
						Tool::alertLocation("审核成功！", $_POST["prev"]);
					else
						Tool::alertBack("审核失败！！");
				}
				elseif($section->state == 1){
					if($this->model->updateState($id, 0))
						Tool::alertLocation("取消审核成功！", $_POST["prev"]);
					else
						Tool::alertBack("取消审核失败！！");
				}
			}
		
		}
		else
			Tool::alertBack("没有此章节");
	}



	//删除作品
	private function delete(){
		if(isset($_GET['id'])){
			if($this->model->delete($_GET["id"]))
				Tool::alertBack("删除成功！！");
			else
				Tool::alertBack("删除失败！");
		}
		
	}
}

?>
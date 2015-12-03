<?php 
//书籍控制类
class BookAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new BookModel());
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
		$this->tpl->assign("titl", "列表");
		$this->tpl->assign("show", true);
		
		//模糊搜索
		if(isset($_GET['search'])){
			parent::page($this->model->getNumberBy($_GET['key']));
			$object = $this->model->getAllBook($_GET['key']);
		}
		else{
			parent::page($this->model->getBookTotal());
			$object = $this->model->getAllBook();
		}

		if(is_array($object)){
			foreach($object as $value){
				if($value->check == 0){
					$value->check = '<span style="color:red">未审核</span>';
				}
				elseif($value->check == 1){
					$value->check = '<span style="color:green">已审核</span>';
				}
			}
		}
		
		$this->tpl->assign("AllBook", $object);	
	}
	
	
	//小说详情
	private function detail(){
		$this->tpl->assign("detail", true);
		$this->tpl->assign("titl", "详情");
		if(isset($_GET["id"]))
		{
			$object = $this->model->getBook($_GET["id"]);
			if(is_object($object)){
				$object->check ? $send = "取消审核":$send = "通过审核";
				$object->state=="下架" ? $sends = "上架":$sends = "下架";
				// $this->tpl->assign("check", $check);
				$this->tpl->assign("send", $send);
				$this->tpl->assign("sends", $sends);
				$this->tpl->assign("id", $_GET["id"]);
				$this->tpl->assign("name", $object->name);
				$this->tpl->assign("kname", $object->kname);
				$this->tpl->assign("pseudonym", $object->pseudonym);
				$this->tpl->assign("count", $object->count);
				$this->tpl->assign("surface", $object->surface);
				$this->tpl->assign("state", $object->state);
				$this->tpl->assign("info", Tool::trimspecial($object->info));
				$this->tpl->assign("prev", PREV_URL);

				//审核
				if(isset($_POST["send"])){
					if($object->check == 0)
					{
						if($this->model->updateCheck($_GET["id"], 1))
							Tool::alertLocation("审核成功！！", "book.php?action=show");
						else
							Tool::alertBack("审核失败！");
					}
					elseif($object->check == 1){
						if($this->model->updateCheck($_GET["id"], 0))
							Tool::alertLocation("取消审核成功！！", "book.php?action=show");
						else
							Tool::alertBack("取消审核失败！");
				}
					}

				//下架
				if(isset($_POST["sends"])){
				 	if($object->state != "下架"){
				 		if($this->model->updateState($_GET["id"], "下架"))
				 			Tool::alertLocation("下架成功！！", "book.php?action=show");
				 		else
				 			Tool::alertBack("下架失败！！");
				 	}
				 	else{
				 		if($this->model->updateState($_GET["id"], "上架"))
				 			Tool::alertLocation("上架成功！！", "book.php?action=show");
				 		else
				 			Tool::alertBack("上架失败！！");
				 	}
				}				
				}
				else
					Tool::alertBack("此小说不存在！");
				
		}
		else
			Tool::alertBack("非法操作！");
	}


	//删除作品
	private function delete(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$valume = new VolumeModel();
			$section = new SectionModel();
			if($this->model->delete($id) || $valume->deleteByBid($id) || $section->deleteByBid($id))
				Tool::alertBack("删除成功！");
			else
				Tool::alertBack("删除失败！");
		}
	}
}

?>
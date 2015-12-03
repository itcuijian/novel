<?php 
//推荐控制类
class RecommendAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new RecommendModel());
	}

	public function action(){

		$this->show();

		if(isset($_GET["action"]))
			switch($_GET["action"]){	
				case "update":
					$this->update();
					break;

				case "delete":
					$this->delete();
					break;
					
				case "add":
					$this->add();
					break;

				default:
					Tool::alertBack("非法操作！");
			}
	}


	//显示
	private function show(){
		//模糊搜索
		if(isset($_GET['search'])){
			parent::page($this->model->getTotalOfAll($_GET['key']));
			$object = $this->model->getAllRecommend($_GET['key']);
		}
		else{
			parent::page($this->model->getTotalOfAll());
			$object = $this->model->getAllRecommend();
		}
		
		$this->tpl->assign('AllRecommend', $object);
	}


	//添加
	private function add(){
		if(isset($_POST['send'])){
			//检验
			if(Validate::checkLength($_POST["rtitle"], 12, "max"))
				Tool::alertBack("警告：标题不能多于12个字！！");
			if(Validate::checkLength($_POST["rtitle"], 1, "min"))
				Tool::alertBack("警告：标题不能为空！！");
			if(Validate::checkLength($_POST["hrf"], 1, "min"))
				Tool::alertBack("警告：链接不能为空！！");
			if(Validate::checkLength($_POST["attr"], 1, "min"))
				Tool::alertBack("警告：链接不能为空！！");
			if(Validate::checkLength($_POST["attr"], 2, "equal"))
				Tool::alertBack("警告：属性只能2个字！！");

			$title = $_POST['rtitle'];
			$attr = $_POST['attr'];
			$href = $_POST['hrf'];

			if($this->model->add($title, $attr, $href))
				Tool::alertLocation("添加成功！", "recommend.php?");
			else
				Tool::alertBack("添加失败！");
		}
	}


	//更新
	private function update(){
		if(isset($_POST['send'])){
			//检验
			if(Validate::checkLength($_POST["rtitle"], 12, "max"))
				Tool::alertBack("警告：标题不能多于12个字！！");
			if(Validate::checkLength($_POST["rtitle"], 1, "min"))
				Tool::alertBack("警告：标题不能为空！！");
			if(Validate::checkLength($_POST["hrf"], 1, "min"))
				Tool::alertBack("警告：链接不能为空！！");
			if(Validate::checkLength($_POST["attr"], 1, "min"))
				Tool::alertBack("警告：链接不能为空！！");
			if(Validate::checkLength($_POST["attr"], 2, "equal"))
				Tool::alertBack("警告：属性只能2个字！！");

			$id = $_POST['id'];
			$title = $_POST['rtitle'];
			$attr = $_POST['attr'];
			$href = $_POST['hrf'];

			if($this->model->update($id, $title, $attr, $href))
				Tool::alertBack("修改成功！");
			else
				Tool::alertBack("修改失败！");
		}
	}

	
	//删除作品
	private function delete(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			if($this->model->delete($id))
				Tool::alertBack("删除成功！");
			else
				Tool::alertBack("删除失败！");
		}
	}
}

?>
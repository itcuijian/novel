<?php

class ManageAction extends Action {

	//构造方法
	public function __construct(&$tpl){
		parent::__construct($tpl, new ManageModel());
	}


	//执行方法
	public function action(){
		$this->show();
		
		
		if(isset($_GET["action"]))
		switch($_GET["action"])
		{
			case "update":
				$this->update();
				break;

			case "add":
				$this->add();
				break;

			case "delete":
				$this->delete();
				break;
		}
	}


	//显示
	private function show(){
		//模糊搜索
		if(isset($_GET['search'])){
			parent::page($this->model->getNumberBy($_GET['key']));
			$object = $this->model->getAllManage($_GET['key']);
		}
		else{
			parent::page($this->model->getManageTotal());
			$object = $this->model->getAllManage();
		}

		$this->tpl->assign("AllManage", $object);
		$this->tpl->assign("AllLevel", $this->model->getAllLevel());
	}


	//新增
	private function add(){
		$this->show();

		if(isset($_POST["send"])){
			//验证
			if(Validate::checkNull($_POST["user"]))
				Tool::alertBack("警告：用户名不能为空！");
			if(Validate::checkLength($_POST["user"], 2, "min"))
				Tool::alertBack("警告：用户名不能少于两位！");
			if(Validate::checkLength($_POST["user"], 11, "max"))
				Tool::alertBack("警告：用户名不能多于11位！");
			if(Validate::checkLength($_POST["pass"], 6, "min"))
				Tool::alertBack("警告：密码不能少于6位！");
			if(Validate::checkEquals($_POST["pass"], $_POST["notpass"]))
				Tool::alertBack("两次输入的密码不一致！");

			$user = $_POST["user"];
			$pass = sha1($_POST["pass"]);
			$level = $_POST["level"];

			if($this->model->add($user, $pass, $level))
				Tool::alertLocation("提交成功！", "manage.php?action=show");
			else
				Tool::alertBack("提交失败！");
		}	
	}


	//修改
	public function update(){
		
		//修改数据
		if(isset($_POST["send"])){
			//验证
			if(Validate::checkNull($_POST["user"]))
				Tool::alertBack("警告：用户名不能为空！");
			if(Validate::checkLength($_POST["user"], 2, "min"))
				Tool::alertBack("警告：用户名不能少于两位！");
			if(Validate::checkLength($_POST["user"], 11, "max"))
				Tool::alertBack("警告：用户名不能多于11位！");

			if(Validate::checkNull($_POST["pass"]))
				$pass = $_POST["npass"];
			elseif(Validate::checkLength($_POST["pass"], 6, "min"))
				Tool::alertBack("警告：密码不能少于6位！");
			else
				$pass = sha1($_POST["pass"]);

			$id = $_POST["id"];
			$user = $_POST["user"];
			$level = $_POST["level"];
			if($this->model->update($id, $user, $pass, $level))
				Tool::alertBack("修改成功！");
			else
				Tool::alertBack("修改失败！");

		}
		
	}


	//删除
	private function delete(){
		if(isset($_GET["id"]))
		{
			$id = $_GET["id"];

			if($this->model->delete($id))
				Tool::alertLocation("删除成功！", PREV_URL);
			else
				Tool::alertBack("删除失败！");
		}
	}
}

?>
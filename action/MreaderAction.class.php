<?php

//读者用户管理控制类
class MreaderAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new ReaderModel());
	}


	public function action(){
		$this->show();
		if(isset($_GET['action']))
		switch($_GET["action"])
		{
			case "add":
				$this->add();
				break;

			case "update":
				$this->update();
				break;

			case "delete":
				$this->delete();
				break;

			case "state":
				$this->state();
				break;
		}
	}


	//显示
	public function show(){
		//模糊搜索
		if(isset($_GET['search'])){
			parent::page($this->model->getReaderToatal($_GET['key']));
			$object = $this->model->getAllReader($_GET['key']);
		}
		else{
			parent::page($this->model->getReaderToatal());
			$object = $this->model->getAllReader();
		}

		if(is_array($object))
		foreach($object as $value)
		{
			if($value->state == 0)
				$value->states = "禁止评论";
			else
				$value->states = "允许评论";
		}
		$this->tpl->assign("AllReader", $object);

	}

	//新郑
	public function add(){
		if(isset($_POST["send"])){
			//验证
			if(Validate::checkEmail($_POST["email"]))
				Tool::alertBack("警告：邮箱输入不合法！");
			if(Validate::checkNull($_POST["reader"]))
				Tool::alertBack("警告：昵称不能为空！");
			if(Validate::checkLength($_POST["reader"], 2, "min"))
				Tool::alertBack("警告：昵称不能少于两位！");
			if(Validate::checkLength($_POST["reader"], 11, "max"))
				Tool::alertBack("警告：昵称不能多于11位！");
			if(Validate::checkLength($_POST["pass"], 6, "min"))
				Tool::alertBack("警告：密码不能少于6位！");
			if(Validate::checkEquals($_POST["pass"], $_POST["notpass"]))
				Tool::alertBack("两次输入的密码不一致！");

			$email = $_POST["email"];
			$reader = $_POST["reader"];
			$pass = sha1($_POST["pass"]);
			$time = time();

			if($this->model->add($email, $reader, $pass, $time))
				Tool::alertLocation("提交成功！", "admin_reader.php");
			else
				Tool::alertBack("提交失败！");
		}
	}


	//修改
	private function update(){

		if(isset($_POST["send"])){
			if(Validate::checkNull($_POST["pass"]))
				$pass = $_POST["npass"];
			elseif(Validate::checkLength($_POST["pass"], 6, "min"))
				Tool::alertBack("警告：密码不能少于6位！");
			else
				$pass = sha1($_POST["pass"]);

			$id = $_POST["id"];
			$reader = $_POST["reader"];
			$state = $_POST["state"];

			if($this->model->update($id, $reader, $pass, $state)){
				Tool::alertBack("修改成功！");
			}
			else
				Tool::alertBack("修改失败！");
		}
		
	}

	//删除
	private function delete(){
		if(isset($_GET["id"]))
		{
			if($this->model->delete($_GET["id"]))
				Tool::alertBack("删除成功！");
			else
				Tool::alertBack("删除失败！");
		}
		else
			Tool::alertBack("此读者不存咋！！");
	}


	//修改状态
	private function state(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$state = $_GET["state"];
			$state = abs($state - 1);

			$this->model->changeState($id, $state) ? Tool::alertLocation(null, PREV_URL):Tool::alertBack("取消失败！");
		}
	}
}

?>
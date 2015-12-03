<?php

//读者用户管理控制类
class MauthorAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new AuthorModel());
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
		}
	}


	//显示
	public function show(){
		//模糊搜索
		if(isset($_GET['search'])){
			parent::page($this->model->getAuthorTotal($_GET['key']));
			$object = $this->model->getAllAuthor($_GET['key']);
		}
		else{
			parent::page($this->model->getAuthorTotal());
			$object = $this->model->getAllAuthor();
		}
		
		$this->tpl->assign("AllAuthor", $object);
	}

	//新郑
	public function add(){

		if(isset($_POST["send"])){
			//验证
			if(Validate::checkEmail($_POST["email"]))
				Tool::alertBack("警告：邮箱输入不合法！");
			if(Validate::checkLength($_POST["aname"], 2, "min"))
				Tool::alertBack("警告：请输入正确的姓名！");
			if(Validate::checkNull($_POST["pseudonym"]))
				Tool::alertBack("警告：笔名不能为空！");
			if(Validate::checkLength($_POST["pseudonym"], 2, "min"))
				Tool::alertBack("警告：笔名不能少于两位！");
			if(Validate::checkLength($_POST["pseudonym"], 11, "max"))
				Tool::alertBack("警告：笔名不能多于11位！");
			if(Validate::checkLength($_POST["pass"], 6, "min"))
				Tool::alertBack("警告：密码不能少于6位！");
			if(Validate::checkEquals($_POST["pass"], $_POST["notpass"]))
				Tool::alertBack("两次输入的密码不一致！");

			$email = $_POST["email"];
			$name = $_POST["aname"];
			$pseudonym = $_POST["pseudonym"];
			$pass = sha1($_POST["pass"]);

			if($this->model->add($email, $name, $pass, $pseudonym))
				Tool::alertLocation("提交成功！", "admin_author.php?action=show");
			else
				Tool::alertBack("提交失败！");
		}
	}


	//修改
	private function update(){
		
		if(isset($_POST["send"])){
			//验证
			if(Validate::checkLength($_POST["aname"], 2, "min"))
				Tool::alertBack("警告：请输入正确的姓名！");
			if(Validate::checkNull($_POST["pseudonym"]))
				Tool::alertBack("警告：笔名不能为空！");
			if(Validate::checkLength($_POST["pseudonym"], 2, "min"))
				Tool::alertBack("警告：笔名不能少于两位！");
			if(Validate::checkLength($_POST["pseudonym"], 11, "max"))
				Tool::alertBack("警告：笔名不能多于11位！");

			if(Validate::checkNull($_POST["pass"]))
				$pass = $_POST["npass"];
			elseif(Validate::checkLength($_POST["pass"], 6, "min"))
				Tool::alertBack("警告：密码不能少于6位！");
			else
				$pass = sha1($_POST["pass"]);

			$id = $_POST['id'];
			$name = $_POST["aname"];
			$pseudonym = $_POST["pseudonym"];

			if($this->model->update($id, $name, $pseudonym, $pass)){
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
			Tool::alertBack("此读者不存在！！");
	}
}

?>
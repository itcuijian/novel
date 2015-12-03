<?php

//注册类
class RegisterAction extends Action{

	public function __construct(&$tpl){
		parent::__construct($tpl);
	}


	public function action(){
		if(isset($_GET["type"]))
			switch($_GET["type"]){
				case "reader":
					$this->ReaderRegister();
					break;

				case "author":
					$this->author();
					break;
			}
		else
			Tool::alertBack("警告：非法操作！");
	}


	//读者用户注册
	private function ReaderRegister(){
		parent::__construct($this->tpl, new ReaderModel());

		if(isset($_POST["send"])){
			//验证
			if(Validate::checkEmail($_POST["email"]))
				Tool::alertBack("警告：邮箱不合法！");
			if(Validate::checkLength($_POST["reader"], 2, "min"))
				Tool::alertBack("警告：昵称不能少于两位！");
			if(Validate::checkLength($_POST["reader"], 11, "max"))
				Tool::alertBack("警告：昵称不能多于11位！");
			if(Validate::checkLength($_POST["pass"], 6, "min"))
				Tool::alertBack("警告：密码不能少于6位！");
			if(Validate::checkEquals($_POST["pass"], $_POST["notpass"]))
				Tool::alertBack("警告：两次输入的密码不一致！");
			if(Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code']))
				Tool::alertBack("警告：验证码输入不正确！");

			$email = $_POST["email"];
			$reader = $_POST["reader"];
			$pass = sha1($_POST["pass"]);
			$time = time();

			if($this->model->checkEmail($email))
				Tool::alertBack("警告：邮箱已被注册！");
			if($this->model->checkReader($reader))
				Tool::alertBack("警告：昵称已被注册，请另起一个！");

			if($this->model->add($email, $reader, $pass, $time))
			{
				$reader = $this->model->checkLogin($email, $pass);

				$cookie = new Cookie("id", $reader->id);
				$cookie->setCookie();

				Tool::alertLocation("注册成功！","./");
			}
			else
				Tool::alertBack("注册失败！");

			
		}
	}


	//作者用户操作
	private function author(){
		if(isset($_GET["action"]))
			switch($_GET["action"]){
				case "register":
					$this->AuthorRegister();
					break;

				case "login":
					$this->AuthorLogin();
					break;

				default:
					Tool::alertBack("警告：非法操作！");
			}
		else
			Tool::alertBack("警告：非法操作！");
	}

	//作者用户注册
	private function AuthorRegister(){
		parent::__construct($this->tpl, new AuthorModel());

		$this->tpl->assign("rclass", "active");
		$this->tpl->assign("lclass", "");
		$this->tpl->assign("register", true);

		if(isset($_POST["send"])){
			//验证
			if(Validate::checkEmail($_POST["email"]))
				Tool::alertBack("警告：邮箱不合法！");
			if(Validate::checkLength($_POST["name"], 2, "min"))
				Tool::alertBack("警告：请输入正确的姓名！");
			if(Validate::checkLength($_POST["pass"], 6, "min"))
				Tool::alertBack("警告：密码不能少于6位！");
			if(Validate::checkEquals($_POST["pass"], $_POST["notpass"]))
				Tool::alertBack("警告：两次输入的密码不一致！");
			if(Validate::checkLength($_POST["pseudonym"], 2, "min"))
				Tool::alertBack("警告：笔名不能少于两位！");
			if(Validate::checkLength($_POST["pseudonym"], 11, "max"))
				Tool::alertBack("警告：笔名不能多于11位！");
			if(Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code']))
				Tool::alertBack("警告：验证码输入不正确！");

			$email = $_POST["email"];
			$name = $_POST["name"];
			$pass = sha1($_POST["pass"]);
			$pseudonym = $_POST["pseudonym"];

			if($this->model->checkEmail($email))
				Tool::alertBack("该邮箱已被注册！！");
			if($this->model->checkPseudonym($pseudonym))
				Tool::alertBack("该笔名已被注册，请另起一个！");

			if($this->model->add($email, $name, $pass, $pseudonym)){
				$author = $this->model->login($email, $pass);

				$_SESSION["author"]["id"] = $author->id;
				$_SESSION["author"]["pseudonym"] = $author->pseudonym;
				Tool::alertLocation("注册成功！", "author.php?action=add");
			}
			else
				Tool::alertBack("注册失败！");
		}
	}


	//作者用户登录
	private function AuthorLogin(){
		parent::__construct($this->tpl, new AuthorModel());

		$this->tpl->assign("lclass", "active");
		$this->tpl->assign("rclass", "");
		$this->tpl->assign("logins", true);

		if(isset($_POST["send"])){
			//验证
			if(Validate::checkEmail($_POST["email"]))
				Tool::alertBack("警告：邮箱不合法！");
			if(Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code']))
				Tool::alertBack("警告：验证码输入不正确！");

			$email = $_POST["email"];
			$pass = sha1($_POST["pass"]);

			if($this->model->login($email, $pass)){
				$author = $this->model->login($email, $pass);

				$_SESSION["author"]["id"] = $author->id;
				$_SESSION["author"]["pseudonym"] = $author->pseudonym;

				$book = new BookModel();
				if($book->getAllBookOfAuthor($author->id))
					Tool::alertLocation(null, "author.php?action=manage");
				else
					Tool::alertLocation(null, "author.php?action=add");

			}
			else
				Tool::alertBack("账号或密码错误！！");
		}
	}
}

?>
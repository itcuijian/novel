<?php

class LoginAction extends Action
{
	public function __construct(&$tpl)
	{		
		parent::__construct($tpl, new ManageModel());
	}

	public function _action()
	{
		if(isset($_GET['action']))
		switch ($_GET['action'])
		{
			case 'login':
				$this->login();
				break;
				
			case 'logout':
				$this->logout();
				break;
		}
	}
	
	//登出
	private function logout()
	{
		Tool::unSession();
		Tool::alertLocation(null,"admin_login.php");
	}


	//验证登陆
	private function login()
	{
		if (isset($_POST['send']))
		{
			//判断输入的数据是否合法
			if (Validate::checkNull($_POST['admin_user']))
			  Tool::alertBack("警告：账号不能为空！！");
			  
			if (Validate::checkLength($_POST['admin_user'],2,"min"))
			  Tool::alertBack("警告：账号不能少于两位！！");
			  
			if (Validate::checkLength($_POST['admin_user'],20,"max"))
			  Tool::alertBack("警告：账号不能多于20位！！");

		    if (Validate::checkNull($_POST['admin_pass']))
			  Tool::alertBack("警告：密码不能为空！！");
			  
			if (Validate::checkLength($_POST['admin_pass'],6,"min"))
			  Tool::alertBack("警告：密码不能少于6位！！");

			if (Validate::checkLength($_POST['code'],4,'equal'))
				Tool::alertBack("验证码必须是四位！！");

			if (Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code']))
				Tool::alertBack("验证码输入不正确！！");

			$user = $_POST['admin_user'];
			$pass = sha1($_POST['admin_pass']);

			$login = $this->model->getLoginManage($user, $pass);

			if($login)
			{
                $_SESSION['admin']['admin_user'] = $login->user;
                $_SESSION['admin']['admin_lname'] = $login->name;
                Tool::alertLocation(null,'admin.php');
			}
			else
               Tool::alertBack("警告：账号或密码输入错误！！");

		}
	}


	}

?>
<?php

//验证类
class Validate{
	//是否为空的方法
	static public function checkNull($date)
	{
		if (trim($date) == "")
		return TRUE;
		return FALSE;
	}
	
	
	//长度是否合法的方法
	static public function checkLength($date,$length,$flag)
	{
		if ($flag == "min")
		{
			if (mb_strlen(trim($date),"utf-8") < $length)
		    return TRUE;
		    return FALSE;
		}
		elseif ($flag == "max")
		{
			if (mb_strlen(trim($date),"utf-8") > $length)
		    return TRUE;
		    return FALSE;
		}
		elseif ($flag == "equal") 
		{
			if (mb_strlen(trim($date),"utf-8") != $length)
		    return TRUE;
		    return FALSE;
		}
		else
			{
				Tool::alertBack("参数传递有误，必须是min或者max！！");
			}
		
	}

   	//数据是否为数字
   static public function checkNum($date)
   {
   		if(!is_numeric($date))
   			return true;
   		return false;
   }
	
	
	//数据是否一致的方法
	static public function checkEquals($date ,$other)
	{
		if (trim($date != $other))
		return TRUE;
		return false;
	}

	//验证session
	static public function checkSession()
	{
		if(!isset($_SESSION['admin']))
			Tool::alertLocation('非法登录!', 'admin_login.php');
	}


	//验证电子邮箱
	static public function checkEmail($data)
	{
		$str = '/^[\w\-\.]+@[\w\-\.]+[\.\w+]+$/';
		if(!preg_match($str, $data))
			return true;
		return false;
	}
}

?>
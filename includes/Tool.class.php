<?php

class Tool{

	//弹出返回
	static public function alertBack($str)
	{
		echo "<script type='text/javascript'>alert('$str');history.back();</script>";
		exit();
	}

	//去掉特殊字符
	static public function trimspecial($data){
		$data = html_entity_decode($data);
		$data = strip_tags($data);
		$data = preg_replace("/&ldquo;/", "“", $data);
		$data = preg_replace("/&rdquo;/", "”", $data);
		$data = preg_replace("/&hellip;/", "...", $data);
		$data = preg_replace("/&lsquo;/", "‘", $data);
		$data = preg_replace("/&rsquo;/", "’", $data);
		$data = preg_replace("/　　/", "", $data);
		$data = preg_replace("/　/", "", $data);
		$data = preg_replace("/&nbsp;/", "", $data);
		$data = preg_replace("/&mdash;/", "—", $data);

		return $data;
	}


	//弹窗跳转
	static public function alertLocation($_info, $_url) {
		if (!empty($_info)) {
			echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
			exit();
		} else {
			header('Location:'.$_url);
			exit();
		}
	}


	//关闭页面
	static public function closing($info){
		echo "<script type='text/javascript'>alert('$info');window.open('','_self');window.opener=null;window.close();</script>";
	}


	//数据库输入过滤
	static public function mysqlString($_date) {
		$mysqli = DB::getDB();
		return !GPC ? mysqli_real_escape_string($mysqli,$_date) : $_date;
	}


	 //显示html过滤
	   static public function htmlString($date)
	   {
		  	if(is_array($date))
		  		foreach ($date as $key => $value)
		  		{
		  			$string[$key] = TooL::htmlString($value);
		  		}

		  		elseif (is_object($date)) 
		  			foreach ($date as $key => $value)
		  			{
		  				@$string->$key = TooL::htmlString($value);
		  			}
		  		else
		  			$string = htmlspecialchars($date);
	  		
	  			return $string;		  	
	   }


	   //清理session
	   static public function unSession()
	   {
	   		if(session_start())
	   			session_destroy();
	   }
}

?>
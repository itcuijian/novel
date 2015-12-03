<?php
require substr(dirname(__FILE__), 0, -5)."/init.inc.php";

if(is_array($_GET))
{
	if(isset($_GET["action"])){
		$bookrack = new BookrackModel();
		if($_GET["action"] == "delete"){
			if(!empty($bookrack->delete($_GET["bid"], $_GET["rid"])))
				echo "移出成功！";
			else
				echo "移出失败！";
		}			
	}
	else{
		if($_GET["aid"] == null)
			echo "登录才能执行此操作！";
		else{
			$sid = $_GET["sid"];
			$bid = $_GET["bid"];
			$aid = $_GET["aid"];
			$bookrack = new BookrackModel();
			if(!empty($bookrack->checkId($bid, $aid)))
				echo "此书已添加！";
			else{
				if($bookrack->add($sid, $bid, $aid))
					echo "添加成功！";
				else
					echo "添加失败！";
			}
			
		}
	}
	
	
}
	

?>
<?php

require substr(dirname(__FILE__), 0, -5)."/init.inc.php";

if(is_array($_GET)){
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$bbs = new BbsModel();
		if(!empty($bbs->delete($id)))
			echo "删除成功！";
		else
			echo "删除失败！！";
	}
	else
		echo "接受数据失败！！";
}

?>
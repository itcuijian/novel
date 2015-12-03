<?php

require substr(dirname(__FILE__), 0, -5)."/init.inc.php";

if(is_array($_GET)){
	if($_GET['rid'] == null){
		echo '登录才能发表书评！';
	}
	else{
		$content = $_GET['content'];
		$rid = $_GET['rid'];
		$attr = $_GET['attr'];
		$time = time();
		$oid = $_GET['oid'];

		$comment = new CommentModel();
		if($comment->add($content, $rid, $time, $attr, $oid)){
			echo '发表成功！';
		}
		else{
			echo '发表失败！';
		}
	}
}

?>
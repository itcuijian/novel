<?php

require substr(dirname(__FILE__), 0, -5)."/init.inc.php";

if(is_array($_GET)){
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$comment = new CommentModel();
		if(!empty($comment->delete($id)))
			echo '删除成功！';
		else
			echo '删除失败！';
	}
	else
		echo '获取数据失败！';
}

?>
<?php
   
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
   
 //删除系统缓存
if(isset($_GET['action'])){
	if($_GET['action'] == 'templates'){
		DeleteFile::delFileUnderDir("../templates_c");
	}
	elseif($_GET['action'] == 'cache')
		DeleteFile::delFileUnderDir("../cache");
}

?>
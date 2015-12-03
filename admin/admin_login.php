<?php

require substr(dirname(__FILE__), 0, -6)."/init.inc.php";

global $tpl;


$login = new LoginAction($tpl);
$login->_action();

if(isset($_SESSION['admin']))
   Tool::alertLocation(null,'admin.php');

//执行diaplay，生成编译文件，并且引入
$tpl->display("admin_login.tpl");

?>
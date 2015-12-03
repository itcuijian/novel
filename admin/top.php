<?php

require substr(dirname(__FILE__), 0, -6)."/init.inc.php";

global $tpl;

$tpl->assign("admin_user", $_SESSION['admin']['admin_user']);
$tpl->assign("admin_lname", $_SESSION['admin']['admin_lname']);

//执行diaplay，生成编译文件，并且引入
$tpl->display("top.tpl");

?>
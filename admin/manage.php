<?php

require substr(dirname(__FILE__), 0, -6)."/init.inc.php";

global $tpl;

//控制器
$manage = new ManageAction($tpl);
$manage->action();

//执行diaplay，生成编译文件，并且引入
$tpl->display("manage.tpl");

?>
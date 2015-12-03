<?php

require substr(dirname(__FILE__), 0, -6)."/init.inc.php";

//验证是否已经登录
Validate::checkSession(); 

global $tpl;

//执行diaplay，生成编译文件，并且引入
$tpl->display("admin.tpl");


?>
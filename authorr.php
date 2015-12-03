<?php

require dirname(__FILE__)."/init.inc.php";

global $tpl;

$register = new RegisterAction($tpl);
$register->action();

//执行diaplay，生成编译文件，并且引入
$tpl->display("authorr.tpl");


?>
<?php

require dirname(__FILE__)."/init.inc.php";

global $tpl;


$index = new IndexAction($tpl);
$index->action();

//执行diaplay，生成编译文件，并且引入
$tpl->display("index.tpl");


?>
<?php

require dirname(__FILE__)."/init.inc.php";

global $tpl;

$cata = new CatalogAction($tpl);
$cata->action();


//执行diaplay，生成编译文件，并且引入
$tpl->display("catalog.tpl");

?>
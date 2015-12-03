<?php

require dirname(__FILE__)."/init.inc.php";

global $tpl;

$show = new ShowSectionAction($tpl);
$show->action();


//执行diaplay，生成编译文件，并且引入
$tpl->display("section.tpl");

?>
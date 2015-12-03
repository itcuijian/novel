<?php

require substr(dirname(__FILE__), 0, -6)."/init.inc.php";

global $tpl;

$book = new BookAction($tpl);
$book->action();

//执行diaplay，生成编译文件，并且引入
$tpl->display("admin_book.tpl");

?>
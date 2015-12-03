<?php

require dirname(__FILE__)."/init.inc.php";

global $tpl;

//验证作者是否已经登录
if(!isset($_SESSION["author"]))
	Tool::alertLocation("非法登录！", "authorr.php?type=author&action=login");

$author = new AuthorAction($tpl);
$author->action();

//执行diaplay，生成编译文件，并且引入
$tpl->display("author.tpl");


?>
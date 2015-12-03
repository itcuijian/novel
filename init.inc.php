<?php

//设置字符集
header('Content-Type:text/html;charset=utf-8');

//定义网站根目录路径
define('ROOT_PATH', dirname(__FILE__));

//引入 模板配置文件
require ROOT_PATH."/config/profile.php";

//设置时区
date_default_timezone_set("Asia/Shanghai");

//开启session
session_start();

//自动加载类
function __autoload($className)
{
	  if (substr($className, -6) == "Action")
  {
  	require ROOT_PATH."/action/".$className.".class.php";
  }
  elseif (substr($className, -5) == "Model")
  	{
  		require ROOT_PATH."/model/".$className.".class.php";
  	}
 else
 	{
 		require ROOT_PATH."/includes/".$className.".class.php";
 	}
  
}

//设置不缓存
// $cache = new Cache(array("code","cheup","static","update","register","feedback"));

//模板类实例化
$tpl=new Templates();

//初始化
require 'common.inc.php';

//判断是否已经登录
if(isset($_COOKIE["id"])){
	$rid = $_COOKIE["id"];
	$tpl->assign("login", true);
	$reader = new ReaderModel();
	$obj = $reader->getOneReader($rid);
	$tpl->assign("reader", $obj->reader);
	$tpl->assign("face", $obj->face);
}


?>
<?php

    //模板配置信息

   //定义模板目录路径
   define('TPL_DIR', ROOT_PATH.'/templates/');
   
   //定义编译目录路径
   define('TPL_C_DIR', ROOT_PATH.'/templates_c/');
   
    //定义缓存目录路径
   define('CACHE', ROOT_PATH.'/cache/');
   
   
   //数据库配置信息
   define("DB_HOST","localhost");      //主机IP
   define("DB_USER","root");           //服务器账号
   define("DB_PASS", "jian");          //服务器密码
   define("DB_NAME", "novel");           //数据库名称
   
   //系统配置信息
   define("PAGE_SIZE",10);              //每页显示的数量
   define("ARTICLE_SIZE",8);              //文章显示的数量	
   define('GPC',get_magic_quotes_gpc());      //mysql转义功能是否已经打开了
   define('NAV_SIZE',10);                   //前台显示的主导航数量
   define("UPDIR", "/uploads/");             //上传文件的目录

   if(isset($_SERVER["HTTP_REFERER"]))
      define("PREV_URL", $_SERVER["HTTP_REFERER"]);    //上一页的地址

?>
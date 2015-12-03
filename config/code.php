<?php

  //substr函数后面的-7表示从结尾开始截取
   require substr(dirname(__FILE__), 0,-7)."/init.inc.php";

  //验证码
  $vc = new ValidateCode();
  $vc->doimg();
  $_SESSION['code'] = $vc->getCode();

?>	
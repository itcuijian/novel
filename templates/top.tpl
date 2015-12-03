<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8">
	<title>top</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/admin.css" />
</head>
<body id="top">
	<div class="head"><em>小说连载系统后台管理</em></div>
	<ul class="right">
		<li><span class="glyphicon glyphicon-home"></span><a href="../" target="_blank">去首页</a></li>
		<li><span class="glyphicon glyphicon-off"></span><a href="admin_login.php?action=logout" target="_parent">退出</a></li>
	</ul>
	<div class="user">
		<div><span class="glyphicon glyphicon-user"></span><span> : {$admin_user}</span></div>
		<div><span class="glyphicon glyphicon-certificate"></span><span> : {$admin_lname}</span></div>
	</div>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta content="text/html;charset=utf-8">
	<title>小说连载系统后台登录</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body id="login">

<form method="post" action="?action=login">
	<fieldset>
		<legend>小说连载系统后台登录</legend>
		<div>
			<label>请输入账号：</label>
			<input type="text" name="admin_user" class="text" />
		</div>
		<div>
			<label>请输入密码：</label>
			<input type="password" name="admin_pass" class="text" />
		</div>
		<div>
			<label>请输入验证码：</label>
			<input type="text" name="code"  class="text"/>
			<p>请输入下面的验证码，不必区分大小写...</p>
		</div>
		<div>
			<img src="../config/code.php" onclick="javascript:this.src='../config/code.php?tm='+Math.random();" />	
		</div>
		<div>
			<input type="submit" name="send" class="submit" value="登录" />
		</div>
		
	</fieldset>
</form>

</body>
</html>
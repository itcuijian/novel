<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>注册</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/register.css" />
  <link rel="stylesheet" type="text/css" href="css/basic.css" />
  <script type="text/javascript" src="js/register.js"></script>
</head>
<body>

{include file='header.tpl'}

<div class="register">
<h3>小说连载系统 · 注册</h3>
	<form method="post" name="register" action="?type=reader">
		<ul>
			<li><label>邮箱：
				</label><input type="text" id="emali" placeholder="邮箱作为登录账号..." name="email" />
				<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
			</li>
			<li><label>读者昵称：
				</label><input type="text" id="reader" placeholder="不能少于两位，多于11位..." name="reader" />
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</li>
			<li><label>密码：
				</label><input type="password" id="pass" placeholder="不能少于6位..." name="pass" />
				<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
			</li>
			<li><label>确认密码：</label>
				<input type="password" id="notpass" placeholder="请再次输入密码..." name="notpass" />
				<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
			</li>
			<li><label>验证码：</label><input type="text" class="code" placeholder="不区分大小写..." name="code" />
				<img src="./config/code.php" onclick="javascript:this.src='./config/code.php?tm='+Math.random();" />
			</li>
			<li><input type="submit" class="submit" onclick="return checkForm();" name="send" value="注　册" /></li>
		</ul>
	</form>
</div>

{include file='footer.tpl'}

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/basic.js"></script>
</body>
</html>
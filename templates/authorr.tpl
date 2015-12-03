<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <title>作者专区</title>
  <link rel="stylesheet" type="text/css" href="css/author.css" />
  <link rel="stylesheet" type="text/css" href="css/basic.css" />
  <script type="text/javascript" src="js/authorr.js"></script>
</head>
<body id="reglog">
<ul class="nav">
	<li><a href="./" target="_blank">首页</a></li>
	<li><a href="library.php?kid=0" target="_blank" target="_blank" target="_blank">书库</a></li>
	<li><a href="rank.php?action=click" target="_blank" target="_blank">排行榜</a></li>
	<li><a href="bbs.php?action=show" target="_blank">论坛</a></li>
</ul>

<div class="logo"><img src="images/authorlogo.png" alt="logo"></div>

<h4><span><a href="authorr.php?type=author&action=login" class="{$lclass}" class="">登录</a>
			 <b>·</b> 
		   <a class="{$rclass}" href="authorr.php?type=author&action=register">注册</a></span>
</h4>

{if $register}
<div class="content">
	<form method="post" name="register" action="authorr.php?type=author&action=register">
		<ul>
			<li>
				<span>邮箱：</span>
				<input placeholder="请输入你要注册邮箱..." id="email" name="email" type="text" class="text" />
			</li>
			<li>
				<span>姓名：</span>
				<input placeholder="请输入你真实的姓名..." id="name" name="name" type="text" class="text" />
			</li>
			<li>
				<span>密码：</span>
				<input placeholder="不能少于6位..." id="pass" name="pass" type="password" class="text" />
			</li>
			<li>
				<span>确认密码：</span>
				<input placeholder="请再输一次..." id="notpass" name="notpass" type="password" class="text" />
			</li>
			<li>
				<span>笔名：</span>
				<input placeholder="不能少于两位，多于11位..." id="pseudonym" name="pseudonym" type="text" class="text" />
			</li>
			<li>
				<span>验证码：</span>
				<input placeholder="不区分大小写..." name="code" type="text" class="code" />
				<img src="./config/code.php" onclick="javascript:this.src='./config/code.php?tm='+Math.random();" />
			</li>
			<li>
				<input type="submit" value="注册" onclick="return checkForm();" class="submit" name="send" />
			</li>
		</ul>
	</form>
</div>
{/if}

{if $logins}
<div class="content">
	<form method="post" action="authorr.php?type=author&action=login">
		<ul>
			<li>
				<span>账号：</span>
				<input placeholder="请输入邮箱..." name="email" type="text" class="text" />
			</li>
			<li>
				<span>密码：</span>
				<input placeholder="请输入密码..." name="pass" type="password" class="text" />
			</li>
			<li>
				<span>验证码：</span>
				<input placeholder="不区分大小写..." name="code" type="text" class="code" />
				<img src="./config/code.php" onclick="javascript:this.src='./config/code.php?tm='+Math.random();" />
			</li>
			<li>
				<input type="submit" value="登录" class="login" name="send" />
			</li>
		</ul>
	</form>
</div>
{/if}
</body>
</html>
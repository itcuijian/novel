<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8">
	<title>top</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body id="main">
<h3>用户管理</h3>
<div class="top">
	<div>作者用户管理<span>/</span>列表</div>
	<a class="add" href="javascript:;">新 增</a>
	<form method="get" action="admin_author.php">
		<input type="text" class="text" name="key" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>


<div class="content">
<table>
	<tr class="top"><th>编号</th><th>邮箱</th><th>笔名</th><th>姓名</th><th>操作</th></tr>
	{if $AllAuthor}
	{foreach $AllAuthor(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
		<td>{@value->email}</td>
		<td>{@value->pseudonym}</td>
		<td>{@value->name}</td>
		<td>[ <a href="javascript:;" onclick="upd('author',{@value->id})">修改</a> ] | [ <a href="admin_author.php?action=delete&id={@value->id}" onclick="return confirm('确定删除？')?true:false">删除</a> ]</td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="5">对不起，没有任何数据...</td></tr>
	{/if}
</table>

<div class="page">
	{$page}
</div>
</div>


<div class="oprate" id="addata">
<h4>新增数据<span class="d">×</span></h4>
<form method="post" name="add" action="admin_author.php?action=add">
<div>
	<label>请输入邮箱：</label>
	<input type="text" name="email" class="txt email" />
</div>
<div>
	<label>请输入真实的姓名：</label>
	<input type="text" name="aname" class="txt tname" />
</div>
<div>
	<label>请输入笔名：</label>
	<input type="text" name="pseudonym" class="txt name" />
	<p class="info">不能多于11位。</p>
</div>
<div>
	<label>请输入密码：</label>
	<input type="password" name="pass" class="txt pass" />
	<p class="info">不能少于6位。</p>
</div>
<div>
	<label>请再一次输入密码：</label>
	<input type="password" name="notpass" class="txt notpass" />
</div>
<div>
	<input type="submit" class="submit" id="add" name="send" value="提交" />
	<span class="closes">关闭</span>
</div>
</form>
</div>




<div class="oprate" id="update">
<h4>更新数据<span class="d">×</span></h4>
<form method="post" name="update" action="admin_author.php?action=update">
<input type="hidden" name="npass" id="npass" />
<input type="hidden" name="id" id="id" />
<div>
	<label>请输入邮箱：</label>
	<input type="text" name="email" readonly="readonly" class="txt email uemail" />
</div>
<div>
	<label>请输入真实的姓名：</label>
	<input type="text" name="aname" class="txt tname utname" />
</div>
<div>
	<label>请输入笔名：</label>
	<input type="text" id="pseudonym" name="pseudonym" class="txt name" />
	<p class="info">不能多于11位。</p>
</div>
<div>
	<label>请输入密码：</label>
	<input type="password" name="pass" id="pass" class="txt pass" />
	<p class="info">不能少于6位，留空则不修改。</p>
</div>
<div>
	<label>请再一次输入密码：</label>
	<input type="password" name="notpass" class="txt notpass" />
</div>
<div>
	<input type="submit" class="submit" id="updat" name="send" value="提交" />
	<span class="closes">关闭</span>
</div>
</form>
</div>


<div class="screen"></div>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
</html>
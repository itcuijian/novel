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
	<div>后台会员管理<span>/</span>列表</div>
	<a class="add" href="javascript:;">新 增</a>
	<form method="get" action="manage.php">
		<input type="text" class="text" name="key" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>

<div class="content">
<table>
	<tr class="top"><th>编号</th><th>会员名</th><th>权限</th><th>操作</th></tr>
	{if $AllManage}
	{foreach $AllManage(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
		<td>{@value->user}</td><td>{@value->name}</td>
		<td>[ <a href="javascript:;" onclick="upd('manage',{@value->id})">修改</a> ] | [ <a href="manage.php?action=delete&id={@value->id}" onclick="return confirm('确定删除？')?true:false">删除</a> ]</td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="4"></td></tr>
	{/if}
</table>
<div class="page">
	{$page}
</div>
</div>


<div class="oprate" id="addata">
<h4>新增数据<span class="d">×</span></h4>
<form method="post" name="add" action="manage.php?action=add">
<div>
	<label>请输入用户名：</label>
	<input type="text" name="user" class="txt name" />
	<p class="info">11个字符以内。</p>
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
	<label>请选择权限：</label>
	<select name="level">
	{foreach $AllLevel(key,value)}
	<option type="radio" value="{@value->id}" />{@value->name}</option>
	{/foreach}
	</select>
</div>
<div>
	<input type="submit" class="submit" id="add" name="send" value="提交" />
	<span class="closes">关闭</span>
</div>
</form>
</div>




<div class="oprate" id="update">
<h4>更新数据<span class="d">×</span></h4>
<form method="post" name="update" action="manage.php?action=update">
<input type="hidden" name="npass" id="npass" />
<input type="hidden" name="rstate" id="rstate" />
<input type="hidden" name="id" id="id" />
<div>
	<label>请输入用户名：</label>
	<input type="text" class="txt name uname" name="user" />
	<p class="info">11个字符以内。</p>
</div>
<div>
	<label>请输入密码：</label>
	<input type="password" id="pass" name="pass" class="txt pass" />
	<p class="info">不能少于6位，留空则不修改。</p>
</div>
<div>
	<label>请再一次输入密码：</label>
	<input type="password" name="notpass" class="txt notpass" />
</div>
<div>
	<label>请选择权限：</label>
	<select name="level" id="sel">
	{foreach $AllLevel(key,value)}
	<option type="radio" value="{@value->id}" />{@value->name}</option>
	{/foreach}
	</select>
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
</body>
</html>
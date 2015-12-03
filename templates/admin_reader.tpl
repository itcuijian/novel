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
	<div>读者用户管理<span>/</span>列表</div>
	<a class="add" href="javascript:;">新 增</a>
	<form method="get" action="admin_reader.php">
		<input type="text" class="text" name="key" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>


<div class="content">
<table>
	<tr class="top"><th>编号</th><th>email</th><th>用户昵称</th><th>评论</th><th>操作</th></tr>
	{if $AllReader}
	{foreach $AllReader(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
		<td>{@value->email}</td>
		<td>{@value->reader}</td>
		<td><span>{@value->states}</span> | [ <a href="admin_reader.php?action=state&id={@value->id}&state={@value->state}">取消</a> ]
		</td>
		<td>[ <a href="javascript:;" onclick="upd('reader',{@value->id})">修改</a> ] | [ <a href="admin_reader.php?action=delete&id={@value->id}" onclick="return confirm('确定删除？')?true:false">删除</a> ]</td>
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
<form method="post" name="add" action="admin_reader.php?action=add">
<div>
	<label>请输入邮箱：</label>
	<input type="text" name="email" class="txt email" />
</div>
<div>
	<label>请输入昵称：</label>
	<input type="text" name="reader" class="txt name" />
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
<form method="post" name="update" action="admin_reader.php?action=update">
	<input type="hidden" name="npass" id="npass" />
	<input type="hidden" name="id" id="id" />
	<input type="hidden" name="rstate" id="rstate" />
	<div>
		<label>请输入邮箱：</label>
		<input type="text" name="email" readonly="readonly" class="txt email uemail" />
	</div>
	<div>
		<label>请输入昵称：</label>
		<input type="text" name="reader" class="txt name uname" />
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
		<label>请选择权限：</label>
		<select name="state" id="sel">
			<option type="radio" value="0" />禁止评论</option>
			<option type="radio" value="1" />允许评论</option>
		</select>
	</div>
	<div>
		<input type="submit" class="submit" id="add" name="send" value="提交" />
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
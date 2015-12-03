<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8">
	<title>top</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body id="main">
<h3>论坛管理</h3>
<div class="top">
	<div>评论管理<span>/</span>{$titl}</div>
	<form method="get" action="comment.php">
		<input type="text" class="text" name="key" />
		<input type="hidden" name="action" value="show" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>

{if $show}
<div class="content">
<table>
	<tr class="top"><th>编号</th><th>内容</th><th>用户名</th><th>发表时间</th><th>操作</th>
	</tr>	
	{if $AllComment}
	{foreach $AllComment(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
	<td>{@value->content}</td>
	<td>{@value->reader}</td>
	<td>{@value->time}</td>
	<td><a href="comment.php?action=delete&id={@value->id}">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="5">对不起，没有任何数据...</td></tr>
	{/if}
</table>
<div class="page">{$page}</div>
</div>
{/if}


<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/manage.js"></script>
</body>
</html>
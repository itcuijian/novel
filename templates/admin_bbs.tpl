<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8">
	<title>top</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body id="main">
{if $show}
<h3>论坛管理</h3>
<div class="top">
	<div>{$btitle}<span>/</span>{$titl}</div>
	<form method="get" action="bbs.php">
		<input type="text" class="text" name="key" />
		<input type="hidden" name="action" value="show" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>

<div class="content">
<table>
	<tr class="top"><th>编号</th><th>标题</th><th>用户名</th><th>状态</th><th>操作</th>
	</tr>	
	{if $Allbbs}
	{foreach $Allbbs(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
	<td><a href="bbs.php?action=detail&id={@value->id}">{@value->title}</a></td>
	<td>{@value->reader}</td>
	<td>{@value->state}</td>
	<td><a href="bbs.php?action=detail&id={@value->id}">查看详情</a> | <a href="bbs.php?action=delete&id={@value->id}" onclick="return confirm('确定删除？')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="5">对不起，没有任何数据。</td></tr>
	{/if}
</table>

<div class="page">
	{$page}
</div>
</div>
{/if}


{if $detail}
<h3>详情</h3>
<div class="content">
<div class="bbs">
<div><label>标题：</label><span>{$title}</span></div>
<div class="litlebox">
	<label>用户：</label><span>{$reader}</span>
	<span class="line">/</span>
	<label>状态：</label><span>{$state}</span>
</div>

<div><label>内容：</label><span class="contentbox">{$content}</span></div>
<form method="post" action="bbs.php?action=detail&id={$id}">
	<input id="input" type="submit" value="{$send}" name="send" />
	<input type="hidden" name="prev" value="{$prev}" />
	<a href="{$prev}">[ 返回上一页 ]</a>
</form>
</div>
</div>
{/if}




<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/manage.js"></script>
</body>
</html>
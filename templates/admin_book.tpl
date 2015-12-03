<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8">
	<title>top</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body id="main">
<h3>作品管理</h3>
<div class="top">
	<div>作品内容管理<span>/</span>{$titl}</div>
	<form method="get" action="book.php">
		<input type="text" class="text" name="key" />
		<input type="hidden" name="action" value="show" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>

{if $show}
<div class="content">
<table>
	<tr class="top"><th>编号</th><th>书号</th><th>书名</th><th>作者</th><th>状态</th><th>审核</th><th>操作</th></tr>	
	{if $AllBook}
	{foreach $AllBook(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
	<td>{@value->id}</td>
	<td><a href="book.php?action=detail&id={@value->id}">{@value->name}</a></td>
	<td>{@value->pseudonym}</td>
	<td>{@value->state}</td>
	<td>{@value->check}</td>
	<td><a href="book.php?action=detail&id={@value->id}">查看详情</a> | <a href="book.php?action=delete&id={@value->id}" onclick="return confirm('确定删除？')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="7">对不起，没有任何数据。</td></tr>
	{/if}
</table>

<div class="page">
	{$page}
</div>
</div>
{/if}


{if $detail}
<div class="content det">
<h4>《{$name}》</h4>
	<div class="img"><img src="{$surface}"></div>
	<div class="details">
	<div>
		<label>作者：</label>
		<span>{$pseudonym}</span>
	</div>
	<div><span class="line">/</span></div>
	<div>
		<label>类别：</label>
		<span>{$kname}</span>
	</div>
	<div><span class="line">/</span></div>
	<div>
		<label>状态：</label>
		<span>{$state}</span>
	</div>
	<div><span class="line">/</span></div>
	<div>
		<label>字数：</label>
		<span>{$count}</span>
	</div>
	</div>
	<div class="info">
		<label>简介：</label>
		<span><p>{$info}</p></span>
	</div>
	<form method="post" action="book.php?action=detail&id={$id}">
		<div class="form">
			<input id="input" type="submit" value="{$send}" name="send" />
			<input type="submit" value="{$sends}" name="sends" />
			<a href="{$prev}">[ 返回上一页 ]</a>
			<a href="section.php?action=show&bid={$id}">[ 查看章节 ]</a>
		</div>
	</form>
</div>
{/if}




<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
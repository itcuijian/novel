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
	<div>章节管理<span>/</span>{$titl}</div>
	<form method="get" action="section.php">
		<input type="text" class="text" name="key" />
		<input type="hidden" name="action" value="show" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>
</ol>

{if $show}
<div class="content">
<table>
	<tr class="top"><th>编号</th><th>章节</th><th>书名</th><th>状态</th><th>更新时间</th><th>操作</th></tr>	
	{if $AllSection}
	{foreach $AllSection(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
	<td><a href="section.php?action=detail&id={@value->id}">{@value->title}</a></td>
	<td>{@value->name}</td>
	<td>{@value->state}</td>
	<td>{@value->time}</td>
	<td><a href="section.php?action=detail&id={@value->id}">查看详情</a> | <a href="section.php?action=delete&id={@value->id}" onclick="return confirm('确定删除？')?true:false">删除</a></td>
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
<div class="content">
	<h4 class="title">{$title}</h4>
	<div class="litle">
		<div>
			<label>书名：</label><span><a href="book.php?action=detail&id={$bid}">{$name}</a></span>
			<span class="line">/</span>	
			<label>作者：</label><span>{$pseudonym}</span>
			<span class="line">/</span>		
			<label>分卷：</label><span>{$vname}</span>
			<span class="line">/</span>	
			<label>字数：</label><span>{$count}</span>
		</div>
		<div><label>更新时间：</label><span>{$time}</span></div>
	</div>
	<div class="message">{$content}</div>
	<div class="work">
		<form method="post" action="section.php?action=detail&id={$id}">
			<input type="hidden" name="prev" value="{$prev}" />
			<input type="submit" name="send" value="{$send}" />
		</form>
	</div>
	<div class="prev"><a href="{$prev}">[返回上一页]</a>　</div>
</div>
{/if}





<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
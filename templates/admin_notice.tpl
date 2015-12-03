<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8">
	<title>top</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<link rel="stylesheet" type="text/css" href="../css/notice.css">
</head>
<body id="main">
{if $notice}
<h3>公告管理</h3>
<div class="top">
	<div>{$btitle}<span>/</span>{$titl}</div>
	<a class="add" href="javascript:;">发 表 公 告</a>
	<form method="post" action="notice.php?action=notice">
		<input type="text" class="text" name="key" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>

<div class="content">
<table>
	<tr class="top"><th>编号</th><th>标题</th><th>发表时间</th><th>操作</th>
	</tr>	
	{if $AllNotice}
	{foreach $AllNotice(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
	<td><a href="bbs.php?action=detail&id={@value->id}">{@value->title}</a></td>
	<td>{@value->time}</td>
	<td><a href="bbs.php?action=detail&id={@value->id}">查看详情</a> | <a href="javascript:;" onclick="upd('notice',{@value->id})">修改</a> | <a href="bbs.php?action=delete&id={@value->id}" onclick="return confirm('确定删除？')?true:false">删除</a></td>
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


<div class="oprate" id="addata">
<h4>发表公告<span class="d">×</span></h4>
<form method="post" name="add" action="notice.php?action=add">
<input type="hidden" name="pid" value="0" />
<div>
	<label>请输入标题：</label>
	<input type="text" name="ntitle" class="txt title" />
</div>
<div>
	<label>请输入内容：</label>
	<textarea id="text1" name="ncontent" class="ckeditor"></textarea>
</div>
<div>
	<input type="submit" class="submit" id="add" name="send" value="提交" />
	<span class="closes">关闭</span>
</div>
</form>
</div>


<div class="oprate" id="update">
<h4>更新数据<span class="d">×</span></h4>
<form method="post" name="update" action="notice.php?action=update">
<input type="hidden" id="id" name="id"/>
<div>
	<label>请输入类型名称：</label>
	<input type="text" name="ntitle" class="txt title utitle" />
</div>
<div>
	<label>请输入简介：</label>
	<textarea id="text2" name="ncontent" class="ckeditor"></textarea>
</div>
<div>
	<input type="submit" class="submit" id="updat" name="send" value="提交" />
	<span class="closes">关闭</span>
</div>
</form>
</div>

<div class="screen"></div>

</body>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="../js/main.js"></script>
</html>
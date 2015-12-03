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
<h3>推荐管理</h3>
<div class="top">
	<div>推荐管理<span>/</span>列表</div>
	<a class="add" href="javascript:;">添 加 推 荐</a>
	<form method="get" action="recommend.php?">
		<input type="text" class="text" name="key" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>

<div class="content">
<table>
	<tr class="top"><th>编号</th><th>标题</th><th>属性</th><th>链接</th><th>操作</th>
	</tr>	
	{if $AllRecommend}
	{foreach $AllRecommend(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
	<td>{@value->title}</td>
	<td>{@value->attr}</td>
	<td>{@value->href}</td>
	<td><a href="javascript:;" onclick="upd('recommend',{@value->id})">修改</a> | <a href="recommend.php?action=delete&id={@value->id}" onclick="return confirm('确定删除？')?true:false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="5">对不起，没有任何数据。</td></tr>
	{/if}
</table>
{if $page}
<div class="page">
	{$page}
</div>
{/if}
</div>



<div class="oprate" id="addata">
<h4>添加推荐<span class="d">×</span></h4>
<form method="post" name="add" action="recommend.php?action=add">
<input type="hidden" name="pid" value="0" />
<div>
	<label>请输入标题：</label>
	<input type="text" name="rtitle" class="txt title" />
</div>
<div>
	<label>请输入属性：</label>
	<input type="text" name="attr" class="txt attr" />
</div>
<div>
	<label>请输入链接：</label>
	<input type="text" name="hrf" class="txt hrf" />
</div>
<div>
	<input type="submit" class="submit" id="add" name="send" value="提交" />
	<span class="closes">关闭</span>
</div>
</form>
</div>


<div class="oprate" id="update">
<h4>更新数据<span class="d">×</span></h4>
<form method="post" name="update" action="recommend.php?action=update">
<input type="hidden" id="id" name="id"/>
<div>
	<label>请输入标题：</label>
	<input type="text" name="rtitle" class="txt title utitle" />
</div>
<div>
	<label>请输入属性：</label>
	<input type="text" name="attr" class="txt attr uattr" />
</div>
<div>
	<label>请输入链接：</label>
	<input type="text" name="hrf" class="txt hrf uhrf" />
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
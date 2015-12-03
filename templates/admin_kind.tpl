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
<h3>作品管理</h3>
<div class="top">
	<div>作品类别管理<span>/</span>{$titl}</div>
	<a class="add" href="javascript:;">新 增</a>
	<form method="get" action="kind.php">
		<input type="text" class="text" name="key" />
		<input type="hidden" name="action" value="show" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>


<div class="content">
<table>
	<tr class="top"><th>编号</th><th>类别名称</th><th>类别描述</th><th>子类别</th><th>操作</th></tr>
	{if $AllKind}
	{foreach $AllKind(key,value)}
	<tr>
        <td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
        <td>{@value->name}</td>
        <td>{@value->info}</td>
        <td><a href="kind.php?action=showchild&id={@value->id}">查看</a> | <a href="javascript:;" onclick="show({@value->id}, '{@value->name}')">增加子类别</a></td>
        <td><a href="javascript:;" onclick="upd('kind',{@value->id})">[ 修改 ]</a> | <a href="kind.php?action=delete&id={@value->id}" onclick="return confirm('确定删除类别？')?true:false">[ 删除 ]</a></td>
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


<div class="oprate" id="addata">
<h4>新增数据<span class="d">×</span></h4>
<form method="post" name="add" action="kind.php?action=add">
<input type="hidden" name="pid" value="0" />
<div>
	<label>请输入类型名称：</label>
	<input type="text" name="kname" class="txt name" />
</div>
<div>
	<label>请输入简介：</label>
	<textarea class="sim" name="kinfo"></textarea>
	<p class="info">简介不能超出200个字。</p>
</div>
<div>
	<input type="submit" class="submit" id="add" name="send" value="提交" />
	<span class="closes">关闭</span>
</div>
</form>
</div>


<div class="oprate" id="addata1">
<h4>新增数据<span class="d">×</span></h4>
<form method="post" name="add1" action="kind.php?action=add">
<input type="hidden" name="pid" id="pid" />
<div>
	<label>上级类别：</label>
	<input type="text" class="txt" id="prev_name" readonly="readonly" />
</div>
<div>
	<label>请输入类型名称：</label>
	<input type="text" name="kname" class="txt name" />
</div>
<div>
	<label>请输入简介：</label>
	<textarea class="sim" name="kinfo"></textarea>
	<p class="info">简介不能超出200个字。</p>
</div>
<div>
	<input type="submit" class="submit" id="add1" name="send" value="提交" />
	<span class="closes">关闭</span>
</div>
</form>
</div>

{/if}


{if $showchild}
<h3>作品管理</h3>
<div class="top">
	<div>作品类别管理<span>/</span>{$titl}</div>
	<a class="add" href="javascript:;">新 增</a>
	<form method="get" action="kind.php">
		<input type="text" class="text" name="key" />
		<input type="hidden" name="id" value="{$id}" />
		<input type="hidden" name="action" value="showchild" />
		<input type="submit" value="搜索" class="sub" name="search" />
	</form>
</div>


<div class="content">
<table>
	<tr class="top"><th>编号</th><th>类别名称</th><th>类别描述</th><th>操作</th></tr>
	{if $AllChild}
	{foreach $AllChild(key,value)}
	<tr>
	<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
        <td>{@value->name}</td>
        <td>{@value->info}</td>
		 <td><a href="javascript:;" onclick="upd('kind',{@value->id})">[ 修改 ]</a> | <a href="kind.php?action=delete&id={@value->id}" onclick="return confirm('确定删除类别？')?true:false">[ 删除 ]</a></td>
    </tr>
	{/foreach}
	{else}
	<tr><td colspan="4">对不起，没有任何数据。</td></tr> 
	{/if}
</table>

<div class="page">
	{$page}
</div>
</div>


<div class="oprate" id="addata">
<h4>新增数据<span class="d">×</span></h4>
<form method="post" name="add" action="kind.php?action=add">
<input type="hidden" name="pid" value="{$id}" />
<div>
	<label>上级类别：</label>
	<input type="text" class="txt" value="{$prev_name}" readonly="readonly" />
</div>
<div>
	<label>请输入类型名称：</label>
	<input type="text" name="kname" class="txt name" />
</div>
<div>
	<label>请输入简介：</label>
	<textarea class="sim" name="kinfo"></textarea>
	<p class="info">简介不能超出200个字。</p>
</div>
<div>
	<input type="submit" class="submit" id="add" name="send" value="提交" />
	<span class="closes">关闭</span>
</div>
</form>
</div>
{/if}


<div class="oprate" id="update">
<h4>更新数据<span class="d">×</span></h4>
<form method="post" name="update" action="kind.php?action=update">
<input type="hidden" id="id" name="id"/>
<div>
	<label>请输入类型名称：</label>
	<input type="text" name="kname" class="txt name uname" />
</div>
<div>
	<label>请输入简介：</label>
	<textarea class="sim" name="kinfo"></textarea>
	<p class="info">简介不能超出200个字。</p>
</div>
<div>
	<input type="submit" class="submit" id="updat" name="send" value="提交" />
	<span class="closes">关闭</span>
</div>
</form>
</div>

<div class="screen"></div>
</body>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
</html>
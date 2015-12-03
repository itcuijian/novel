<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>搜索</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/basic.css" />
  <link rel="stylesheet" type="text/css" href="css/search.css" />
</head>
<body>

{include file='header.tpl'}
<input type="hidden" id="rid" value="{$rid}" />

<div class="sch">
<div class="key">
	<span>关键字：</span>
	<a href="search.php?type=keyword&key=热血">热血</a>
	<a href="search.php?type=keyword&key=爽文">爽文</a>
	<a href="search.php?type=keyword&key=穿越">穿越</a>
	<a href="search.php?type=keyword&key=异世">异世</a>
	<a href="search.php?type=keyword&key=网游">网游</a>
</div>
<form method="get" action="search.php">
	<span class="glyphicon glyphicon-search s"></span>
	<input type="text" placeholder="请输入要搜索的内容..." class="text" name="key" value="{$key}" />
	<select name="type" id="select">
		<option value="all">综　合</option>
		<option value="book">书　名</option>
		<option value="author">作　者</option>
		<option value="kind">类　别</option>
		<option value="keyword">关键字</option>
	</select>
	<input type="submit" value="搜索" class="submit" name="send" />
	<input type="hidden" value="{$type}" id="type" />
</form>
</div>

<div class="result">
	<h3><span>搜索结果</span></h3>
	{if $Result}
	{foreach $Result(key,value)}
	<div class="show">
		<div class="sur"><img src="{@value->surface}"></div>
		<div class="right">
			<div class="box">
				<h4>{@value->name}</h4>
				<div class="topbox">
					<span>作者：
						{@value->pseudonym}
					</span>
					<span>分类：
						{@value->kname}
					</span>
					<span class="word">关键字：{@value->word}</span>
					<div class="txt">{@value->info}</div>
				</div>
				<div class="bottbox">
					<div class="latest">最新更新：
					<a href="section.php?id={@value->lid}" target="_blank">{@value->title}</a>
					<span class="time">{@value->time}</span>
					</div>
					<div class="operate">
						<a href="javascript:;" class="rack">订阅本书</a> | 
						<a href="section.php?id={@value->fid}" target="_blank">立即阅读</a>
						<input type="hidden" value="{@value->id}" />
						<input type="hidden" value="{@value->fid}" />
					</div>
				</div>
			</div>
		</div>
	</div>
	{/foreach}
	<div class="page">{$page}</div>
	{else}
	<div class="show"><span>没有找到符合条件的小说，请尝试搜索其它关键字。</span></div>
	{/if}
	
</div>

<div class="tips" id="tip">
	<div class="top"></div>
	<p id="p"></p>
	<a href="javascript:;" id="sure">确 定</a>
</div>

{include file='footer.tpl'}

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/basic.js"></script>
<script src="js/search.js"></script>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>排行榜</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/basic.css" />
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/rank.css" />
</head>
<body>

{include file='header.tpl'}

<div class="left">
	<div>
		<h4>综合排行榜</h4>
		<ul class="a">
			<li><a href="rank.php?action=click">点击排行榜</a></li>
			<li><a href="rank.php?action=rack">订阅排行榜</a></li>
			<li><a href="rank.php?action=new">新书推送榜</a></li>
		</ul>
	</div>
	<div>
		<h4>分类排行榜</h4>
		<ul class="a">
			{if $SevenKind}
			{foreach $SevenKind(key,value)}
			<li><a href="rank.php?action=kind&kid={@value->id}">{@value->name}榜</a></li>
			{/foreach}
			{/if}
		</ul>
	</div>
</div>

<div class="right">
<h3>{$h3}</h3>
	<div class="head">
		<span class="sort">排名</span>
		<span class="kind">类别</span>
		<span class="nt">书名/章节</span>
		<span class="number">{$head}</span>
		<span class="author">作者</span>
		<span class="time">更新时间</span>
	</div>
	<ul>
		
		{if $RankOfClick}
		{foreach $RankOfClick(key,value)}
		<li>
			<span class="sort"><script type="text/javascript">document.write({@key+1}+{$num})</script></span>
			<a href="search.php?type=kind&key={@value->kname}" class="kind" target="_blank">{@value->kname}</a>
			<span class="nt">
				<a href="book.php?id={@value->id}" target="_blank" class="name" title="{@value->bname}">{@value->bname}</a>
				<a href="section.php?id={@value->sid}" target="_blank" class="title" title="{@value->titlel}">{@value->title}
				</a>
			</span>
			<span class="number">{@value->number}</span>
			<a href="search.php?type=author&key={@value->pseudonym}" class="author" title="{@value->pseudonym}" target="_blank">{@value->pseudonyms}</a>
			<span class="time" title="{@value->time}">{@value->times}</span>
		</li>
		{/foreach}
		{/if}
	</ul>
	<div class="page">
		{$page}
	</div>
</div>

{include file='footer.tpl'}

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/basic.js"></script>
<script src="js/rank.js"></script>
</body>
</html>
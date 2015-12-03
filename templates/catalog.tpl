<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>章节列表_{$bname}</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/basic.css" />
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/catalog.css" />
</head>
<body>

{include file='headers.tpl'}
<div class="back">
	<a href="./">首页</a>
	<label>&gt;</label>
	<a href="library.php?kid={$kid}">{$kname}</a>
	<label>&gt;</label>
	<a href="search.php?type=kind&key={$cname}">{$cname}</a>
	<label>&gt;</label>
	<a href="book.php?id={$id}">{$bname}</a>
</div>
<div class="cata">
<div class="mar"></div>
	<h1>{$bname}</h1>
	<span class="author">作者：<a href="search.php?type=author&key={$pseudonym}">{$pseudonym}</a></span>
	{if $volume}
	{foreach $volume(key,value)}
	<div class="volume">
		<h5>{@value->name}</h5>
		<span></span>
		<ul>
			
			{iff @value->section}
			{for @value->section(key,value)}
			<li><a href="section.php?id={@value->id}">{@value->title}</a></li>
			{/for}
			{/iff}
		</ul>
	</div>
	{/foreach}
	{/if}
</div>

{include file='footer.tpl'}

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/basic.js"></script>
</body>
</html>
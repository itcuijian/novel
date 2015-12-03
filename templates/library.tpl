<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>书库</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/basic.css" />
  <link rel="stylesheet" type="text/css" href="css/library.css" />
</head>
<body>
{include file='header.tpl'}
<div class="head">书库</div>
<div class="box">
	<div class="bz">作品类型：</div>
	<div id="a">
		<a href="library.php?kid=0">全部</a>
		{if $AllKind}
		{foreach $AllKind(key,value)}
		<a href="library.php?kid={@value->id}">{@value->name}</a>
		{/foreach}
		{/if}
	</div>
</div>

<div class="lib">
<div class="header">
    <span class="kind">类别</span>
    <span class="book">书名/章节</span>
    <span class="number">总字数</span>
    <span class="author">作者</span>
    <span class="time">更新时间</span>
  </div>
	 <ul class="book">
    {if $AllBook}
	{foreach $AllBook(key,value)}
    <li>
      <span class="kind"><a href="search.php?type=kind&key={@value->kname}" target="_blank">[{@value->kname}]</a></span>
      <span class="book">
        <a class="article" href="book.php?id={@value->id}" target="_blank">{@value->bname}</a>
        <a class="title" href="section.php?id={@value->sid}" title="{@value->vname}　{@value->titlel}" target="_blank">{@value->vname}　{@value->title}</a>
      </span>
        <span class="number">{@value->count}</span>
      <span class="author"><a href="search.php?type=author&key={@value->pseudonym}" title="{@value->pseudonym}" target="_blank">{@value->pseudonyms}</a></span>
      <span class="time" title="{@value->timel}">{@value->times}</span>
    </li>
    {/foreach}
    {/if}
    </ul>
<div class="page">
	{$page}
</div>
</div>

<div class="rank ">
  <h2>点击排行榜</h2>
  <ul>
    {if $click}
    {foreach $click(key,value)}
    <li>
    <a href="book.php?id={@value->id}" target="_blank">{@value->bname}</a>
    <em>{@value->click}</em><span>{@key+1}</span>
    </li>
    {/foreach}
    {/if}
  </ul>
  <div class="more"><a href="rank.php?action=click" target="_blank">查看更多&gt&gt</a></div>
</div>

{include file='footer.tpl'}
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/basic.js"></script>
<script src="js/library.js"></script>
</body>
</html>
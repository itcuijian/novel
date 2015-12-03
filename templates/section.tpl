<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{$bname}_{$title}</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/basic.css" />
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/section.css" />
</head>
<body oncontextmenu="return false;" onselectstart="return false;" oncopy="return false;">

{include file='headers.tpl'}
<div class="back">
	<a href="./">首页</a>
	<label>&gt;</label>
	<a href="library.php?kid={$kid}">{$kname}</a>
	<label>&gt;</label>
	<a href="search.php?type=kind&key={$cname}">{$cname}</a>
	<label>&gt;</label>
	<a href="book.php?id={$bid}">{$bname}</a>
</div>

<input type="hidden" id="aid" value="{$aid}" />
<input type="hidden" id="bid" value="{$bid}" />
<input type="hidden" id="sid" value="{$id}" />
<div class="content">
	<h3>{$vname}</h3>
	<h1>{$title}</h1>
	<span class="author">作者：<a href="search.php?type=author&key={$pseudonym}" target="_blank">{$pseudonym}</a></span>
	<span class="info">更新时间：<em>{$time}</em>字数：<em>{$count}</em></span>
	<span class="line"></span>
	{if $allsection}
	<div class="detail" readonly="readonly">
		{$content}
	</div>
	{else}
	<div class="detail" id="hard" readonly="readonly">
		{$content}
	</div>
	<div class="order">
		<div class="charge">
			作品订阅：<span>{$bname}</span>
			<div class="add">
				<p>你需要订阅本书才能继续阅读...<a href="javascript:;" id="add_book">订阅本书</a></p>
			</div>
		</div>
	</div>
	{/if}
	<div class="work">
		<a href="{$before}" onclick="{$bclick}">上一章</a>
		<a href="catalog.php?id={$bid}">目录</a>
		<a href="{$next}" onclick="{$nclick}">下一章</a>
	</div>
</div>

<div class="comment">
	<h3>评论区</h3>
	{if $AllComment}
	{foreach $AllComment(key,value)}
	<table>
		<tbody>
			<tr>
				<td class="left"><img src="{@value->face}"></td>
				<td class="right">
					<div class="top">
					<span>{@value->reader}</span><span class="line">|</span><span>发表于{@value->time}</span>
					</div>
					<div class="contents">{@value->content}</div>
				</td>
			</tr>
		</tbody>
	</table>
	{/foreach}
	<div class="page">{$page}</div>
	{else}
	<table><tbody><tr><td><div class="noCom">暂无评论！！</div></td></tr></tbody></table>
	{/if}

	<div class="publish">
		<textarea id="content"></textarea>
		<a href="javascript:;" id="publish">发表</a>
	</div>
</div>

<div class="sidebar">
	<ul>
		<li><a href="book.php?id={$bid}" class="first">书页</a></li>
		<li><a href="catalog.php?id={$bid}">目录</a></li>
		<li><a href="{$before}" onclick="{$bclick}">上一章</a></li>
		<li><a href="{$next}" onclick="{$nclick}" class="last">下一章</a></li>
	</ul>
</div>

<div class="tips" id="tip">
	<div class="top"><span id="shut">&times;</span></div>
	<p>{$tip}</p>
	<p><a href="catalog.php?id={$bid}">返回目录</a></p>
	<p><a href="book.php?id={$bid}">返回书页</a></p>
</div>

<div class="say" id="say">
	<div class="top"></div>
	<p id="p"></p>
	<a href="javascript:;" id="sure">确 定</a>
</div>

{include file='footer.tpl'}

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/basic.js"></script>
<script src="js/section.js"></script>
</body>
</html>
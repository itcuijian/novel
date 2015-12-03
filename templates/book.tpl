<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{$bname}</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/basic.css" />
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/book.css" />
</head>
<body>

{include file='header.tpl'}

<div class="book">
	<a href="catalog.php?id={$id}" class="photo"><img src="{$surface}"></a>
	<div class="main">
		<h1><a href="catalog.php?id={$id}">{$bname}</a></h1>
		<div class="top">
			<span>作者：</span><a href="search.php?type=author&key={$pseudonym}" target="_blank">{$pseudonym}</a>
			<label>|</label>
			<span>分类：</span><a href="search.php?type=kind&key={$kname}" target="_blank">{$kname}</a>
			<label>|</label>
			<span>字数：</span>{$count}字
			<label>|</label>
			<span>点击量：</span>{$click}
		</div>
		<p>{$info}</p>
	</div>
	<div class="work">
		<a href="section.php?id={$fid}">点击阅读</a>
		<a href="javascript:;" id="addbook">加入书架</a>
		<input type="hidden" id="sid" value="{$fid}" />
		<input type="hidden" id="bid" value="{$id}" />
		<input type="hidden" id="aid" value="{$aid}" />
		<a href="catalog.php?id={$id}" target="_blank">查看目录</a>
	</div>
	<div class="latest">
		<span>最新章节</span>
		<a href="section.php?id={$sid}">{$vname}： {$title}
		<p>{$content}</p>
		</a>
	</div>
	<div class="key">
		<span>关键字：</span>
		{$keyword}
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
					<div class="content">{@value->content}</div>
				</td>
			</tr>
		</tbody>
	</table>
	{/foreach}
	<div class="page">{$page}</div>
	{else}
	<table><tbody><tr><td><div class="noCom">暂无书评！！</div></td></tr></tbody></table>
	{/if}

	<div class="publish">
		<textarea id="content"></textarea>
		<a href="javascript:;" id="publish">发表</a>
	</div>
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
<script src="js/book.js"></script>
</body>
</html>
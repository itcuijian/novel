<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>个人中心</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/reader.css" />
  <link rel="stylesheet" type="text/css" href="css/basic.css" />
  <link rel="stylesheet" type="text/css" href="jcrop/css/jquery.Jcrop.css"> 
  <link href="uploadify/uploadify.css" type="text/css" rel="stylesheet" />
</head>
<body>

{include file='header.tpl'}

<div class="reader">
	<div class="top">
		<div class="pic"><img src="{$face}"></div>
		<ul>
			<li>
				<p>昵称:<span>{$reader}</span></p>
				<p>邮箱:<span>{$email}</span></p>
				<p>性别:<span>{$sex}</span></p>
			</li>
			<li>
				<p>状态:<span>{$state}</span></p>
			</li>
			<li>
				<p>地址:<span>{$adress}</span></p>
			</li>
			<li>
				<p>个人简介:<span>{$info}</span></p>
			</li>
		</ul>
	</div>
	
	<div class="bottom">
		<div class="menu">
			<ul id="ulmenu">
				<li class="active">
					<span class="glyphicon glyphicon-book"></span>
					<a href="?action=book">我的书架</a>
				</li>
				<li>
					<span class="glyphicon glyphicon-cog"></span>
					<a href="?action=set">账号设置</a>
				</li>
				<li>
					<span class="glyphicon glyphicon-user"></span>
					<a href="?action=photo">修改头像</a>
				</li>
				<li >
					<span class="glyphicon glyphicon-file"></span>
					<a href="?action=bbs">我的帖子</a>
				</li>
				<li >
					<span class="glyphicon glyphicon-comment"></span>
					<a href="?action=comment">我的评论</a>
				</li>
			</ul>
		</div>

		<div class="mymain">
		{if $book}
		<div class="book">
			<h5>我的书架</h5>
			<div class="head">
				<span class="kind">类别</span>
				<span class="name">书名</span>
				<span class="author">作者</span>
				<span class="last">最新章节</span>
				<span class="time">更新时间</span>
				<span class="work">操作</span>
			</div>
			<ul>
				{if $bookrack}
				{foreach $bookrack(key,value)}
				<input type="hidden" id="rid" value="{$id}" />
				<li>
					<a href="search.php?type=kind&key={@value->kname}" target="_blank" class="kind">{@value->kname}</a>
					<a href="book.php?id={@value->bid}" class="name" title="{@value->name}" target="_blank">
					{@value->names}
					</a>
					<a href="search.php?type=author&key={@value->pseudonym}" target="_blank" class="author" title="{@value->pseudonym}">{@value->pseudonyms}</a>
					<a href="section.php?id={@value->lid}" class="last" title="{@value->title}" target="_blank">
					{@value->titles}
					</a>
					<span class="time" title="{@value->time}">{@value->times}</span>
					<span class="work"><a href="section.php?id={@value->sid}" target="_blank">继续阅读</a> | <a href="javascript:;" class="delete">移出书架</a>
					<input type="hidden" value="{@value->bid}" />
					</span>
				</li>
				{/foreach}
				{else}
				<li><span class="work">对不起，书架没有书籍...</span></li>
				{/if}
			</ul>
			<div class="page">
				{$page}
			</div>
		</div>
		{/if}

		{if $set}
			<div class="set">
				<form action="reader.php?action=set" method="post">
				<input type="hidden" id="sex1" value="{$sex}" />
				<input type="hidden" name="npass" value="{$pass}" />
				<input type="hidden" name="nreader" value="{$reader}" />
					<ul>
						<li><label>邮箱：</label>{$email}</li>
						<li><label>昵称：</label><input name="reader" type="text" value="{$reader}">
							<span>(*昵称不能少于两位，多于11位。)</span>
						</li>
						<li><label>性别：</label>
							<input type="radio" id="radio1" name="sex" value="男" class="radio" />男
							<input type="radio" id="radio2" name="sex" value="女" class="radio" />女
						</li>
						<li><label>地址：</label><input name="adress" type="text" value="{$adress}"></li>
						<li><label>密码：</label><input name="pass" type="password" />
							<span>(*密码不能少于6位，留空则不修改。)</span>
						</li>
						<li><label class="info">个人简介：</label><textarea name="info" rows="4" cols="20">{$info}</textarea>
						<span>(*简介不能多于200位。)</span>
						</li>
						<li><input type="submit" class="submit" name="send" value="保存"></li>
					</ul>
				</form>
			</div>
		{/if}

		{if $photo}
		<div class="photo">
			<form method="post" action="?action=photo">
				<label class="first">上传图片：</label>
				<div class="file"><input type="file" id="uploads" /></div>
				<!-- <span>(*图片格式为jpg、png、gif或者jpeg)</span> -->
				<div class="pic">
					<div class="pic1"><img id="element_id" src="images/choosepic.png"></div>
					<div class="pic2"><img id="preview" class="preview" src=""></div>
					<div class="pic3"><img id="preview2" class="preview" src=""></div>
				</div>
				<input type="hidden" id="face" name="face">
				<input type="hidden" id="x" name="x">
				<input type="hidden" id="y" name="y">
				<input type="hidden" id="w" name="w">
				<input type="hidden" id="h" name="h">
				<input type="hidden" id="p" name="p">
				<input type="submit" name="send" class="submit" value="保存" />
			</form>
		</div>
		{/if}

		{if $bbs}
		<div class="bbs">
			<h5>我的帖子</h5>
			<div class="head">
				<span class="title">标题</span>
				<span class="time">发表时间</span>
				<span class="delete">删除</span>
			</div>
			<ul>
				{if $AllBBS}
				{foreach $AllBBS(key,value)}
				<li>
					<a href="details.php?action=show&oid={@value->id}" class="title" target="_blank" title="{@value->title}">{@value->titles}</a>
					<span class="time">{@value->time}</span>
					<a href="javascript:;" class="delbbs">删除</a>
					<input type="hidden" value="{@value->id}" />
				</li>
				{/foreach}
				{else}
				<li><span>对不起，没有任何帖子...</span></li>
				{/if}
			</ul>
			<div class="page">{$page}</div>
		</div>
		{/if}

		{if $comment}
		<div class="comment">
			<h5>我的评论</h5>
			<ul>
				{if $AllComment}
				{foreach $AllComment(key,value)}
				<li>
					<div class="up">对“
					<a href="{@value->href}" title="{@value->title}" target="_blank">{@value->titles}</a>”发表了评论
						<span class="time">{@value->time}</span>
					</div>
					<div class="down">评论内容：
						<span class="content">{@value->content}</span>
						<input type="hidden" value="{@value->id}" />
						<a href="javascript:;" class="delcomment">删除</a>
					</div>
				</li>
				{/foreach}
				{else}
				<li><span>对不起，没有任何评论...</span></li>
				{/if}
			</ul>
			<div class="page">{$page}</div>
		</div>
		{/if}

		</div>

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
<script src="js/reader.js"></script>
<script type="text/javascript" src="uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="jcrop/js/jquery.Jcrop.min.js"></script>
</body>
</html>
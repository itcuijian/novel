<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>小说连载系统_论坛</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/details.css" />
</head>
<body>

<div class="header">
	<ul>
		<li><a href="./" target="_blank">首页</a></li>
	    <li><a href="library.php?kid=0" target="_blank">书库</a></li>
	    <li><a href="rank.php?action=click" target="_blank">排行榜</a></li>
	    <li><a href="authorr.php?type=author&action=login" target="_blank">作者专区</a></li>
	    <li><a href="reader.php?action=book" target="_blank">个人中心</a></li>
    	{if $login}
    	<li class="user"><img src="{$face}"></li>
    	{else}
    	<li style="float: right;">
	    	<a href="javascript:;" class="denglu">登录</a>
	    	<a href="register.php?type=reader">注册</a>
    	</li>
    	{/if}
	</ul>
</div>

<div class="main">
	 <table> 
    {if $AllComment}
    {foreach $AllComment(key,value)}
    <tbody>
      <tr>
        <td class="left">
          <div><img src="{@value->face}"></div>
          <div class="auth">
            <span class="name">{@value->reader}</span>
            <span class="glyphicon glyphicon-file" title="帖子：{@value->bcount}">：{@value->bcount}</span>
            <span class="glyphicon glyphicon-comment" title="评论：{@value->ccount}">：{@value->ccount}</span>
          </div>
        </td>
        <td class="right">
          <div class="top">
            <h3>{@value->title}</h3>
            <div>
              {iff @value->title}
              <span>回复：{@value->number}</span>
              <span class="tab">|</span>
              {/iff}
              <span>发表于 {@value->time}</span>
              {iff @value->title}
              <span class="level">楼主</span>
              {else}
              <span class="levels"><script type="text/javascript">document.write({@key}+{$num})</script>#</span>
              {/iff}
            </div>
          </div>
          <div class="content">
            {@value->content}
          </div>
        </td>
      </tr>
    </tbody>
    {/foreach}
    {/if}
   </table>
   <div class="page">{$page}</div>
</div>


<div class="main">
  <table>
    <tbody class="put">
        <tr>
        <td class="left">
        {if $login}
          <div><img src="{$face}"></div>
        {else}
        <div><img src="images/noneuser.jpg"></div>
        {/if}
        </td>
        <td class="right">
        <form method="post" action="details.php?action=publish&oid={$oid}">
          <div>
            <textarea name="content"></textarea>
            <input type="submit" value="发表评论" name="send" /><span>评论内容控制在200个字以内</span>
          </div>
        </form>
        </td>
      </tr>
    </tbody>
  </table>
</div>










<div class="userinfo">
	<ul>
	    <li>
	      <p><span class="glyphicon glyphicon-user" aria-hidden="true"></span>{$reader}</p>
	    </li>
	    <li>
	      <p>
	        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	        <a href="reader.php?action=set" target="_blank">账号设置</a>
	      </p>
	    </li>
	    <li>
	      <p>
	        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
	        <a href="index.php?action=logout">退出</a>
	      </p>
	    </li>
	  </ul>
</div>



<div id="login" class="login">
  <h2><span class="closes">&times;</span></h2>
  <p>登录</p>
  <form method="post" action="index.php?action=login">
  <ul>
    <li>
      <span class="glyphicon glyphicon-user"></span>
      <input type="text" class="text" name="email" placeholder="账号：请输入邮箱..." />
    </li>
    <li>
      <span class="glyphicon glyphicon-lock"></span>
      <input type="password" class="text" name="pass" placeholder="密码：请输入密码..." />
    </li>
    <li>
      <input type="text" name="code" placeholder="验证码：不区分大小写" class="code" />
      <img src="./config/code.php" onclick="javascript:this.src='./config/code.php?tm='+Math.random();" />
    </li>
    <li>
      <input type="submit" class="submit" name="send" value="登录" />
    </li>
    <li><a href="register.php?type=reader">立即注册</a></li>
  </ul>
  </form>
</div>

<div id="screen"></div>

{include file='footer.tpl'}

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="ckeditor/ckeditor.js"></script> 
<script src="js/bbs.js"></script>
</body>
</html>
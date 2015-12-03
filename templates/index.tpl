<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>首页</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/basic.css" />
</head>
<body>

{include file='header.tpl'}

<div class="contentp">
  <div class="inpic">
    <div class="pbig" >
    {if $Four}
      {foreach $Four(key,value)}
      <a href="book.php?id={@value->id}" target="_blank" class="max"><img src="{@value->surface}" alt="大图"></a>
      {/foreach}
      {/if}
    </div>

    <div class="psmall">
      {if $Four}
      {foreach $Four(key,value)}
      <a href="book.php?id={@value->id}" target="_blank" class="min"><img src="{@value->surface}"></a>
      {/foreach}
      {/if}
    </div>

    
    {if $Four}
      {foreach $Four(key,value)}
      <div class="picinfo">
      <h4><a href="book.php?id={@value->id}" target="_blank">{@value->name}</a></h4>
      <p><a href="book.php?id={@value->id}" title="{@value->infos}" target="_blank">{@value->info}</a></p>
      </div>
      {/foreach}
    {/if}
    
  </div>

  <div class="news">
    <div class="notice">
      <h3><a href="{$firstHref}" target="_blank">{$firstTitle}</a></h3>
      <ul>
        {if $FirstMore}
        {foreach $FirstMore(key,value)}
        <li><a href="{@value->href}" target="_blank">{@value->title}<span>[{@value->attr}]</span></a></li>
        {/foreach}
        {/if}
      </ul>
    </div>

    <div class="newsrec">
      <h3><a href="{$NextHref}" target="_blank">{$NextTitle}</a></h3>
      <ul>
        {if $NextMore}
        {foreach $NextMore(key,value)}
        <li><a href="{@value->href}" target="_blank">{@value->title}<span>[{@value->attr}]</span></a></li>
        {/foreach}
        {/if}
      </ul>
    </div>
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


<div style="float: left;margin-top: 15px;">
<div class="rec">
  <h4><a href="library.php?kid=0" target="_blank">查看更多&gt&gt</a>分类推荐</h4>
  <div class="list">
    {if $SixKind}
    {foreach $SixKind(key,value)}
    <div class="nav">
      <h2>{@value->name}</h2>
      <a class="more" href="library.php?kid={@value->id}" target="_blank">查看更多&gt&gt</a>
      <div style="height: 20px;margin-top: 20px;"></div>
      <a href="book.php?id={@value->bid}" class="recpic" target="_blank"><img src="{@value->surface}"></a>
      <h3><a href="book.php?id={@value->bid}" target="_blank">{@value->bname1}</a></h3>
      <p>作者：<a href="###" title="{@value->pseudonym}">{@value->pseudonyms}</a></p>
      <p class="info">
        <a href="book.php?id={@value->bid}" target="_blank" title="{@value->info}">{@value->infos}</a>
      </p>
      <ul>
        {iff @value->next}
        {for @value->next(key,value)}
        <li>
        <a href="book.php?id={@value->bid}" title="{@value->bname}" target="_blank">{@value->bnames}
          <span>[{@value->kname}]</span>
        </a>
        </li>
        {/for}
        {/iff}
      </ul>
    </div>
    {/foreach}
    {/if}
  </div>
</div>

<div class="rank ">
  <h2>用户订阅榜</h2>
  <ul>
    {if $rack}
    {foreach $rack(key,value)}
    <li>
    <a href="book.php?id={@value->id}" target="_blank">{@value->bname}</a>
    <em>{@value->number}</em><span>{@key+1}</span>
    </li>
    {/foreach}
    {/if}
  </ul>
  <div class="more"><a href="rank.php?action=rack" target="_blank">查看更多&gt&gt</a></div>
</div>

<div class="rank ">
  <h2>新书推送榜</h2>
  <ul>
    {if $new}
    {foreach $new(key,value)}
    <li>
    <a href="book.php?id={@value->id}" target="_blank">{@value->bname}</a>
    <em>{@value->click}</em><span>{@key+1}</span>
    </li>
    {/foreach}
    {/if}
  </ul>
  <div class="more"><a href="rank.php?action=new" target="_blank">查看更多&gt&gt</a></div>
</div>
</div>


<div class="upd">
  <h4>最近更新</h4>
  <div class="header">
    <span class="kind">类别</span>
    <span class="book">书名/章节</span>
    <span class="author">作者</span>
    <span class="time">更新时间</span>
  </div>
  <ul>
    {if $AllBook}
    {foreach $AllBook(key,value)}
    <li>
    <span class="kind">
      <a href="search.php?type=kind&key={@value->kname}" target="_blank">[{@value->kname}]</a>
    </span>
     <span class="book">
        <a class="article" href="book.php?id={@value->id}" target="_blank">{@value->bname}</a>
        <a class="title" href="section.php?id={@value->sid}" title="{@value->vname}　{@value->titlel}" target="_blank">
        {@value->vname}　{@value->title}
        </a>
      </span>
      <span class="author">
        <a href="search.php?type=author&key={@value->pseudonym}" title="{@value->pseudonym}" target="_blank">{@value->pseudonyms}</a>
      </span>
      <span class="time" title="{@value->timel}">{@value->times}</span>
    {/foreach}
    {/if}
    </li>
  </ul>

  <div class="bott"><a href="library.php?kid=0" target="_blank">查看更多&gt&gt</a></div>
</div>

{include file='footer.tpl'}

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/basic.js"></script>
<script src="js/index.js"></script>
</body>
</html>
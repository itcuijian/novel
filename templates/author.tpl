<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-cn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>作者专区</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/author.css" />
  <link href="uploadify/uploadify.css" type="text/css" rel="stylesheet" />

</head>
<body id="author">

<div class="left">
	<div class="logo"><img src="images/aut.png"></div>
	<ul id="ul1">
		<li><a href="author.php?action=add">新增作品</a></li>
		<li class="active"><a href="author.php?action=manage">管理作品</a></li>
	</ul>
</div>

<div class="top">
	<div class="out">
	<a href="library.php?kid=0" target="_blank">书库</a>
	<a href="bbs.php?action=show" target="_blank">论坛</a>
	</div>
	<p>欢迎您，{$pseudonym} [<a href="author.php?action=logout"> 退出 </a>]</p>
</div>

<div class="right">
	{if $add}
	<div class="add">
		<span>作者专区&gt;&gt;新增作品</span>
		<form method="post" action="author.php?action=add">
		<ul>
			<li><label>作品书名：</label><input name="name" class="text" type="text"/>
				<span>（* 请不要在书名里加任何书名号、引号等标点符号）</span>
			</li>
			<li><label>作品类别：</label><select name="kid">
					<option value="">请选择类别{$kind}</option>
				</select>
				<span>（* 一经选定，不能再更改）</span>
			</li>
			<li><label>关键字：</label>
				<input type="checkbox" name="keyword[]" value="热血" /><strong>热血</strong>
				<input type="checkbox" name="keyword[]" value="爽文" /><strong>爽文</strong>
				<input type="checkbox" name="keyword[]" value="穿越" /><strong>穿越</strong>
				<input type="checkbox" name="keyword[]" value="都市" /><strong>都市</strong>
				<input type="checkbox" name="keyword[]" value="重生" /><strong>重生</strong>
				<input type="checkbox" name="keyword[]" value="网游" /><strong>网游</strong>
				<input type="checkbox" name="keyword[]" value="后宫" /><strong>后宫</strong>
				<input type="checkbox" name="keyword[]" value="官场" /><strong>官场</strong>
				<input type="checkbox" name="keyword[]" value="推理" /><strong>推理</strong>
				<input type="checkbox" name="keyword[]" value="末世" /><strong>末世</strong>
				<input type="checkbox" name="keyword[]" value="异世" /><strong>异世</strong>
				<input type="checkbox" name="keyword[]" value="同人" /><strong>同人</strong>
			</li>
			<li><label>首发状态：</label><select name="publish">
					<option value="本站首发">本站首发</option>
					<option value="他站首发">他站首发</option>
				</select>
				<span>（* 一经选定，不能再更改）</span>
			</li>
			<li><label>内容简介：</label><textarea name="info" id="area" rows="7" cols="60"></textarea>
				<span>（* 请不要超过400字，是内容简介，不是章节内容，千万别传章节上去）</span>
			</li>
			<li><input type="submit" onclick="subclick()" value="提交" class="submit" name="send" /></li>
			<li class="notice">
				<strong>说明：</strong>
				<p>1、书名长度限12字符以下。<br/>
				2、本功能仅用于增加你的新作品，旧作品的上传章节和管理请点击左栏“管理作品”然后按功能修改即可。<br/>3、作品名字应与内容相符，不具有文学性、故意夸大其词的广告性、政治性、恶搞性或淫亵性作品名将会被删除。<br/>4、上传的作品内容必须与符合本站收录标准，不符合收录标准的作品将被禁阅或删除。<br/>5、本站有权将该作品推荐给合作伙伴宣传或转载，以便为作者寻找更多带来收益的机会，不另行专门告知。
				</p>
			</li>
		</ul>
		</form>
	</div>
	{/if}

	{if $manage}
	<span>作者专区&gt;&gt;管理作品</span>
	<table class="manage">
		<tr class="top"><th>编号</th><th>书名</th><th>最近更新章节</th><th>最后更新时间</th><th>点击量</th><th>状态</th><th>选择</th></tr>
		{if $AllBookOfAuthor}
		{foreach $AllBookOfAuthor(key,value)}
			<tr>
				<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
				<td>{@value->name}</td>
				<td>{@value->section}</td>
				<td>{@value->time}</td>
				<td>{@value->click}</td>
				<td>{@value->state}</td>
				<td>[ <a href="author.php?action=update&id={@value->id}">操作作品</a> ] | [ <a href="author.php?action=delete&id={@value->id}" onclick="return confirm('确定删除？')?true:false">删除作品</a> ]</td>
				
			</tr>
		{/foreach}
		{else}
		<tr><td colspan="7">对不起，没有任何作品，请先<a href="author.php?action=add">添加作品</a>。</td>
		</tr>
		{/if}
	</table>

	<div class="page">
		{$page}
	</div>
	{/if}


	{if $update}
	<ul class="navs">
		<li class="active"><a href="author.php?action=update&id={$id}">修改作品</a></li>
		<li><a href="author.php?action=surface&id={$id}">修改封面</a></li>
		<li><a href="author.php?action=volume&id={$id}">管理分卷</a></li>
		<li><a href="author.php?action=section&id={$id}">管理章节</a></li>
		<li><a href="author.php?action=addsection&id={$id}">新建章节</a></li>
	</ul>
	<div class="cols"></div>
	<div class="add">
		<span style="display: block;margin-top: 10px;">作者专区&gt;&gt;管理作品&gt;&gt;修改作品</span>
		<form method="post">
		<input type="hidden" id="keyword" value="{$keyword}" />
		<ul>
			<li><label>作品书名：</label><input name="name" value="{$name}" class="text" type="text"/>
				<span>（* 请不要在书名里加任何书名号、引号等标点符号）</span>
			</li>
			<li><label>作品类别：</label><select onmousedown="return false" name="kid">
					<option value="">请选择类别{$kind}</option>
				</select>
			</li>
			<li id="ch"><label>关键字：</label>
				<input type="checkbox" name="keyword[]" value="热血" /><strong>热血</strong>
				<input type="checkbox" name="keyword[]" value="爽文" /><strong>爽文</strong>
				<input type="checkbox" name="keyword[]" value="穿越" /><strong>穿越</strong>
				<input type="checkbox" name="keyword[]" value="都市" /><strong>都市</strong>
				<input type="checkbox" name="keyword[]" value="重生" /><strong>重生</strong>
				<input type="checkbox" name="keyword[]" value="网游" /><strong>网游</strong>
				<input type="checkbox" name="keyword[]" value="后宫" /><strong>后宫</strong>
				<input type="checkbox" name="keyword[]" value="官场" /><strong>官场</strong>
				<input type="checkbox" name="keyword[]" value="推理" /><strong>推理</strong>
				<input type="checkbox" name="keyword[]" value="末世" /><strong>末世</strong>
				<input type="checkbox" name="keyword[]" value="异世" /><strong>异世</strong>
				<input type="checkbox" name="keyword[]" value="同人" /><strong>同人</strong>
			</li>
			<li><label>作品状态：</label>
				{$state}
			</li>
			<li><label>内容简介：</label><textarea name="info" id="area" rows="7" cols="60">{$info}</textarea>
				<span>（* 请不要超过400字，是内容简介，不是章节内容，千万别传章节上去）</span>
			</li>
			<li><input type="submit" value="提交" class="submit" name="send" onclick="subclick()" /></li>
			<li class="notice">
				<strong>说明：</strong>
				<p>1、书名长度限12字符以下。<br/>
				2、本功能仅用于增加你的新作品，旧作品的上传章节和管理请点击左栏“管理作品”然后按功能修改即可。<br/>3、作品名字应与内容相符，不具有文学性、故意夸大其词的广告性、政治性、恶搞性或淫亵性作品名将会被删除。<br/>4、上传的作品内容必须与符合本站收录标准，不符合收录标准的作品将被禁阅或删除。<br/>5、本站有权将该作品推荐给合作伙伴宣传或转载，以便为作者寻找更多带来收益的机会，不另行专门告知。
				</p>
			</li>
		</ul>
		</form>
	</div>
	{/if}


	{if $surface}
	<ul class="navs">
		<li><a href="author.php?action=update&id={$id}">修改作品</a></li>
		<li class="active"><a href="author.php?action=surface&id={$id}">修改封面</a></li>
		<li><a href="author.php?action=volume&id={$id}">管理分卷</a></li>
		<li><a href="author.php?action=section&id={$id}">管理章节</a></li>
		<li><a href="author.php?action=addsection&id={$id}">新建章节</a></li>
	</ul>
	<div class="cols"></div>
	<span style="display: block;margin-top: 10px;">作者专区&gt;&gt;管理作品&gt;&gt;修改封面</span>
	<div class="sur">
	<form method="post" action="author.php?action=surface&id={$id}">
	<input type="hidden" id="surface" name="surface" />
	<table>
		<tr><td style="vertical-align: top"><label>上传封面：</label></td>
			<td><div><input type="file" id="uploads" /></div></td>
		</tr>
		<tr><td></td><td><span>(*图片尺寸为240*320)</span></td></tr>
		<tr><td></td><td><div class="img"><img id="pic" src="{$surface}"></div></td></tr>
		<tr class="input"><td></td><td><input value="确认上传" name="send" type="submit" /></td></tr>
	</table>
	</form>
	<div class="notice">
		<strong>说明：</strong>
				<p>1、只能上传规格为240*320像素的1MB之内的JPG、PNG或GIF图片。<br/>
				2、禁止上传任何有黄色、暴力、血腥、恐怖、广告宣传或者不适合公众欣赏的封面，一经发现即做禁书处理。<br/>3、作品封面由用户个人制作并上传，基于此产生的法律责任本站不承担连带责任。<br/>
				</p>
	</div>
	</div>
	{/if}


	{if $volume}
	<ul class="navs">
		<li><a href="author.php?action=update&id={$id}">修改作品</a></li>
		<li><a href="author.php?action=surface&id={$id}">修改封面</a></li>
		<li class="active"><a href="author.php?action=volume&id={$id}">管理分卷</a></li>
		<li><a href="author.php?action=section&id={$id}">管理章节</a></li>
		<li><a href="author.php?action=addsection&id={$id}">新建章节</a></li>
	</ul>
	<div class="cols"></div>
	<span style="display: block;margin-top: 10px;">作者专区&gt;&gt;管理作品&gt;&gt;管理分卷</span>
	<div>
		<table class="manage">
			<tr><th>编号</th><th>卷名</th><th>创建时间</th><th>删除</th></tr>
			{if $AllVolume}
			{foreach $AllVolume(key,value)}
			<tr>
				<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
				<td>{@value->name}</td>
				<td>{@value->time}</td>
				<td>[ <a href="author.php?action=volume&id={$id}&type=delete&vid={@value->id}" onclick="return confirm('确定删除？')?true:false">删除</a> ]
				</td>
			</tr>
			{/foreach}
			{else}
			<tr><td colspan="4">对不起，没有任何分卷。</td></tr>
			{/if}
		</table>
		<div class="page">
			{$page}
		</div>
	</div>

	<div class="inside">
		<h3>添加分卷</h3>
		<form method="post" action="author.php?action=volume&id={$id}&type=add">
		<ul>
			<li><label>输入添加的分卷名字：</label><input name="addname" type="text"/>
				<span>(*分卷名字20字符之内)</span></li>
			<li><input type="submit" name="send" value="提交" class="submit" /></li>
		</ul>
		</form>
	</div>
	<div class="inside">
		<h3>修改分卷</h3>
		<form  method="post" action="author.php?action=volume&id={$id}&type=update">
		<ul>			
			<li><label>选择要修改的分卷：</label><select name="id">
				{if $AllVolume}
				{foreach $AllVolume(key,value)}
				<option value="{@value->id}">{@value->name}</option>
				{/foreach}
				{/if}
			</select></li>
			<li><label>修改分卷名为：</label><input name="updatename" type="text"/>
				<span>(*分卷名字20字符之内)</span></li>
			<li><input type="submit" name="send" value="提交" class="submit" /></li>
			</ul>
		</form>
	</div>
	{/if}


	{if $section}
	<ul class="navs">
		<li><a href="author.php?action=update&id={$id}">修改作品</a></li>
		<li><a href="author.php?action=surface&id={$id}">修改封面</a></li>
		<li><a href="author.php?action=volume&id={$id}">管理分卷</a></li>
		<li class="active"><a href="author.php?action=section&id={$id}">管理章节</a></li>
		<li><a href="author.php?action=addsection&id={$id}">新建章节</a></li>
	</ul>
	<div class="cols"></div>
	<span style="display: block;margin-top: 10px;">作者专区&gt;&gt;管理作品&gt;&gt;管理章节</span>
	<div>
		<table class="manage">
			<tr><th>编号</th><th>章节名称</th><th>字数</th><th>所属分卷</th><th>状态</th><th>更新时间</th><th>删除</th></tr>
			{if $AllSection}
				{foreach $AllSection(key,value)}
				<tr>
					<td><script type="text/javascript">document.write({@key+1}+{$num})</script></td>
					<td>{@value->title}</td>
					<td>{@value->count}</td>
					<td>{@value->name}</td>
					<td>{@value->state}</td>
					<td>{@value->time}</td>
					<td>[ <a href="author.php?action=section&id={$id}&type=update&sid={@value->id}">修改</a> ] | [ <a href="author.php?action=section&id={$id}&type=delete&sid={@value->id}" onclick="return confirm('确定删除？')?true:false">删除</a> ]
					</td>
				</tr>
				{/foreach}
				{else}
				<tr>
					<td colspan="7">对不起，没有任何章节，请先<a href="author.php?action=addsection&id={$id}">添加章节</a>。
					</td>
				</tr>
			{/if}
		</table>
		<div class="page">
			{$page}
		</div>
	</div>
	{/if}


	{if $updatesection}
	<ul class="navs">
		<li><a href="author.php?action=update&id={$id}">修改作品</a></li>
		<li><a href="author.php?action=surface&id={$id}">修改封面</a></li>
		<li><a href="author.php?action=volume&id={$id}">管理分卷</a></li>
		<li class="active"><a href="author.php?action=section&id={$id}">管理章节</a></li>
		<li><a href="author.php?action=addsection&id={$id}">新建章节</a></li>
	</ul>
	<div class="cols"></div>
	<span style="display: block;margin-top: 10px;">作者专区&gt;&gt;管理作品&gt;&gt;修改章节</span>
	<div class="section">
	<form method="post" action="author.php?action=section&id={$id}&type=update&sid={$sid}">
	<input type="hidden" name="count" id="count" value="{$count}" />
	<input type="hidden" id="vol" value="{$vid}" />
		<table>
			<tr><td><label>选择分卷：</label></td>
				<td><select id="vid" name="vid">
					{if $volumes}
					{foreach $volumes(key,value)}
					<option value="{@value->id}">{@value->name}</option>
					{/foreach}
					{else}
					<option value="">没有分卷，请先添加</option>
					{/if}
				</select><span>（*请选择本章归入的分卷）</span>
			</td>
			</tr>
			<tr><td><label>章节属性：</label></td>
				<td><input type="radio" name="attr" checked="checked" value="0" />连载章节
					<input type="radio" name="attr" value="1" />完结章节
				</td>
			</tr>
			<tr><td><label>输入章节名：</label></td>
				<td>
					<input value="{$title}" class="text" name="name" type="text"/>
					<span>（*请不要写入卷名，按规范输入标题，例：第一章 荒山奇遇 （章 也可以用 节、话、回 代替）</span>
				</td>
			</tr>
			<tr ><td><label>章节内容：</label></td>
				<td>
					<div><textarea id="text1" name="content" class="ckeditor">{$content}</textarea>
					</div>
				</td>
			</tr>
			<tr><td></td>
				<td><span>当前字数：<span id="charcount">{$count}</span></span>
							 <span>(*单个章节字数请控制在5万字以内)</span>
				</td>
			</tr>
			<tr><td></td>
				<td><input type="submit" name="send" value="修改章节" class="submit" /></td>
			</tr>
			<tr>
				<td><td>[ <a href="author.php?action=section&id={$id}">返回管理章节页面</a> ]</td></td>
			</tr>
		</tabel>
	</form>
	</div>
	{/if}
	

	{if $addsection}
	<ul class="navs">
		<li><a href="author.php?action=update&id={$id}">修改作品</a></li>
		<li><a href="author.php?action=surface&id={$id}">修改封面</a></li>
		<li><a href="author.php?action=volume&id={$id}">管理分卷</a></li>
		<li><a href="author.php?action=section&id={$id}">管理章节</a></li>
		<li class="active"><a href="author.php?action=addsection&id={$id}">新建章节</a></li>
	</ul>
	<div class="cols"></div>
	<span style="display: block;margin-top: 10px;">作者专区&gt;&gt;管理作品&gt;&gt;新建章节</span>
	<div class="section">
	<form method="post" action="author.php?action=addsection&id={$id}">
	<input type="hidden" name="count" id="count" />
		<table>
			<tr><td><label>选择分卷：</label></td>
				<td><select name="vid">
					{if $volumes}
					<option value="" selected="selected">请选择分卷</option>
					{foreach $volumes(key,value)}
					<option value="{@value->id}">{@value->name}</option>
					{/foreach}
					{else}
					<option value="">没有分卷，请先添加</option>
					{/if}
				</select><span>（*请选择本章归入的分卷）</span>
			</td>
			</tr>
			<tr><td><label>章节属性：</label></td>
				<td><input type="radio" name="attr" checked="checked" value="0" />连载章节
					<input type="radio" name="attr" value="1" />完结章节
				</td>
			</tr>
			<tr><td><label>输入章节名：</label><td><input class="text" name="name" type="text"/>
					<span>（*请不要写入卷名，按规范输入标题，例：第一章 荒山奇遇 （章 也可以用 节、话、回 代替））</span>
				</td>
			</tr>
			<tr ><td><label>章节内容：</label></td>
				<td>
					<div><textarea id="text1" name="content" class="ckeditor"></textarea>
					</div>
				</td>
			</tr>
			<tr><td></td>
				<td><span>当前字数：<span id="charcount"></span></span>
							 <span>(*单个章节字数请控制在5万字以内)</span>
				</td>
			</tr>
			<tr><td></td>
				<td><input type="submit" name="send" value="上传章节" class="submit" /></td>
			</tr>
		</tabel>
	</form>
	</div>
	{/if}
</div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="ckeditor/ckeditor.js"></script> 
  <script src="js/author.js"></script>
  <script src="uploadify/jquery.uploadify.min.js"></script>
  
</body>
</html>
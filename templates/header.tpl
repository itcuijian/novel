<nav class="nav">
   <div class="in">

    <div class="home">
      <a href="./">
        <img src="./images/home.png">
      </a>
    </div>

     
        <div class="search">
          <form method="get" action="search.php" target="_blank">
              <select name="type">
              <option value="all">综　合</option>
              <option value="book">书　名</option>
              <option value="author">作　者</option>
              <option value="keyword">关键字</option>
              </select>
              <span class="glyphicon glyphicon-menu-down down"></span>
              <input type="text" class="text" placeholder="请输入要搜索的内容..." name="key">
              <input type="submit" name="send" class="submit" value="搜索" />
           </form>
        </div>

        <ul class="user">
          {if $login}
          <li id="userf" ><img class="face" src="{$face}" /></li>
          <li class="rack"><div>
                <a href="reader.php?action=book" target="_blank" title="书架" ><img src="images/bookshop.png"></a>
              </div>
          </li>
          {else}
          <li><a href="javascript:" class="denglu" >登录</a></li>        
          <li><a href="register.php?type=reader" >注册</a></li>
          {/if}
        </ul>
     
        <div id="userinfo" class="uinfo">
        {if $login}
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
          {/if}
        </div>

  </div>
</nav>


<p><a href="./"><img src="images/nav.png" class="nav"></a></p>

<ul class="nav navbar-nav navul">
  <li role="nav nav-pills"><a href="./">首页</a></li>
  <li role="nav nav-pills"><a href="library.php?kid=0">书库</a></li>
  <li role="nav nav-pills"><a href="rank.php?action=click">排行榜</a></li>
  <li role="nav nav-pills"><a href="authorr.php?type=author&action=login" target="_blank">作者专区</a></li>
  <li role="nav nav-pills"><a href="reader.php?action=book" target="_blank">个人中心</a></li>
  <li role="nav nav-pills"><a href="bbs.php?action=show" target="_blank">论坛</a></li>
</ul>

<ul class="nav navbar-nav smallnavul">
  <li role="nav nav-pills"><a href="library.php?kid=1">奇幻·玄幻</a></li>
  <li role="nav nav-pills"><a href="library.php?kid=2">武侠·仙侠</a></li>
  <li role="nav nav-pills"><a href="library.php?kid=3">历史·军事</a></li>
  <li role="nav nav-pills"><a href="library.php?kid=4">都市·娱乐</a></li>
  <li role="nav nav-pills"><a href="library.php?kid=7">竞技·同人</a></li>
  <li role="nav nav-pills"><a href="library.php?kid=5">科幻·游戏</a></li>
  <li role="nav nav-pills"><a href="library.php?kid=6">悬疑·灵异</a></li>
</ul>


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


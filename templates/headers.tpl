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
     
        {if $login}
        <div id="userinfo" class="uinfo">
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
        {/if}
    </div>
</nav>


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
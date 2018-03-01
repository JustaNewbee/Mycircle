<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录页面-MyCircle</title>
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <link href="/mycircle/Public/CSS/signup-style.css" rel="stylesheet" type="text/css" media="all">
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script>
        var MODULE = "/mycircle/index.php/Home";
    </script>
    <script src="/mycircle/Public/js/signup.js"></script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
</head>
<body>
    <div class="main-body">
      <header>
          <div class="nav_container bg">
              <div class="nav-menu fl">
                  <a href="/mycircle/index.php/Home" class="fl">
                      <img src="/mycircle/Public/img/logo.png" class="logo">
                  </a>
                  <ul class="nav-menu-list fl">
                      <li><a href="/mycircle/index.php/Home">首页</a></li>
                      <li><a href="/mycircle/index.php/Home/Circle">兴趣圈</a></li>
                      <li class="li-bottom"></li>
                  </ul>
              </div>
              <div class="search-field">
                  <form>
                      <input type="search"  class="search" name="search"  maxlength="20"/>
                      <button type="submit" class="glyphicon glyphicon-search" name="searchSubmit"></button>
                  </form>
              </div>
              <div class="fr nav-user">
                  <div class="fl user-status">
                      <ul>
                          <li>
                              <a href="#">
                                  <div class="top-face face fl">
                                      <img src="/mycircle/Public/img/akari.jpg" class="img-face" alt="头像">
                                  </div>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </header>
        <div class="form-container">
            <nav>
                <ul>
                    <li><a href="login.html">登录</a></li>
                    <li><a href="register.html">注册</a></li>
                </ul>
            </nav>
            <form class="user-login">
                <div class="input-group">
                    <label  for="inputUsername">
                        <span>用户名</span>
                    </label>
                    <input type="text" class="form-control" id="inputUsername" placeholder="请输入用户名"  name="username" required>
                </div>
                <div class="input-group">
                    <label  for="inputPassword">
                        <span>密码</span>
                    </label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="请输入密码"  name="password" required>
                </div>
                <input id="btn-login" class="user-btn  btn " type="submit" value="登陆">
            </form>
        </div>
    </div>
</body>
    <script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>

</html>
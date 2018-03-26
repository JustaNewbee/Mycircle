<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录页面</title>
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <link href="/mycircle/Public/CSS/signup-style.css" rel="stylesheet" type="text/css" media="all">
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script>
        var MODULE = "/mycircle";
    </script>
    <script src="/mycircle/Public/js/signup.js"></script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
</head>
<body>
    <div class="main-body">
        <header>
    <div class="nav_container bg">
        <div class="nav-menu fl">
            <a href="/mycircle" class="fl">
                <img src="/mycircle/Public/img/logo.png" class="logo">
            </a>
            <ul class="nav-menu-list fl">
                <li><a href="/mycircle">首页</a></li>
                <li><a href="/mycircle/Circle">兴趣圈</a></li>
                <li class="li-bottom"></li>
            </ul>
        </div>
        <div class="search-field">
            <form>
                <input type="search"  class="search" name="search"  maxlength="20"/>
                <a class="glyphicon glyphicon-search" name="searchSubmit"></a>
            </form>
        </div>
        <div class="fr nav-user">
            <div class="fl user-status">
                <ul class="user-status-list">
                    <li>
                        <a href="#">
                            <div class="top-face face fl">
                                <img src="/mycircle/Public/img/akari.jpg" class="img-face" alt="头像">
                            </div>
                        </a>
                        <ul class="user-dropdown-menu">

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
        <div class="form-container">
            <nav>
                <ul>
                    <li><a href="/mycircle/Account/login">登录</a></li>
                    <li><a href="/mycircle/Account/register">注册</a></li>
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
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</body>
    <script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>

</html>
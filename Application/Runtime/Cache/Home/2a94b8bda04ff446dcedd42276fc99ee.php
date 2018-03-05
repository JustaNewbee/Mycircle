<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" >
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
    <script>
        var MODULE="/mycircle/index.php/Home";
        var PUBLIC="/mycircle/Public";
    </script>
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
    <div class="container">
        <aside class="fr sidebar">
            <aside class="bg user-login-window">
                <form class="user-login">
                    <div class="input">
					    <input class="input-field" type="text" id="inputUsername" />
                        <label class="input-label"  for="inputUsername">
                            <span>用户名</span>
                        </label>
                    </div>
                    <div class="input">
                        <input class="input-field" type="password" id="inputPassword" />
                        <label class="input-label"  for="inputPassword">
                            <span>密码</span>
                        </label>
                    </div>
                    <div>
                        <a href="/mycircle/index.php/Home/account/register">立即注册</a>
                        <a href="#" style="margin-left: 198px">忘记密码?</a>
                    </div>
                    <input id="btn-login" class="user-btn  btn" type="submit" value="快速登陆">
                </form>
            </aside >
            <aside  class="user bg">
                <div class="face side-face">
                    <img src="/mycircle/Public/img/akari.jpg" class="img-face">
                </div>
                <p class="welcome">欢迎你！<?php echo ($username); ?>~</p>
                <div class="user-menu">
                    <p>我加入的：</p>
                    <ul class="user-menu-circle"></ul>
                    <p class="cr">我写的：</p>
                    <ul class="user-menu-article"></ul>
                </div>
            </aside>
            <aside class="bg rank">
                排行榜
            </aside>
        </aside>
        <div class="article-list"></div>
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
</div>
</body>
    <script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/mycircle/Public/js/index.js"></script>

</html>
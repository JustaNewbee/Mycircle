<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册页面</title>
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
    <header >
        <div class="nav_container bg">
            <div class="nav-menu fl">
                <img src="/mycircle/Public/img/logo.png" class="logo fl">
                <ul class="nav-menu-list fl">
                    <li><a href="/mycircle">首页</a></li>
                    <li><a href="/mycircle/Circle">兴趣圈</a></li>
                    <li class="li-bottom"></li>
                </ul>
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
            <form class="user-signup">
                <label for="inputUsername">
                    <span>昵称</span>
                </label>
                <div class="group  has-feedback">
                    <input type="text" class="form-control" id="inputUsername" placeholder="昵称"  name="username" required>
                </div>
                <label for="inputPassword">
                    <span>密码</span>
                </label>
                <div class="group has-feedback">
                    <input type="password" class="form-control" id="inputPassword" placeholder="密码不少于6位"  name="password" required>
                </div>
                <label for="inputPassword2">
                    <span>重复密码</span>
                </label>
                <div class="group has-feedback">
                    <input type="password" class="form-control" id="inputPassword2" placeholder="确认密码"  name="password2" required>
                </div>
                <label for="inputMail">
                    <span>邮箱</span>
                </label>
                <div class="group has-feedback">
                    <input type="text" class="form-control" id="inputMail" placeholder="邮箱"  name="mail" required>
                </div>
                <div class="group">
                    <input id="btn-signup" class="btn user-btn" type="button" value="点击注册">
                </div>
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
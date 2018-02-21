<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=2.0, user-scalable=no" />
    <link href="/interest/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/interest/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <script src="/interest/Public/js/jquery-3.2.1.js"></script>
    <script src="/interest/Public/js/my_circle.js"></script>
    <script>
        var MODULE ="/interest/index.php/Home";
        var PUBLIC ="/interest/Public";
        $(function () {
            $.ajax({
                type:"post",
                url:"/interest/index.php/Home/Account/check_login",
                success:function(confirm){
                    if(confirm){
                        $(".circle-user").show();
                    }
                },error:function () {
                    alert("error");
                }
            });
        })
    </script>

</head>
<body>
<div class="main-body">
    <header>
        <div class="nav_container bg">
            <div class="nav-menu fl">
                <img src="/interest/Public/img/logo.png" class="logo fl">
                <ul class="nav-menu-list fl">
                    <li><a href="/interest/index.php/Home">首页</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index">兴趣圈</a></li>
                    <!--<li>我的文章</li>-->
                    <!--<li>我的收藏</li>-->
                    <li class="li-bottom"></li>
                </ul>
            </div>
            <div class="fr nav-user">
                <div class="fl user-status">
                    <ul>
                        <li><a href="#">
                            <div class="top-face face fl">
                                <img src="/interest/Public/img/akari.jpg" class="img-face" alt="头像">
                            </div>
                        </a></li>
                        <li><a href="#">登录</a></li>
                        <li><a href="#">注册</a></li>
                    </ul>
                </div>
                <!--<div class="test bg">-->
                <!--123333-->
                <!--</div>-->
            </div>

        </div>
    </header>
    <div class="container">
        <aside class="sidebar fr">
            <aside class="circle-user bg">
                用户模块
            </aside>
            <aside class="bg rank">
                兴趣圈排行
            </aside>
        </aside>
        <div class="circle-container">
            <nav class="circle-nav">
                <ul>
                    <li><a href="/interest/index.php/Home/Circle/circle_index">推荐</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index/?category=1">动漫</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index/?category=2">电影</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index/?category=3">游戏</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index/?category=4">文学</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index/?category=5">生活</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index/?category=6">音乐</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index/?category=7">科技</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index/?category=8">动物</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index/?category=9">电脑数码</a></li>
                    <li><a href="/interest/index.php/Home/Circle/circle_index/?category=10">其它</a></li>
                </ul>
            </nav>
            <div class="circle-display"></div>
        </div>
    </div>
</div>
</body>
    <script src="/interest/Public/bootstrap/js/bootstrap.min.js"></script>

</html>
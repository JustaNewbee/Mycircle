<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=2.0, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
    <script>
        var MODULE ="/mycircle/index.php/Home";
        var PUBLIC ="/mycircle/Public";
    </script>
</head>
<body>
<div class="main-body">
    <header>
        <div class="nav_container bg">
            <div class="nav-menu fl">
                <img src="/mycircle/Public/img/logo.png" class="logo fl">
                <ul class="nav-menu-list fl">
                    <li><a href="/mycircle/index.php/Home">首页</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle">兴趣圈</a></li>
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
                                <img src="/mycircle/Public/img/akari.jpg" class="img-face" alt="头像">
                            </div>
                        </a></li>
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
                    <li><a href="/mycircle/index.php/Home/Circle">推荐</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle/?category=1">动漫</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle/?category=2">电影</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle/?category=3">游戏</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle/?category=4">文学</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle/?category=5">生活</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle/?category=6">音乐</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle/?category=7">科技</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle/?category=8">动物</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle/?category=9">电脑数码</a></li>
                    <li><a href="/mycircle/index.php/Home/Circle/?category=10">其它</a></li>
                </ul>
            </nav>
            <div class="circle-display"></div>
        </div>
    </div>
</div>
</body>
    <script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/mycircle/Public/js/index.js"></script>
    <script>
        getCircleList();
    </script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=2.0, user-scalable=no" />
    <link href="/interest/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/interest/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <script src="/interest/Public/js/jquery-3.2.1.js"></script>
    <script src="/interest/Public/js/my_circle.js"></script>
    <script>
        var MODULE ="/interest/index.php/Home";
        var PUBLIC ="/interest/Public";
    </script>
</head>
<body>
    <div class="main-body">
        <header >
            <div class="nav_container bg">
                <div class="nav-menu fl">
                    <img src="/interest/Public/img/logo.png" class="logo fl">
                    <ul class="nav-menu-list fl">
                        <li><a href="/interest/index.php/Home">首页</a></li>
                        <li><a href="/interest/index.php/Home/Circle">兴趣圈</a></li>
                        <!--<li>我的文章</li>-->
                        <!--<li>我的收藏</li>-->
                        <li class="li-bottom"></li>
                    </ul>
                </div>

                <div class="fr nav-user">
                    <div class="fl user-status">
                        <ul>
                            <li>
                                <a href="#">
                                    <div class="top-face face fl">
                                        <img src="/interest/Public/img/akari.jpg" class="img-face" alt="头像">
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
                <aside class="bg rank">
                    排行榜
                </aside>
            </aside>
            <div class="article-container bg ">
                <div class="bord">
                    <div class="title">
                        <h2><?php echo ($title); ?></h2>
                    </div>
                    <div class="content"><?php echo ($content); ?></div>
                </div>
            </div>
            <div class="comment-container bg">
                <div class="comment">
                    <div class="comment-face face fl">
                        <img src="/interest/Public/img/akari.jpg" class="img-face">
                    </div>
                    <textarea  class="comment-textarea " name="comment" placeholder="测试中" cols="40" rows="3" wrap="hard"></textarea>
                    <input type="button" class="shoot-btn  btn " value="发送">
                </div>
            </div>
        </div>
    </div>
</body>
    <script src="/interest/Public/bootstrap/js/bootstrap.min.js"></script>

</html>
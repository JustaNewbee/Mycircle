<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=2.0, user-scalable=no" />
    <link href="/interest/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/interest/Public/CSS/style.css" rel="stylesheet" type="text/css" media="all">

</head>
<body>
<header class="bg">
    <div class="nav_container">
        <div class="nav-menu fl">
            <img src="/interest/Public/img/logo.png" class="logo fl">
            <ul class="nav-menu-list fl">
                <li>首页</li>
                <li>我的兴趣圈</li>
                <li>我的消息</li>
                <li>我的收藏</li>
                <li class="li-bottom"></li>
            </ul>
        </div>

        <div class="fr nav-user">
            <div class="user_face">
                <img src="/interest/Public/img/default_hp.jpg" class="img-face" alt="头像">
            </div>
            <div class="test bg">
                123333
            </div>
        </div>

    </div>
</header>
<div class="container">
    <div class="article-list fl">
        <div class="article bg">
            <p class="article-title">
                <a href="#">My First Article</a>
            </p>
            <div class="article-content">This is a my first article</div>
        </div>
    </div>
    <aside class="fr sidebar">
        <aside class="user bg">
                <div class="user_face_big">
                    <img src="/interest/Public/img/akari.jpg" class="img-face">
                </div>
                <p class="welcome">欢迎你！巴拉巴拉~</p>
                <div class="user_menu">
                    <ul class="fl">
                        <li>我的关注</li>
                        <li>我的粉丝</li>
                        <li>浏览历史</li>
                    </ul>
                    <div class="cr"></div>
                </div>
        </aside>
        <aside class="bg rank">
            排行榜
        </aside>
    </aside>
</div>
<script src="/interest/Public/js/jquery-3.2.1.js"></script>
<script src="/interest/Public/bootstrap/js/bootstrap.min.js"></script>
<script>
    $.ajax({
        type:"post",
        url:"/interest/index.php/Home/Account/check_login",
        success:function(confirm){
            if(confirm){

            }else{

            }
        },error:function () {
            alert("error");
        }
    });
</script>
</body>
</html>
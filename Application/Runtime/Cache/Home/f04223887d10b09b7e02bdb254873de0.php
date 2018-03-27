<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的兴趣圈-MyCircle</title>
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <link href="/mycircle/Public/CSS/signup-style.css" rel="stylesheet" type="text/css" media="all">
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script>
        var MODULE = "/mycircle";
    </script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
</head>
<body>
<div class="main-body circlepage">
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
    <div class="container">
        <aside class="data-bar">
    <h2>个人中心</h2>
    <nav>
        <ul>
            <li><a href="/mycircle/Account/mydata">我的信息</a></li>
            <li><a href="/mycircle/Account/mycircle">我的兴趣圈</a></li>
            <li><a href="/mycircle/Account/mypost">我的文章</a></li>
            <li><a href="#">设置</a></li>
        </ul>
    </nav>
</aside>
        <div class="wrapper"></div>
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
<script>
    $(function () {
        getCircleList();
    });
    function getCircleList(code,current,page) {
        $.ajax({
            url:MODULE+'/Account/getMyCircle',
            data:{current:current,page:page},
            success:function (data) {
                for(var i=0;i<data.length;i++){
                    circleDisplay($('.wrapper'),data[i]);
                }
            },error:function () {
                alert('get circle error');
            }
        })
    }
    function circleDisplay(obj,data) {
        $model = '<div class="card">\n' +
            '                <img src="'+data['circle_avatar']+'">\n' +
            '                <span class="title">'+data['circle_name']+'</span>\n' +
            '                <span class="intro">'+data['circle_intro']+'</span>\n' +
            '                <span class="divider"></span>\n' +
            '                <a class="quit" href="#">退出</a>\n' +
            '                <a class="edit" href="#">发文</a>\n' +
            '                <a class="detail" href="#">查看</a>\n' +
            '            </div>';
        obj.append($model);
    }
</script>
</html>
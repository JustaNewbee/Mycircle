<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin-MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" >
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
    <script>
        var MODULE="/mycircle";
        var PUBLIC="/mycircle/Public";
    </script>
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
            <form id="#search">
                <input type="search"  class="search" name="search" id="input_search" maxlength="20"/>
                <a class="glyphicon glyphicon-search" name="searchSubmit" id="search-btn"></a>
            </form>
        </div>
        <div class="fr nav-user">
            <div class="fl user-status">
                <ul class="user-status-list">
                    <li>
                        <a class="top-face face fl">
                            <img src="/mycircle/Public/img/akari.jpg" class="img-face" alt="头像">
                        </a>
                        <ul class="user-dropdown-menu"></ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
    <div class="container bg">
        <div class="search-result">
            <h2 class="title">搜索 <span class="key"><?php echo ($key); ?></span> 结果如下：</h2>
            <ul class="result-list circle-article-list"></ul>
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
</div>
</body>
<script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
<script src="/mycircle/Public/js/index.js"></script>
<script>
    $(function () {
        $result = JSON.parse('<?php echo ($result_post); ?>');
        for(var i=0;i<$result.length;i++){
            var $li = '<li>' +
                '<a class="circle-article-title" target="_blank" href="'+MODULE+'/Article/read/'+$result[i]['article_id']+'">'+$result[i]['title']+'</a>\n' +
                '<p class="circle-article-intro">'+$result[i]['content']+'</p>\n' +
                '</li>';
            $(".circle-article-list").append($li);
        }
        $result2 = JSON.parse('<?php echo ($result_circle); ?>');
        for(var i=0;i<$result2.length;i++){
            var $li = '<li>' +
                '<a class="circle-article-title" target="_blank" href="'+MODULE+'/Circle/'+$result2[i]['circle_id']+'">'+$result2[i]['circle_name']+'</a>\n' +
                '<p class="circle-article-intro">'+$result2[i]['circle_intro']+'</p>\n' +
                '</li>';
            $(".circle-article-list").append($li);
        }
    })
</script>
</html>
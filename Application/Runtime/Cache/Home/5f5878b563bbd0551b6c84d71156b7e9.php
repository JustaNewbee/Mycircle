<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" >
    <link href="/mycircle/Public/CSS/pagination.css" rel="stylesheet" type="text/css" >
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
    <script>
        var MODULE="/mycircle";
        var PUBLIC="/mycircle/Public";
    </script>
    <script src="/mycircle/Public/js/jquery.pagination.js"></script>
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
                        <a href="Account/register">立即注册</a>
                        <a href="#" style="margin-left: 198px">忘记密码?</a>
                    </div>
                    <input id="btn-login" class="user-btn  btn" type="submit" value="快速登陆">
                </form>
            </aside >
            <aside  class="user bg">
                <a class="face side-face" href="Account/mydata">
                    <img src="/mycircle/Public/img/akari.jpg" class="img-face">
                </a>
                <p class="welcome"></p>
                <div class="user-menu">
                    <p>最近加的：</p>
                    <ul class="user-menu-circle"></ul>
                    <p>最近写的：</p>
                    <ul class="user-menu-article"></ul>
                </div>
            </aside>
            <aside class="rank bg">
                <p class="banner rank-banner"><span>文章排行</span>
                    <span class="glyphicon glyphicon-refresh refresh"></span></p>
                <ul class="rank-list post"></ul>
            </aside>
        </aside>
        <div class="article-list M-box m-style"></div>
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
<script>
    $(function () {
        var total = '<?php echo ($total); ?>';
        var show =  8;
        total = Math.ceil(total/show);
        $('.M-box').pagination({
            mode: 'fixed',
            showData: show,
            pageCount: total,
            callback: function (api) {
                getRecommendArticleList(api.getCurrent(),show);
            }
        },function (api) {
            getRecommendArticleList(api.getCurrent(),show);
        });
        if(show>='<?php echo ($total); ?>') {
            $('.page-wrapper').remove();
        }
        $('.refresh').click(function(){
            $('.rank-list').empty();
            getTopicList();
        });
    });
</script>
</body>
    <script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/mycircle/Public/js/index.js"></script>
</html>
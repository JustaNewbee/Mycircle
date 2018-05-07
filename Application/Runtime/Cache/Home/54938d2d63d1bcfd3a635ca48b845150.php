<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的信息-MyCircle</title>
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
<div class="main-body settingpage">
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
        <aside class="data-bar">
    <h2>个人中心</h2>
    <nav>
        <ul>
            <li><a href="mydata">我的信息</a></li>
            <li><a href="mycircle">我的兴趣圈</a></li>
            <li><a href="mypost">我的文章</a></li>
            <li><a href="setting">设置</a></li>
        </ul>
    </nav>
</aside>
        <form id="changePassword">
            <h3>更改密码：</h3>
            <input type="password" placeholder="输入旧密码" id="oldPassword" class="form-control">
            <input type="password" placeholder="输入新密码" id="inputPassword" class="form-control">
            <input type="password" placeholder="确认新密码" id="confirmPassword" class="form-control">
            <input type="submit" class="btn btn-changePw" value="更改">
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
<script>
    $(function () {
        $('.data-bar a:eq(3)').addClass('active');
        $('#changePassword').submit(function () {
            if($('#inputPassword').val()!=$('#confirmPassword').val()){
                alert('前后密码不一致');
                return false;
            }
            $.ajax({
                type:"post",
                data:{old_password:$('#oldPassword').val(),password:$("#inputPassword").val()},
                url:MODULE+"/Account/changePassword",
                success:function (msg) {
                    if(msg['head']){
                        alert("更改成功");
                    }else {
                        alert(msg['content']);
                    }
                },
                error:function () {
                    alert("change password fail");
                }
            })
        });
    });

</script>
</body>
<script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>兴趣圈创建-MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=2.0, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script src="/mycircle/Public/js/create_circle.js"></script>
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
    <div class="create-container bg">
        <form class="circle-create">
            <div class="left-form">
                <h1>Circle创建</h1>
                <div class="form-group">
                    <h3>名称：</h3>
                    <input type="text" class="form-control" id="circle_name" name="circle_name">
                </div>
                <div class="form-group">
                    <h3>简介：</h3>
                    <input type="text" class="form-control" id="circle_intro" name="circle_intro">
                </div>
                <div class="form-group circle-class-group">
                    <h3>分类：</h3>
                    <select id="circle_class" class="form-control circle_class">
                        <option selected value="">请选择</option>
                    </select>
                </div>
                <input type="submit" class="btn user-btn">
            </div>
            <div class="form-group right-form">
                <h3>请选择头像：</h3>
                <a id="img-uploader" class="img-uploader"  >
                    <span class="glyphicon glyphicon-upload"></span>
                    <input type="file" id="circle_face" name="photo" >
                    <img id="portrait" src="">
                </a>
                <p class="tip_success">上传成功！</p>
                <p class="tip_fail"></p>
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
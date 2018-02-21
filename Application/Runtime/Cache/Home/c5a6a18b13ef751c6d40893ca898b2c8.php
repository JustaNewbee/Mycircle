<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($name); ?>-MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
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
                        <li><a href="#">
                            <div class="top-face face fl">
                                <img src="/interest/Public/img/akari.jpg" class="img-face" alt="头像">
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
    <div class="container bg">
        <h1>这里是---<?php echo ($name); ?></h1>
        <button type="button" class="btn user-btn" style="width: 200px" id="join">加入</button>
        <button type="button" class="btn user-btn" style="width: 200px" id="write">发表文章</button>
    </div>
</div>

</body>
<script>
    $(function () {
        $(":button").click(function () {
            if(this.id=="join"){
                $.ajax({
                    url:"/interest/index.php/Home/Circle/join/?circle_id=<?php echo ($id); ?>",
                    success:function () {
                        alert("加入成功");
                    },error:function () {
                        alert("error");
                    }
                });
            }
            if(this.id=="write"){
                window.open("/interest/index.php/Home/Article/write/?circle_id=<?php echo ($id); ?>");
            }

        })
    })
</script>
<script src="/interest/Public/bootstrap/js/bootstrap.min.js"></script>
</html>
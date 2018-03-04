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
        <div class="outer-wrapper">
            <div class="circle-header">
                <div class="circle-portrait">
                    <img src="/interest/Public/img/akari.jpg"/>
                </div>
                <div class="circle-wrapper">
                    <h1 class="circle-title"><?php echo ($name); ?></h1>
                    <p class="circle-intro">简介：<?php echo ($intro); ?></p>
                    <span class="glyphicon glyphicon-user circle-people"> <?php echo ($people); ?></span>
                    <span class="glyphicon glyphicon-edit circle-article"> <?php echo ($article); ?></span>
                </div>
            </div>
            <ul class="circle-article-list"></ul>
        </div>
    </div>
        <!--<a  class="btn user-btn" style="width: 200px" id="join">加入</a>-->
        <!--<a  class="btn user-btn" style="width: 200px" id="write">发表文章</a>-->
    </div>
</div>

</body>
<script>
    $(function () {
        $("a.user-btn").click(function () {
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
        });
        $.ajax({
            type:"post",
            dataType:"json",
            data:{circle_id:"<?php echo ($id); ?>"},
            url:"/interest/index.php/Home/Article/article_list",
            success:function (data) {
                for(i = 0;i<data.length;i++){
                    $li = '<li>\n' +
                        '<a class="circle-article-title" href="#">'+data[i]['title']+'</a>\n' +
                        '<p class="circle-article-intro">'+data[i]['content']+'</p>\n' +
                        '</li>';
                    $(".circle-article-list").append($li);
                }
            },error:function () {
                alert("get article list error");
            }
        })
    })
</script>
<script src="/interest/Public/bootstrap/js/bootstrap.min.js"></script>
</html>
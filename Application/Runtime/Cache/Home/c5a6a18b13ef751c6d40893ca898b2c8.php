<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($name); ?>-MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
    <script>
        var MODULE ="/mycircle";
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
                    <li><a href="/mycircle">首页</a></li>
                    <li><a href="/mycircle/Circle">兴趣圈</a></li>
                    <!--<li>我的文章</li>-->
                    <!--<li>我的收藏</li>-->
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
                    <ul>
                        <li><a href="#">
                            <div class="top-face face fl">
                                <img src="/mycircle/Public/img/akari.jpg" class="img-face" alt="头像">
                            </div>
                        </a></li>
                    </ul>
                </div>
            </div>

        </div>
    </header>
    <div class="container bg">
        <div class="outer-wrapper">
            <div class="circle-header">
                <div class="circle-portrait">
                    <img src="/mycircle/Public/img/akari.jpg"/>
                </div>
                <div class="circle-wrapper">
                    <div class="circle-title">
                        <h1><?php echo ($name); ?></h1>
                        <a  class="btn join-btn" id="join">加入</a>
                    </div>
                    <p class="circle-intro">简介：<?php echo ($intro); ?></p>
                    <span class="circle-class">所属分类: <a href="/mycircle/Circle/?category=<?php echo ($category); ?>"><?php echo ($class); ?></a></span>
                    <span class="glyphicon glyphicon-user circle-people"> <?php echo ($people); ?></span>
                    <span class="glyphicon glyphicon-edit circle-article"> <?php echo ($article); ?></span>
                </div>
            </div>
            <div class="article-wrapper">
                <div class="circle-article-nav">
                    <ul>
                        <li><a href="#">全部</a></li>
                    </ul>
                </div>
                <ul class="circle-article-list"></ul>
            </div>
        </div>
    </div>

        <!--<a  class="btn user-btn" style="width: 200px" id="write">发表文章</a>-->
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
<script>
    $(function () {
        $(".btn").click(function () {
            if(this.id=="join"){
                if($(this).hasClass('active')){
                    $.post(MODULE+'/Circle/quit',{circle_id:"<?php echo ($id); ?>"});
                    $(this).text("加入").removeClass('active');
                }else {
                    $.get(MODULE+"/Circle/join",{circle_id:"<?php echo ($id); ?>"});
                    $(this).text("已加入").addClass('active');
                }
            }
            if(this.id=="write"){
                window.open(MODULE+"/Article/write/?circle_id=<?php echo ($id); ?>");
            }
        });
        $.ajax({
            type:"post",
            dataType:"json",
            data:{circle_id:"<?php echo ($id); ?>"},
            url:MODULE+"/Article/article_list",
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
        });
        $.post(MODULE+"/Circle/join_status",{cid:"<?php echo ($id); ?>"},function (data) {
            if(data){
                $("#join").text("已加入").addClass('active');
            }
        })
    })
</script>
<script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
</html>
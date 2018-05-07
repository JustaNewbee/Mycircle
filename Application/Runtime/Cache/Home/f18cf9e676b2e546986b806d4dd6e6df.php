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
<div class="main-body datapage">
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
        <form class="user-data">
            <a id="img-uploader" class="img-uploader"  >
                <span class="glyphicon glyphicon-upload"></span>
                <input type="file" id="avatar" name="avatar" title="点击更换头像">
                <img id="portrait" src="<?php echo ($avatar); ?>">
            </a>
            <p class="tip_success">上传成功！</p>
            <p class="tip_fail"></p>
            <div class="wrapper">
                <div class="inner-wrapper">
                    <div class="form-group">
                        <label for="username">名称:</label>
                        <input class="form-control" id="username" type="text" value="<?php echo ($uname); ?>">
                    </div>
                    <div class="form-group">
                        <label for="intro">简介:</label>
                        <textarea class="form-control" name="intro" id="intro" placeholder="还没有简介"><?php echo ($intro); ?></textarea>
                    </div>
                    <label>性别:</label>
                    <div class="radio-inline sex">
                        <label>
                            <input type="radio" value="UNKNOWN" name="sex">
                            未知
                        </label>
                    </div>
                    <div class="radio-inline sex">
                        <label>
                            <input type="radio" value="BOY" name="sex">
                            汉子
                        </label>
                    </div>
                    <div class="radio-inline sex">
                        <label>
                            <input type="radio" value="GIRL" name="sex">
                            妹子
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="date">生日:</label>
                        <input type="date" class="form-control" id="date" name="date" value="<?php echo ($date); ?>">
                    </div>
                    <input type="submit" class="btn user-btn" value="保存">
                </div>
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
<script>
    $(function () {
        var return_src = $('#portrait').attr('src');
        $('.data-bar a:eq(0)').addClass('active');
        $('.sex input').each(function () {
           if(this.value=='<?php echo ($sex); ?>') {
               $(this).parents(".sex").addClass('active');
                   $(".inner-wrapper .active input").attr('checked','checked');

           }
        });
        $('.sex input').change(function () {
           $(this).parents('.sex').addClass('active').siblings().removeClass('active');
        });
        $(".user-data").submit(function () {
           $.ajax({
               type:'post',
               url:MODULE+"/Account/change_data",
               data:{intro:$('#intro').val(),sex:$('.sex input:checked').val(),date:$('#date').val(),src:return_src},
               success:function (res) {
                   if(res){
                       alert('保存成功');
                       window.location.reload();
                   }
               }
           })
        });
        $("#avatar").change(function () {
            var face = $('#avatar');
            var fd = new FormData();
            face_change(this);
            fd.append('photo',face[0].files[0]);
            $.ajax({
                type:'post',
                url:MODULE+"/Account/upload",
                processData: false,
                contentType: false,
                data: fd,
                success:function (data) {
                    if(data['head']==true){
                        return_src = data['content'];
                        tip_success();
                        setTimeout(tip_success,1500);
                    }else{
                        $(".tip_fail").text(data['content']);
                        $('#portrait').attr('src',return_src);
                        tip_fail();
                        setTimeout(tip_fail,1500);
                    }
                },error:function () {
                    alert('文件上传错误');
                }
            });
        });
    });
</script>
</body>
<script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>

</html>
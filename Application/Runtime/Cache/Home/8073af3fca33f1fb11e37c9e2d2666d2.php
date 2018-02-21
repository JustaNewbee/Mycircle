<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>写文章-<?php echo ($circle_name); ?>-MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
    <link href="/interest/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/interest/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <script src="/interest/Public/js/jquery-3.2.1.js"></script>
    <script src="/interest/Public/ueditor/ueditor.config.js"></script>
    <script src="/interest/Public/ueditor/ueditor.all.js"></script>
    <script>
        $(function () {
            $.ajax({
                type:"post",
                url:"/interest/index.php/Home/Account/check_login",
                success:function(confirm){

                },error:function () {
                    alert("error");
                }
            });
        })
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
                    <li><a href="/interest/index.php/Home/Circle/circle_index">兴趣圈</a></li>
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
                        <!--<li><a href="#">登录</a></li>-->
                        <!--<li><a href="#">注册</a></li>-->
                        <li><input type="button" class="btn btn-write" value="发表"></li>
                    </ul>
                </div>
                <!--<div class="test bg">-->
                <!--123333-->
                <!--</div>-->
            </div>

        </div>
    </header>
    <div class="edit-container bg">
        <div class="edit">
            <a id="img-uploader" class="img-uploader fl"  >
                <span class="glyphicon glyphicon-upload"></span>
                <input type="file" id="upload-btn" name="" >
            </a>
            <h2 class="fl">请在此上传封面</h2>
            <img  id="portrait" >
            <textarea class="edit-textarea" placeholder="请在此输入20字以内的标题" maxlength="20"></textarea>
            <script id="editor" name="content" type="text/plain" ></script>
        </div>
    </div>
</div>
<script>
    document.getElementById('upload-btn').onchange = function() {
        var imgFile = this.files[0];
        var fr = new FileReader();
        fr.onload = function () {
            $("#portrait").attr("src",fr.result);
        };
        fr.onloadstart = function () {
            $("#img-uploader span").removeClass("glyphicon-upload").addClass("glyphicon-option-horizontal");
        };
        fr.readAsDataURL(imgFile);
    }
</script>
<script>
    var ue = UE.getEditor('editor', {
        toolbars: [
            ['fullscreen', 'undo', 'redo', 'forecolor','bold','italic','underline','strikethrough','|','insertorderedlist','insertunorderedlist','blockquote','|','simpleupload','preview','cleardoc']
        ],
        autoHeightEnabled: true,
        autoFloatEnabled: true
    });
    $(".btn-write").click(function () {
        var title = $(".edit-textarea");
        if(title.val()==""){
            alert("请输入标题");
            title.focus();
        }else if(!ue.hasContents()){
            alert("请输入正文内容");
            ue.focus();
        }else{
//            alert(ue.getContent());
            $.ajax({
                type:"post",
                url:"/interest/index.php/Home/Article/article_submit",
                data:{content:ue.getContent(),title:title.val(),circle_name:"<?php echo ($circle_name); ?>"},
                success:function () {
                    alert("发表成功");
                    window.location.reload();
                },error:function () {
                    alert("error");
                }
            })
        }

    })
</script>

</body>
<script src="/interest/Public/bootstrap/js/bootstrap.min.js"></script>
</html>
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
                    <li><a href="/interest/index.php/Home/Circle/">兴趣圈</a></li>

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

                        <li><input type="button" class="btn btn-write" value="发表"></li>
                    </ul>
                </div>

            </div>

        </div>
    </header>
    <div class="edit-container bg">
        <div class="edit">
            <a id="img-uploader" class="img-uploader "  >
                <span class="glyphicon glyphicon-upload"></span>
                <input type="file" id="upload-btn" name="user-portrait" >
                <img  id="portrait" >
            </a>
            <div class="edit-input-field">
                <input type="text" class="form-control edit-input-title" placeholder="请在此输入20字以内的标题" maxlength="20" />
                <input type="text" id="article_class" class="form-control article_class" maxlength="10"/>
                <input type="button" value="+" class="form-control">
            </div>

            <!--<script id="editor" name="content" type="text/plain" ></script>-->
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
    ue.execCommand( 'justify', 'center');
    ue.addListener('afterExecCommand',function(t, e, arg){
        afterUploadImage(e);
    });
    function afterUploadImage() {
        if (arguments[0] == "inserthtml" || arguments[0] == "insertimage") {
            ue.execCommand('insertparagraph');

        }
    }
    $(".btn-write").click(function () {
        var title = $(".edit-textarea");
        if(title.val()==""){
            alert("请输入标题");
            title.focus();
        }else if(!ue.hasContents()){
            alert("请输入正文内容");
            ue.focus();
        }else if(!checkContent(ue.getContent())){
            alert("正文不能为纯图片");
            ue.focus();
        }
        else{
            $.ajax({
                type:"post",
                url:"/interest/index.php/Home/Article/article_submit",
                data:{content:ue.getContent(),title:title.val(),circle_name:"<?php echo ($circle_name); ?>",circle_id:getString("circle_id")},
                success:function () {
                    alert("发表成功");
                    window.location.reload();
                },error:function () {
                    alert("error");
                }
            })
        }
        function checkContent(text) {
            var start = text.indexOf("<p>");
            var end = text.indexOf("</p>");

            while (start!=-1) {
                start = start + 3;
                var txt = text.substring(start, end);
                start = text.indexOf("<p>", end);
                end = text.indexOf("</p>", start);
                if(txt.search("<br/>")!=-1) continue;
                if(txt.search("<img") == -1 && txt.search('"/>') == -1 ){
                    return true;
                }
            }
            //alert(text);
            return false;
        }
    })
</script>

</body>
<script src="/interest/Public/bootstrap/js/bootstrap.min.js"></script>
</html>
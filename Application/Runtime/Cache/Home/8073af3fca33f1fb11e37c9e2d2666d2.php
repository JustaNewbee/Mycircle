<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>写文章-<?php echo ($circle_name); ?>-MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script src="/mycircle/Public/ueditor/ueditor.config.js"></script>
    <script src="/mycircle/Public/ueditor/ueditor.all.js"></script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
    <script>
        var MODULE ="/mycircle";
        var PUBLIC ="/mycircle/Public";
    </script>
</head>
<body>
<div class="main-body">
    <header >
        <div class="nav_container bg">
            <div class="nav-menu fl">
                <img src="/mycircle/Public/img/logo.png" class="logo fl">
                <ul class="nav-menu-list fl">
                    <li><a href="/mycircle">首页</a></li>
                    <li><a href="/mycircle/Circle/">兴趣圈</a></li>

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
                        <li>
                            <a href="#">
                                <div class="top-face face fl">
                                    <img src="/mycircle/Public/img/akari.jpg" class="img-face" alt="头像">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="fr">
                <a class="glyphicon glyphicon-edit btn-write">发布</a>
            </div>
        </div>
    </header>
    <div class="edit-container bg">
        <div class="edit">
          <div class="clearfix">
            <a id="img-uploader" class="img-uploader"  >
                <span class="glyphicon glyphicon-upload"></span>
                <input type="file" id="upload-btn" name="user-portrait" >
                <img  id="portrait" >
            </a>
              <div class="edit-input-field">
                  <input type="text" class="form-control edit-input-title" placeholder="请在此输入20字以内的标题" maxlength="20" />
                  <a  class="add_article_class glyphicon glyphicon-plus"></a>
                  <input type="text" id="article_class" class="article_class" maxlength="10"/>

              </div>
          </div>
            <script id="editor" name="content" type="text/plain" ></script>
        </div>
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
    //上传文章封面
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
    //调用百度UE编辑器
    var ue = UE.getEditor('editor', {
        toolbars: [
            ['fullscreen', 'undo', 'redo', 'forecolor','bold','italic','underline','strikethrough','|','insertorderedlist','insertunorderedlist','blockquote','|','simpleupload','preview','cleardoc']
        ],
        autoHeightEnabled: true,
        autoFloatEnabled: true
    });
    ue.execCommand('justify', 'center');
    ue.addListener('afterExecCommand',function(t, e, arg){
        afterUploadImage(e);
    });
    //插入图片换行
    function afterUploadImage() {
        if (arguments[0] == "inserthtml" || arguments[0] == "insertimage") {
            ue.execCommand('insertparagraph');

        }
    }
    //添加文章标签
    $('.edit-input-field  .add_article_class').click(function(){
        var class_val = $('#article_class').val();
        if(class_val==""){
            $("#article_class").focus();
            return false;
        }
        $label = '<span class="article-label">'+class_val+'</span>';
        $(this).before($label);
        $article_label =$('.edit-input-field  .article-label');
        $("#article_class").val("");
        $article_label.on("click",function(){
            $(this).remove();
            if($('.edit-input-field  .article-label').length<3) {
                $(".edit-input-field .add_article_class").show();
                $(".edit-input-field .article_class").show();
            }
        });
        if($article_label.length>=3) {
            $(this).hide();
            $(".article_class").hide();
        }
    });
    //文章提交验证
    $(".btn-write").click(function () {
        var title = $(".edit-input-title");
        if(title.val()==""){
            alert("请输入标题");
            title.focus();
        }else if($('.edit-input-field .article-label').length==0){
            alert("请给文章添加标签");
            $('.article_class').focus();
        }else if(!ue.hasContents()){
            alert("请输入正文内容");
            ue.focus();
        }else if(!checkContent(ue.getContent())){
            alert("正文不能为纯图片");
            ue.focus();
        }else if(ue.getContentTxt().length<=20){
            alert("正文长度不得小于20个字");
            ue.focus();
        }
        else{
            $.ajax({
                type:"post",
                url:MODULE+"/Article/article_submit",
                data:{content:ue.getContent(),title:title.val(),circle_name:"<?php echo ($circle_name); ?>",circle_id:getString("circle_id"),label:getLabel()},
                success:function (data) {
                    alert("发表成功");
                    window.location.href=data;
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
                if(txt.search("<img") == -1 && txt.search('src=') == -1 ){
                    console.log("OK");
                    return true;
                }
            }
            return false;
        }
        function getLabel(){
            var length = $('.edit-input-field .article-label').length;
            var label = "";
            for(var i = 0;i < length;i++){
                var val = $('.edit-input-field .article-label').eq(i).text();
                val = val + "/";
                label = label + val;
            }
            return label;
        }
    })
</script>

</body>
<script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
</html>
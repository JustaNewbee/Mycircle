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
    <div class="edit-container bg">
        <div class="edit">
          <div class="clearfix">
            <a id="img-uploader" class="img-uploader"  >
                <span class="glyphicon glyphicon-upload"></span>
                <input type="file" id="upload-btn" name="photo" >
                <img id="portrait">
            </a>
              <div class="edit-input-field">
                  <input type="text" class="form-control edit-input-title" placeholder="请在此输入20字以内的标题" maxlength="20"/>
                  <a class="add_article_class glyphicon glyphicon-plus"></a>
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
    $('.nav_container').append('<a class="glyphicon glyphicon-edit btn-write">发布</a>');
</script>
</body>
<script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
<script src="/mycircle/Public/layui/layui.js"></script>
<script>
    var src;
    $(function () {
        if(getString('article_id')){
            $('#portrait').attr('src','<?php echo ($cover); ?>');
            $(".edit-input-title").val('<?php echo ($title); ?>');
            ue.ready(function() {
                ue.setContent('<?php echo ($content); ?>');
            });
            setLabel();
        }
        //上传文章封面
        src = $('#portrait').attr('src');
        $("#upload-btn").change(function () {
            var face = $('#upload-btn');
            var fd = new FormData();
            face_change(this);
            fd.append('photo',face[0].files[0]);
            $.ajax({
                type:'post',
                url:MODULE+"/Article/upload",
                processData: false,
                contentType: false,
                data: fd,
                success:function (data) {
                    if(data['head']==true){
                        src = data['content'];
                        layui.use('layer', function(){
                            var layer = layui.layer;
                            layer.msg('上传成功', {icon: 1,area: '100px'});
                        });
                    }else{
                        layui.use('layer', function(){
                            var layer = layui.layer;
                            layer.msg(data['content'], {icon: 2,area: '230px'});
                        });
                        $("#portrait").attr("src",src);
                    }
                },error:function () {
                    alert('文件上传错误');
                }
            });
        });
        //添加文章标签
        $('.edit-input-field .add_article_class').click(function(){
            var class_val = $('#article_class').val();
            if(class_val==""){
                $("#article_class").focus();
                return false;
            }
            $label = '<span class="article-label">'+class_val+'</span>';
            $(this).before($label);
            addLabel($(this));
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
                if(getString('article_id')){
                    articleSubmit(getString('article_id'),"edit");
                }
                if(getString('circle')){
                    articleSubmit(getString('circle'),'sub');
                }
            }
        })
    });
    //提交文章
    function articleSubmit($id,$action) {
        $.ajax({
            type:"post",
            url:MODULE+"/Article/article_submit",
            data:{content:ue.getContent(),title:$(".edit-input-title").val(),circle_name:"<?php echo ($circle_name); ?>",id:$id,label:getLabel(),action:$action,cover:src},
            success:function (data) {
                alert("发表成功");
                window.location.href=data;
            },error:function () {
                alert("error");
            }
        })
    }
    //设置标签
    function setLabel() {
        var str = '<?php echo ($label); ?>';
        var arr = str.split('/');
        for(var i=0;i<arr.length;i++){
            if(arr[i]!=""){
                $label = '<span class="article-label">'+arr[i]+'</span>';
                $('.edit-input-field .add_article_class').before($label);
            }
        }
        addLabel($('.edit-input-field .add_article_class'));
    }
    //格式化标签
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
    //添加标签
    function addLabel(obj) {
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
            obj.hide();
            $(".article_class").hide();
        }
    }
    //检查文本是否为纯图片
    function checkContent(text) {
        var start = text.indexOf("<p>");
        var end = text.indexOf("</p>");
        while (start!=-1) {
            start = start + 3;
            var txt = text.substring(start, end);
            start = text.indexOf("<p>", end);
            end = text.indexOf("</p>", start);
            if(txt.search("<img") == -1 && txt.search('src=') == -1 ){
                return true;
            }
        }
        return false;
    }
    //插入图片换行
    function afterUploadImage() {
        if (arguments[0] == "inserthtml" || arguments[0] == "insertimage") {
            ue.execCommand('insertparagraph');

        }
    }
</script>
</html>
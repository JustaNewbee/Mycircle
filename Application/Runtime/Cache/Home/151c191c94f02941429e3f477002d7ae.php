<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($name); ?>-管理页面-MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="/mycircle/Public/layui/css/layui.css">
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
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
        <div class="circle-admin">
            <div class="active outer-wrapper">
                <div class="banner">兴趣圈信息管理<p class="icon"></p></div>
                <form class="inner-wrapper bg" id="circle-setting">
                <div class="left-container">
                    <h2 class="title"><?php echo ($name); ?></h2>
                    <label for="intro">简介：</label>
                    <input class="intro form-control" id="intro" type="text" value="<?php echo ($intro); ?>">
                    <label for="notice">发布公告：</label>
                    <textarea class="notice form-control" id="notice"><?php echo ($notice); ?></textarea>
                    <input class="btn btn-alert" type="submit" value="修改">
                </div>
                <div class="right-container">
                    <h3 class="title">修改头像</h3>
                    <a id="img-uploader" class="img-uploader"  >
                        <span class="glyphicon glyphicon-upload"></span>
                        <input type="file" id="avatar" name="avatar" title="点击更换头像">
                        <img id="portrait" src="<?php echo ($avatar); ?>">
                    </a>
                    <p class="tip_success">上传成功！</p>
                    <p class="tip_fail"></p>
                </div>
            </form>
            </div>
            <div class="active outer-wrapper">
                <div class="banner">兴趣圈文章管理<p class="icon"></p></div>
                <div class="inner-wrapper">
                    <table class="post-list" id="post" lay-filter="post">
                    </table>
                    <script type="text/html" id="bar">
                        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                    </script>
                </div>

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
</div>
</body>
<script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
<script src="/mycircle/Public/js/index.js"></script>
<script src="/mycircle/Public/layui/layui.js"></script>
<script>
    var return_src = $('#portrait').attr('src');
    layui.use('table', function(){
        var table = layui.table;
        table.render({
            elem: '#post'
            ,url: MODULE+'/MyAdmin/post' //数据接口
            ,page: true //开启分页
            ,even: true
            ,where: {id:'<?php echo ($id); ?>'}
            ,cols: [[ //表头
                {field: 'article_id', title: 'ID', width:60, sort: true}
                ,{field: 'title', title: '标题', width:120,sort: true}
                ,{field: 'content', title: '内容'}
                ,{field: 'pageview', title: '浏览量', width: 80,sort: true}
                ,{field: 'comment', title: '评论数', width: 80,sort: true}
                ,{field: 'publish_date', title: '发布日期', width:109}
                ,{field: 'circle', title: '所属圈', width: 100}
                ,{field: 'label', title: '标签', width: 100}
                ,{width:140, align:'center', toolbar: '#bar'}
            ]]
        });
        //监听工具条
        table.on('tool(post)', function(obj){
            var data = obj.data;
            //查看
            if(obj.event === 'detail'){
                window.open(MODULE+"/Article/read/"+data.article_id)
            }
            //删除
            else if(obj.event === 'del'){
                layer.confirm('真的要删？', function(index){
                    $.ajax({
                        url:MODULE+"/MyAdmin/admin_del",
                        type:'post',
                        data:{id:data.article_id},
                        success:function (res) {
                            if(res){
                                obj.del();
                                layer.close(index);
                                layer.msg('删除成功',{icon: 1})
                            }
                        },error:function () {
                            layer.alert('删除失败');
                        }
                    })
                });
            }

        });
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
    $("#circle-setting").submit(function () {
        $.ajax({
            type:'post',
            url:MODULE+"/MyAdmin/change_circle",
            data:{id:'<?php echo ($id); ?>',src:return_src,intro:$('#intro').val(),notice:$('#notice').val()},
            success:function (res) {
                if(res){
                    alert('保存成功');
                    window.location.reload();
                }
            }
        })
    });
    $('.icon').click(function () {
        var $outer = $(this).parents(".outer-wrapper");
        $outer.toggleClass('active');
        var $wrapper = $outer.children('.inner-wrapper');
        if($outer.hasClass('active')){
            $wrapper.css('max-height',$(window).height());
        }else {
            $wrapper.css('max-height',0);
        }
    });
</script>
</html>
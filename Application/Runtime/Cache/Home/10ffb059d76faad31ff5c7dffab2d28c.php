<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的文章-MyCircle</title>
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <link href="/mycircle/Public/CSS/signup-style.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="/mycircle/Public/layui/css/layui.css">
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script>
        var MODULE = "/mycircle";
    </script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
</head>
<body>
<div class="main-body postpage">
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
    <div class="container">
        <aside class="data-bar">
    <h2>个人中心</h2>
    <hr>
    <nav>
        <ul>
            <li><a href="/mycircle/Account/mydata">我的信息</a></li>
            <li><a href="/mycircle/Account/mycircle">我的兴趣圈</a></li>
            <li><a href="/mycircle/Account/mypost">我的文章</a></li>
            <li><a href="#">设置</a></li>
        </ul>
    </nav>
</aside>
        <div class="wrapper">
            <table class="post-list" id="post" lay-filter="post">
            </table>
            <script type="text/html" id="bar">
                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
                <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </script>
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
</body>
<script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
<script src="/mycircle/Public/layui/layui.js"></script>
<script>
    $(function () {
        layui.use('table', function(){
            var table = layui.table;
            table.render({
                elem: '#post'
                ,url: MODULE+'/Account/post' //数据接口
                ,page: true //开启分页
                ,even: true
                ,cols: [[ //表头
                    {field: 'article_id', title: 'ID', width:60, sort: true}
                    ,{field: 'title', title: '标题', width:120,sort: true}
                    ,{field: 'content', title: '内容', width:140}
                    ,{field: 'pageview', title: '浏览量', width: 80,sort: true}
                    ,{field: 'comment', title: '评论数', width: 80,sort: true}
                    ,{field: 'publish_date', title: '发布日期', width:109}
                    ,{field: 'circle', title: '所属圈', width: 100}
                    ,{field: 'label', title: '标签', width: 100}
                    ,{width:160, align:'center', toolbar: '#bar'}
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
                            url:MODULE+"/Account/del",
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
//
                    });
                }
                //编辑
                else if(obj.event === 'edit'){
                    window.open(MODULE+"/Article/write?article_id="+data.article_id);
                }
            });
        });

    })
</script>
</html>
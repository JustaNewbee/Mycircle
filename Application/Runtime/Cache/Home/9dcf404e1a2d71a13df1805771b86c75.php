<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin-MyCircle</title>
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
        <div class="check-wrapper active outer-wrapper">
            <div class="banner">新增兴趣圈<p class="icon"></p></div>
            <div class="inner-wrapper">
                <table class="check-list list" id="check" lay-filter="check">
                </table>
                <script type="text/html" id="bar">
                    <a class="layui-btn layui-btn-xs" lay-event="accept">同意</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="reject">拒绝</a>
                </script>
            </div>
        </div>
        <div class="class-wrapper active outer-wrapper">
            <div class="banner">分类管理<p class="icon"></p></div>
            <div class="inner-wrapper">
                <div class="add-wrapper">
                    <input type="text" id="className" class="input-class form-control">
                    <select class="parent-list form-control">
                        <option value="0" selected>无</option>
                    </select>
                    <a class="btn add-class">添加分类</a>
                </div>
                <div class="remove-wrapper">
                    <select class="parent-list form-control"></select>
                    <select class="child-list form-control"></select>
                    <a class="btn delete-class">删除分类</a>
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
    $(function () {
        layui.use('table', function() {
            var table = layui.table;
            table.render({
                elem: '#check'
                , url: MODULE + '/MyAdmin/check_circle' //数据接口
                , page: true //开启分页
                , even: true
                , cols: [[ //表头
                    {field: 'circle_id', title: 'ID', width: 60, sort: true}
                    , {field: 'circle_name', title: '名称', width: 120, sort: true}
                    , {field: 'class_name', title: '分类', width: 120, sort: true}
                    , {field: 'username', title: '创建者', width: 120}
                    , {field: 'circle_intro', title: '简介'}
                    , {width: 140, align: 'center', toolbar: '#bar'}
                ]]
            });
            table.on('tool(check)', function(obj){
                var data = obj.data;
                //同意
                if(obj.event === 'accept'){
                    request(obj,'accept',data.circle_id);
                }
                //拒绝
                else if(obj.event === 'reject'){
                    request(obj,'reject',data.circle_id);
                }
                function request(obj,req,id) {
                    $.post(MODULE + "/MyAdmin/request",{request:req,id:id},function (feedback) {
                        if(feedback=='accept_success'){
                            obj.del();
                            layer.msg('已同意',{icon: 1,time: 1000});
                        }
                        else if(feedback=='reject_success'){
                            obj.del();
                            layer.msg('已拒绝',{icon: 1,time: 1000});
                        }
                        else {
                            layer.msg('error',{icon: 2,time: 2000});
                        }
                    });

                }
            });
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
        init();
        $('.remove-wrapper .parent-list').change(function () {
            var child = $('.child-list');
            $.ajax({
                type: 'post',
                data: {request:"child_class",select_class:this.value},
                url: MODULE + "/MyAdmin/class_admin",
                success:function (data) {
                    if(data.length==0) {
                        child.hide();
                    }else {
                        child.show();
                    }
                    for(var i=0;i<data.length;i++)
                        addOption(child,data[i]);
                },error:function () {
                    alert("get class error")
                }
            })
        });
        $('.add-class').click(function () {
           $.ajax({
               type: 'get',
               url: MODULE + '/MyAdmin/addClass',
               data: {addClass:$('#className').val(),fromClass:$('.add-wrapper .parent-list').val()},
               success:function (feedback) {
                    if(feedback=='success'){
                        layer.msg('添加成功',{icon: 1,time: 1000});
                        window.location.reload();
                    }
               },error:function () {
                   alert("add class error");
               }
           })
        });
        $('.delete-class').click(function () {
            var parent_val = $('.remove-wrapper .parent-list').val();
            var child_val = $('.remove-wrapper .child-list').val();
            var remove;
            if(child_val==null){
                remove = parent_val;
            }else {
                remove = child_val;
            }
           $.ajax({
               type: 'get',
               url: MODULE + '/MyAdmin/removeClass',
               data: {removeClass:remove},
               success:function (feedback) {
                   if(feedback=='success'){
                       layer.msg('删除成功',{icon: 1,time: 1000});
                       window.location.reload();
                   }
               },error:function () {
                   alert('delete class error');
               }
           })
        });
        function init() {
            $.ajax({
                type: 'post',
                url: MODULE + "/MyAdmin/class_admin",
                data: {request:"parent_class"},
                success:function (data) {
                    for(var i=0;i<data.length;i++)
                        addOption($('.parent-list'),data[i]);
                },error:function () {
                    alert("get class error");
                }
            });
        }
        function addOption(obj,data) {
            var $option = '<option ';
            $option += 'value='+data['class_id']+'>';
            $option += data['class_name']+'</option>';
            obj.append($option);
        }
    });
</script>
</html>
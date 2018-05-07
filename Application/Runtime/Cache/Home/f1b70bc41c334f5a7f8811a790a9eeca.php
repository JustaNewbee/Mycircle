<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=2.0, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <link href="/mycircle/Public/CSS/pagination.css" rel="stylesheet" type="text/css" >
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
    <script src="/mycircle/Public/js/jquery.pagination.js"></script>
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
    <div class="container">
        <aside class="sidebar fr">
            <a class="go-to" href="/mycircle/Circle/circle_create" target="_blank">点此创建一个兴趣圈</a>
            <aside class="history bg">
                <p class="banner"><span>最近看过</span></p>
                <ul class="history-list"></ul>
            </aside>
            <aside class="rank bg">
                <p class="banner rank-banner"><span>兴趣圈排行</span>
                    <span class="glyphicon glyphicon-refresh refresh"></span></p>
                <ul class="rank-list circle"></ul>
            </aside>
        </aside>
        <div class="circle-container fl">
            <nav class="circle-nav">
                <ul>
                    <li><a href="/mycircle/Circle">推荐</a></li>
                    <li><a href="/mycircle/Circle/?category=1">动漫</a></li>
                    <li><a href="/mycircle/Circle/?category=2">电影</a></li>
                    <li><a href="/mycircle/Circle/?category=3">游戏</a></li>
                    <li><a href="/mycircle/Circle/?category=4">文学</a></li>
                    <li><a href="/mycircle/Circle/?category=5">生活</a></li>
                    <li><a href="/mycircle/Circle/?category=6">音乐</a></li>
                    <li><a href="/mycircle/Circle/?category=7">科技</a></li>
                    <li><a href="/mycircle/Circle/?category=8">动物</a></li>
                    <li><a href="/mycircle/Circle/?category=9">电脑数码</a></li>
                    <li><a href="/mycircle/Circle/?category=10">其它</a></li>
                </ul>
            </nav>
            <div class="circle-display M-box m-style"></div>
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
    <script src="/mycircle/Public/js/index.js"></script>
    <script>
        $(function () {
            var total = '<?php echo ($total); ?>';
            var show =  10;
            total = Math.ceil(total/show);
            $('.M-box').pagination({
                mode: 'fixed',
                showData: show,
                pageCount: total,
                callback: function (api) {
                    getCircleList(api.getCurrent(),show);
                }
            },function (api) {
                getCircleList(api.getCurrent(),show);
            });
            $('.refresh').click(function(){
                $('.rank-list').empty();
                getTopicCircleList();
            });
            getTopicCircleList();
            history_circle();
            addChildClass();
            if(show>='<?php echo ($total); ?>') {
                $('.page-wrapper').remove();
            }
        });
        function history_circle() {
            var history = '<?php echo ($history_circle); ?>';
            if(history==""){
                var $p = '<p class="tip">最近没有任何访问记录</p>';
                $('.history-list').append($p);
                return;
            }
            history = JSON.parse(history);
            for(var i = history.length-1;i>=0;i--){
                var li = '<li><a href="/mycircle/Circle/'+history[i].id+'">' +
                    ' <div class="circle-avatar">' +
                    '    <img src="'+history[i].avatar+'">' +
                    ' </div>' +
                    ' <p class="circle-name">'+history[i].name+'</p>' +
                    ' <p class="time">'+getMyTime(history[i].time)+'</p>' +
                    '</a></li>';
                $('.history-list').append(li);
            }
        }
        function getMyTime(time) {
            var date = new Date();
            var year =time[5] + 1900;
            var month = time[4] + 1;
            var day = time[3];
            var hour = time[2];
            var minute = time[1];
            var second = time[0];
            if(date.getFullYear()-year>0){
                return date.getFullYear()-year+"年前";
            }
            else if(date.getMonth()+1-month>0){
                return date.getMonth()+1-month+'月前';
            }
            else if(date.getDate()-day>0){
                return date.getDate()-day+'天前';
            }
            else if(date.getHours()-hour>0){
                return date.getHours()-hour+'小时前';
            }
            else if(date.getMinutes()-minute>0){
                return date.getMinutes()-minute+'分钟前';
            }
            else {
                return date.getSeconds()-second+'秒前';
            }
        }
        function addChildClass() {
            var child_class = '<?php echo ($child_class); ?>';
            if(child_class=="")  return;
            child_class = JSON.parse(child_class);
            var $list = '<ul class="circle-nav-child">';
            $list += '<li><a href="?category='+child_class[0]['parent_id']+'">全部</li>';
            for(var i=0;i<child_class.length;i++){
                $list += '<li><a href="?category='+child_class[i]['parent_id']+'&child='+child_class[i]['class_id']+'">'+child_class[i]['class_name']+'</li>';
            }
            $list += '</ul>';
            $('.circle-nav').append($list);
        }
    </script>
</html>
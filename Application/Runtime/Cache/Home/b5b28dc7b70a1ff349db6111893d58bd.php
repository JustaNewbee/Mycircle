<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($title); ?>-MyiCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=2.0, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <link href="/mycircle/Public/CSS/pagination.css" rel="stylesheet" type="text/css" >
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
            <aside class="fr sidebar">
                <aside class="rank more bg">
                    <p class="banner"><span>更多文章</span>
                        <span class="glyphicon glyphicon-refresh refresh"></span></p>
                    <ul class="rank-list more"></ul>
                </aside>
            </aside>
            <div class="article-container bg ">
                <div class="wrapper">
                    <div class="title">
                        <h2><?php echo ($title); ?></h2>
                    </div>
                    <div class="status">
                        <span class="author">作者: <a href="#"><?php echo ($editor); ?></a></span>
                        <span class="date">日期: <?php echo ($date); ?></span>
                    </div>
                    <div class="content"><?php echo ($content); ?></div>
                    <div class="tag"><span>标签:</span></div>
                </div>
            </div>
            <div class="comment-container bg">
                <div class="comment">
                    <div class="comment-face face fl">
                        <img src="/mycircle/Public/img/akari.jpg" class="img-face">
                    </div>
                    <textarea class="comment-textarea" name="comment" placeholder="在此回复" cols="40" rows="3" wrap="hard"></textarea>
                    <input type="button" class="shoot-btn  btn" value="发送">
                </div>
            </div>
            <div class="comment-area">
                <ul class="comment-list M-box m-style"></ul>
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
    <script src="/mycircle/Public/js/jquery.pagination.js"></script>
<script>
    $(function () {
        var str = '<?php echo ($label); ?>';
        var arr = str.split('/');
        var label = '';
        for(var i=0;i<arr.length;i++){
            if(arr[i]!=""){
                label += '<span class="article-label">'+arr[i]+'</span>';
            }
        }
        $('.tag').append(label);
        $('.refresh').click(function(){
            $('.rank-list.more').empty();
            getRandomPost();
        });
        getRandomPost();
        getComment();
        shootComment();

    });
    function shootComment(){
        $('.shoot-btn').click(function () {
           if($('.comment-textarea').val()==""){
               alert("评论不能为空");
               $('.comment-textarea').focus();
               return false;
           }
            $.ajax({
                url: MODULE + '/Article/shootComment',
                type: 'post',
                data: {content:$('.comment-textarea').val(),id:'<?php echo ($id); ?>'},
                success:function () {
                    $('.comment-list').empty();
                    getComment();
                    $('.comment-textarea').val("");
                },error:function () {
                    alert("发送失败");
                }
            })
        })
    }
    function getComment(current,page) {
        $.ajax({
            type: 'post',
            data: {id:'<?php echo ($id); ?>',current:current,page:page},
            url: MODULE + '/Article/getComment',
            success:function (data) {
                for(i in data) {
                    var li = "<li>";
                    li += '<div class="comment-user-avatar"><img src="'+data[i]['d_avatar']+'"></div>';
                    li += '<div class="right-wrapper">' + '<p class="reviewer">'+data[i]['username']+'</p>';
                    li += '<p class="comment-content">'+data[i]['content']+'</p>' +
                        '<span class="floor">#'+(data.length-parseInt(i))+'</span><span class="date">'+data[i]['date']+'</span><a class="reply">回复</a>' +
                        '</div></li>';
                    $('.comment-list').append(li);
                }
            },error:function () {
                alert("error");
            }
        })
    }
    function getRandomPost() {
        $.ajax({
            url:MODULE + '/Article/getRandomPost',
            type: 'post',
            success:function (data) {
                for(i in data){
                    var html = '<li>';
                    html += '       <a href="'+MODULE+'/Article/read/'+data[i]['article_id']+'" target="_blank" title="'+data[i]['title']+'">\n' +
                        '            '+data[i]['title']+
                        '       </a>\n';
                    html += '</li>';
                    $('.rank-list.more').append(html);
                }
            },error:function () {
                alert('error');
            }
        });
    }
</script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($name); ?>-MyCircle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
    <link href="/mycircle/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/mycircle/Public/CSS/main-style.css" rel="stylesheet" type="text/css" media="all">
    <link href="/mycircle/Public/CSS/pagination.css" rel="stylesheet" type="text/css">
    <script src="/mycircle/Public/js/jquery-3.2.1.js"></script>
    <script src="/mycircle/Public/js/my_circle.js"></script>
    <script>
        var MODULE ="/mycircle";
        var PUBLIC ="/mycircle/Public";
    </script>
    <script src="/mycircle/Public/js/jquery.pagination.js"></script>
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
    <div class="container bg">
        <div class="outer-wrapper left-wrapper">
            <div class="circle-header">
                <div class="circle-portrait">
                    <img src="<?php echo ($avatar); ?>"/>
                </div>
                <div class="circle-wrapper">
                    <div class="circle-title">
                        <h1><?php echo ($name); ?></h1>
                        <a class="btn join-btn" id="join">加入</a>
                    </div>
                    <p class="circle-intro">简介：<?php echo ($intro); ?></p>
                    <span class="circle-class">所属分类: <a href="/mycircle/Circle/?category=<?php echo ($category); ?>"><?php echo ($class); ?></a></span>
                    <span class="glyphicon glyphicon-user circle-people"> <?php echo ($people); ?></span>
                    <span class="glyphicon glyphicon-edit circle-article"> <?php echo ($article); ?></span>
                </div>
            </div>
            <div class="article-wrapper">
                <div class="circle-article-nav">
                    <ul>
                        <li><a href="#">全部</a></li>
                        <li><a class="glyphicon glyphicon-edit write" id="write"></a></li>
                    </ul>
                </div>
                <ul class="circle-article-list M-box m-style">
                </ul>
            </div>
        </div>
        <aside class="sidebar right-wrapper">
            <div class="notice">
                <p class="banner">公告</p>
                <p class="content"><?php echo ($notice); ?></p>
            </div>
            <div class="rank recommend">
                <p class="banner">本圈推荐文章</p>
                <ul class="rank-list"></ul>
            </div>
        </aside>
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
<script>
    $(function () {
        var total = '<?php echo ($total); ?>';
        var show =  5;
        total = Math.ceil(total/show);
        $('.M-box').pagination({
            mode: 'fixed',
            showData: show,
            pageCount: total,
            callback: function (api) {
                circle_post(api.getCurrent(),show);
            }
        },function (api) {
            circle_post(api.getCurrent(),show);
        });
        if(show>='<?php echo ($total); ?>') {
            $('.page-wrapper').remove();
        }
        $(".btn").click(function () {
            if($(this).hasClass('active')){
                $.post(MODULE+'/Circle/quit',{circle_id:"<?php echo ($id); ?>"});
                $(this).text("加入").removeClass('active');
            }else {
                $.get(MODULE+"/Circle/join",{circle_id:"<?php echo ($id); ?>"},function(data){
                    if(data){
                        window.location.href = MODULE+'/Account/login';
                    }else {
                        $('.join-btn').text("已加入").addClass('active');
                    }
                });
            }
        });
        $('#write').bind('click',function () {
            $.get(MODULE+'/Circle/write',{circle_id:"<?php echo ($id); ?>"},function (data) {
               if(data){
                   window.location.href = MODULE+'/Account/login';
               }else {
                   window.location.href = MODULE+'/Article/write/?circle='+"<?php echo ($id); ?>";
               }
            });
        });
        function circle_post(current,page) {
            $.ajax({
                type:"post",
                dataType:"json",
                data:{circle_id:"<?php echo ($id); ?>",current:current,page:page},
                url:MODULE+"/Article/article_list",
                success:function (data) {
                    if(data.length==0){
                        $(".circle-article-list").append('<li><a class="circle-article-title">欢迎来到<?php echo ($name); ?></a><p class="circle-article-intro">欢迎发表文章</p></li>').css('display','');
                    }
                    for(i = 0;i<data.length;i++){
                        var $li = '<li>' +
                            '<a class="circle-article-title" href="'+MODULE+'/Article/read/'+data[i]['article_id']+'">'+data[i]['title']+'</a>\n' +
                            '<p class="circle-article-intro">'+data[i]['content']+'</p>\n' +
                            '</li>';
                        $(".circle-article-list").append($li);
                    }
                },error:function () {
                    alert("get article list error");
                }
            });
        }
        $.post(MODULE+"/Circle/join_status",{cid:"<?php echo ($id); ?>"},function (data) {
            if(data){
                $("#join").text("已加入").addClass('active');
            }
        });
        getRecommendList();
        function getRecommendList() {
            $.ajax({
                url:MODULE + '/Circle/recommendPost',
                data:{circle_id:'<?php echo ($id); ?>'},
                type: 'post',
                success:function (data) {
                    for(i in data){
                        var html = '<li>';
                        html += '       <a href="'+MODULE+'/Article/read/'+data[i]['article_id']+'" target="_blank" title="'+data[i]['title']+'">\n' +
                            '            '+data[i]['title']+
                            '       </a>\n';
                        if(i<3) {
                            var index = parseInt(1)+parseInt(i);
                            html += '<img src="'+PUBLIC+'/img/'+index+'.png">';
                        }
                        html += '</li>';
                        $('.rank-list').append(html);
                    }
                },error:function () {
                    alert('error');
                }
            });
        }
    })
</script>
<script src="/mycircle/Public/bootstrap/js/bootstrap.min.js"></script>
</html>
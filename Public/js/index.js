$(function () {
    getUserSubmitList();
    getTopicList();
    var input_field = $(".input-field");
    var input_label = $(".input-label");
    var input_label_span = $(".input-label span");
    if(input_field.val()!=""){
        input_label.addClass("input-label-end");
        input_label_span.addClass("input-label-span-end");
    }else{
        input_label.removeClass("input-label-end");
        input_label_span.removeClass("input-label-span-end");
    }
    input_field.change(function () {
        if(input_field.val()!=""){
            input_label.addClass("input-label-end");
            input_label_span.addClass("input-label-span-end");
        }else{
            input_label.removeClass("input-label-end");
            input_label_span.removeClass("input-label-span-end");
        }
    });

}); 
function getUserSubmitList() {
    $.ajax({
        url:MODULE+"/Circle/user_list",
        type:"post",
        success:function (data) {
            var join_list = $(".user-menu-circle");
            var article_list = $(".user-menu-article");
            for( i in data){
                if(i==0&&data[i].length==0){
                    var str1 = "还没有加入兴趣圈，点此加入";
                    var str2 = "创建一个";
                    $a = '<a class="go-to" href="Circle/">'+str1+'</a>';
                    join_list.append($a).append("<span style='font-size: 14px; margin: 0 5px;'>或</span>");
                    $a = '<a class="go-to" href="Circle/circle_create" target="_blank">'+str2+'</a>';
                    join_list.append($a);
                }
                if(i==1&&data[i].length==0){
                    var str = "还没有写过文章";
                    $a = '<span class="tip">'+str+'</span>';
                    article_list.append($a);
                }
                for( j in data[i]){
                    if(i==0) {
                        var a = '<a class="bg " href="'+MODULE+'/Circle/' + data[i][j]['circle_id'] + '" target="_blank" title="' + data[i][j]['circle_name'] + '">\n' +
                            '                                <div class="circle-img-mini fl" >\n' +
                            '                                     <img src="'+data[i][j]['circle_avatar']+'" class="img-face">\n' +
                            '                                </div>\n' +
                            '                                <div class="circle-content fl">\n' +
                            '                                    <p class="line-limit" >' + data[i][j]["circle_name"] + '</p>\n' +
                            '                                </div>\n' +
                            '                            </a>';
                        var li = $("<li></li>").html(a);
                        join_list.append(li);
                    }
                    if(i==1){
                        $li= '<li>\n' +
                            '       <a href="'+MODULE+'/Article/read/'+data[i][j]['article_id']+'" target="_blank" title="'+data[i][j]['title']+'">\n' +
                            '            <p class="line-limit">'+data[i][j]['title']+'</p>\n' +
                            '       </a>\n' +
                            '</li>';
                        article_list.append($li).append("<hr>");
                    }
                }
                if(i==0&&data[i].length>4){
                    $p = '<p class="view-more"><a href="Account/mycircle" target="_blank">查看更多</a></p>';
                    join_list.append($p);
                }
                if(i==1&&data[i].length>4){
                    $p = '<p class="view-more"><a href="Account/mypost" target="_blank">查看更多</a></p>';
                    article_list.append($p);
                }
            }
            $(".user-menu-circle li:odd").addClass('right');
        },error:function () {
            alert("error");
        }
    });
}
function getRecommendArticleList(current_page,need_page) {
    $.ajax({
        type:"post",
        url:MODULE+"/Article/article_list/?page="+current_page,
        data:{need_page:need_page},
        success:function(data){
            for(i=0;i<data.length;i++) {
                $div = '<div class="article bg">\n' +
                    '                <div class="article-img fl">\n' +
                    '                    <img src="'+data[i]['cover']+'" class="img-face">\n' +
                    '                </div>\n' +
                    '                <div class="article-title ">\n' +
                    '                    <a href="'+MODULE+'/Article/read/'+data[i]['article_id']+'" title="'+data[i]['title']+'" target="_blank">'+data[i]['title']+'</a>\n' +
                    '                </div>\n' +
                    '                <div class="article-content line-limit" ><p>'+data[i]['content']+'</p>\n' +
                    '                </div>\n' +
                    '\n' +
                    '                <div class="article-info">\n' +
                    '                    <span title="'+data[i]['circle']+'">来自: <a href="'+MODULE+'/Circle/'+data[i]['p_cid']+'" target="_blank">'+data[i]['circle']+'</a></span>\n' +
                    '                    <span>浏览量: '+data[i]['pageview']+'</span>\n' +
                    '                    <span>评论数: '+data[i]['comment']+'</span>\n' +
                    '                    <span>发布日期: '+data[i]['publish_date']+'</span>\n' +
                    '                    <span title="'+data[i]['editor']+'">作者: <a href="#">'+data[i]['username']+'</a></span>\n' +
                    '                </div>\n' +
                    '\n' +
                    '            </div>';
                $(".article-list").append($div);
            }
        },error:function () {
            alert("error");
        }
    });
}
function getCircleList(current_page,need_page) {
    $.ajax({
        type: "post",
        url: MODULE + "/Circle/circle_display"+window.location.search,
        data: {current:current_page,need:need_page},
        success:function (data) {
            var div_circle =  $(".circle-display");
            for( i in data){
                var add ='<a class="my-circle bg fl" href="'+MODULE+'/Circle/'+data[i]['circle_id']+'" target="_blank">\n' +
                    '                    <div class="circle-img fl" >\n' +
                    '                        <img src="'+data[i]['circle_avatar']+'" class="img-face">\n' +
                    '                    </div>\n' +
                    '                    <div class="circle-content fl">\n' +
                    '                        <p class="circle-name line-limit">'+data[i]['circle_name']+'</p>\n' +
                    '                        <p class="circle-intro line-limit">'+data[i]['circle_intro']+'</p>\n' +
                    '                        <span class="glyphicon glyphicon-user circle-people">'+' '+data[i]['circle_people_num']+'</span>\n' +
                    '                        <span class="glyphicon glyphicon-edit circle-article">'+' '+data[i]['circle_article_num']+'</span>\n' +
                    '                    </div>\n' +
                    '                </a>';
                div_circle.append(add);
            }
            $(".circle-display a:even").addClass("my-circle-right");

        },error:function () {
            alert("GEt Circle Error");
        }
    });
    category_position();
}
function getTopicList() {
    $.ajax({
        url:MODULE + '/Article/getTopicPostList',
        type: 'post',
        success:function (data) {
            for(i in data){
                $li= '<li>\n' +
                    '       <a href="'+MODULE+'/Article/read/'+data[i]['article_id']+'" target="_blank" title="'+data[i]['title']+'">\n' +
                    '            '+data[i]['title']+
                    '       </a>\n' +
                    '</li>';

                $('.rank-list').append($li);
            }
        },error:function () {

        }
    })
}
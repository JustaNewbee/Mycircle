var name; //用户名
var avatar; //用户头像
$(function () {
    getLoginState();
    searchPlaceholder();
    ajaxController();
    search();
    $(".user-login").submit(function () {
        $.ajax({
            type:"post",
            url:MODULE+"/Account/user_login",
            data:{
                username:$("#inputUsername").val(),
                password:$("#inputPassword").val()
            },
            success:function (confirm) {
                if(confirm){
                    if(window.location.pathname.localeCompare(MODULE+'/')==0){
                        //主页
                        window.location.reload();
                        return;
                    }
                    //子页
                    window.location.href = document.referrer;
                }else{
                    alert("用户名或者密码错误");
                }
            },error:function () {
                console("Login error");
            }
        });
    });
    user_dropdown();
});
//获取链接里的参数
function getString(name) {
        var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
        var r = window.location.search.substr(1).match(reg);
        if (r != null) {
            return r[2];
        }
        return "";
}
//兴趣圈分类定位显示
function category_position(){
    var category = getString("category");
    var li = ".circle-nav ul li:eq("+category+")";
    $(li).css("border-bottom","solid 2px rgb(217,83,79)");

}
//获取登陆信息
function getLoginState() {
    $.ajax({
        async: false,
        url:MODULE+"/Account/check_login",
        success:function(data){
            if(data['head']){
                avatar = data['src'];
                name = data['name'];
                role = data[''];
                if(avatar!=null){
                    $('.face img').attr('src',avatar);
                }
                $('.welcome').text("欢迎你！"+name+" ~");
                $(".user").show();
                var $menu = $(".user-status .user-dropdown-menu");
                    $menu.append("<li><a target='_blank' href='"+MODULE+"/Account/mydata'>我的信息</a></li>")
                    .append("<li><a target='_blank' href='"+MODULE+"/Account/mycircle'>我的兴趣圈</a></li>")
                    .append("<li><a target='_blank' href='"+MODULE+"/Account/mypost'>我的文章</a></li>")
                    .append("<li><a target='_blank' href='"+MODULE+"/Account/setting'>设置</a></li>");
                    if(data['role']=='admin'){
                        $menu.append("<li><a target='_blank' href='"+MODULE+"/MyAdmin'>管理</a></li>");
                    }
                    $menu.append("<li><a href='"+MODULE+"/Account/logout'>退出</a></li>");
            }
            else{
                $(".user-login-window").show();
                $(".user-status .user-dropdown-menu")
                    .append("<li><a href='"+MODULE+"/Account/login'>登录</a></li>")
                    .append("<li><a href='"+MODULE+"/Account/register'>注册</a></li>");
            }
        },error:function () {
            alert("check error");
        }
    });

}
//搜索框
function searchPlaceholder() {
        var placeholder_txt = "搜索文章或者兴趣圈";
        var temp = "";
        var i = 0;
        setTimeout(function(){inputPlaceholder(i,temp)},400);
        function inputPlaceholder(i,temp) {
            temp = temp + placeholder_txt[i];
            $(".search").attr("placeholder",temp );
            i++;
            if(i<=placeholder_txt.length){
                setTimeout(function(){inputPlaceholder(i,temp)},400);
            }
            else{
                setTimeout(clearPlaceholder(),400);
            }

        }
        function clearPlaceholder() {
            $(".search").attr("placeholder","");
            setTimeout(function(){inputPlaceholder(0,"")},400);
        }
}
//用户下拉菜单
function user_dropdown() {
    $(".user-status-list:first-child").mouseenter(function () {
        $('.user-status .user-dropdown-menu').addClass('active')
    }).mouseleave(function () {
        $('.user-status .user-dropdown-menu').removeClass('active');
    });
}
//上传文章封面
function face_change(obj) {
    var imgFile = obj.files[0];
    var fr = new FileReader();
    fr.onload = function () {
        $("#portrait").attr("src",fr.result);
    };
    fr.onloadstart = function () {
        $("#img-uploader span").removeClass("glyphicon-upload").addClass("glyphicon-option-horizontal");
    };
    fr.readAsDataURL(imgFile);
}
//图片上传提示
function tip_success() {
    $(".tip_success").fadeToggle(500);
}
function tip_fail() {
    $(".tip_fail").fadeToggle(500);
}
//控制分页器加载显示
function ajaxController() {
    $(document).ajaxStart(function () {
        $('.page-wrapper').hide();
    });
    $(document).ajaxComplete(function () {
        $('.page-wrapper').show();
    })
}
function search() {
    $('#search-btn').click(function () {
        window.open(MODULE+"/Index/search/?key="+$('#input_search').val());
    });

}
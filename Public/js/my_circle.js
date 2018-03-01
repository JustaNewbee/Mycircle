$(function () {
    getLoginState();
    searchPlaceholder();
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
                    window.location.href=MODULE;
                }else{
                    alert("登录失败");
                }
            },error:function () {
                alert("Login error");
            }
        });
    });
});
function getString(name) {
        var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
        var r = window.location.search.substr(1).match(reg);
        if (r != null) {
            return r[2];
        }
        return "";
}
function category_position(){
        var category = getString("category");
        var li = ".circle-nav ul li:eq("+category+")";
        $(li).css("border-bottom","solid 2px rgb(217,83,79)");
}
function getLoginState() {
    $.ajax({
        url:MODULE+"/Account/check_login",
        success:function(confirm){
            if(confirm){
                $(".user").show();
            }
            else{
                $(".user-login-window").show();
                $(".user-status ul").append("<li><a href='"+MODULE+"/Account/login'>登录</a></li>").append("<li><a href='"+MODULE+"/Account/register'>注册</a></li>");
            }
        },error:function () {
            alert("check error");
        }
    });

}
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

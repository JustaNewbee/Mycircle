$(function () {
    $(".user-login").submit(function () {
        $.ajax({
            type:"post",
            url:"__ROOT__/Account/login",
            data:{
                username:$("#inputUsername").val(),
                password:$("#inputPassword").val()
            },
            success:function (confirm) {
                if(confirm){
                    window.history.back();
                }else{
                    alert("登录失败");
                }
            },error:function () {
                alert("fail");
            }
        });
    });
});

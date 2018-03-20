$(function () {
    //表单提交
    var btn_signup = $("#btn-signup");
    btn_signup.click(function () {
        $(".user-signup :input").trigger("blur");
        if($(".user-signup .has-error").length>0){
            return false;
        }else {
            $.ajax({
                type:"post",
                data:{
                    username:$("#inputUsername").val(),
                    password:$("#inputPassword").val(),
                    mail:$("#inputMail").val()
                },
                url:MODULE+"/Account/user_sign",
                success:function () {
                    alert("注册成功");
                },
                error:function () {
                    alert("signup fail");
                }
            })
        }

    });
    //表单验证
    $(".user-signup :input").blur(function () {
        var $parent = $(this).parent();
        $parent.find(".error_tip").remove();
        $parent.find(".glyphicon").remove();
        if($(this).is('#inputUsername')){
            if(this.value==""){
                var error_tip = "*用户名不能为空";
                $parent.removeClass("has-success").addClass("has-error");
                $parent.append("<span class='glyphicon glyphicon-remove form-control-feedback '></span>")
                $parent.append("<span class='error_tip'>"+error_tip+"</span>");
            }else {
                $.ajax({
                    type:"post",
                    url:MODULE+"/Account/verify",
                    data:{verify:this.value},
                    success: function (data) {
                        if(data){
                            $parent.removeClass("has-error").addClass("has-success");
                            $parent.append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>")
                        }
                        else {
                            var error_tip = "*用户名已存在";
                            $parent.removeClass("has-success").addClass("has-error");
                            $parent.append("<span class='glyphicon glyphicon-remove form-control-feedback '></span>")
                            $parent.append("<span class='error_tip'>"+error_tip+"</span>");
                        }
                    },error:function () {
                        console.log("verify error")
                    }
                });
            }
        }
        if($(this).is('#inputPassword')){
            if(this.value.length<6){
                var error_tip="*密码不能少于6位";
                $parent.removeClass("has-success").addClass("has-error");
                $parent.append("<span class='glyphicon glyphicon-remove form-control-feedback '></span>")
                $parent.append("<span class='error_tip'>"+error_tip+"</span>")
            }else{
                $parent.removeClass("has-error").addClass("has-success");
                $parent.append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>")
            }
        }
        if($(this).is('#inputPassword2')){
            if(this.value==""){
                var error_tip="*请再次输入密码确认";
                $parent.removeClass("has-success").addClass("has-error");
                $parent.append("<span class='glyphicon glyphicon-remove form-control-feedback '></span>")
                $parent.append("<span class='error_tip'>"+error_tip+"</span>")
            }else if(this.value!=$('#inputPassword').val()&&this.value!=""){
                var error_tip="*前后密码不一致";
                $parent.removeClass("has-success").addClass("has-error");
                $parent.append("<span class='glyphicon glyphicon-remove form-control-feedback '></span>")
                $parent.append("<span class='error_tip'>"+error_tip+"</span>")
            }else{
                $parent.removeClass("has-error").addClass("has-success");
                $parent.append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>")
            }
        }
        if($(this).is('#inputMail')){
            var str =/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
            if(this.value==""){
                var error_tip="*邮箱地址不能为空";
                $parent.removeClass("has-success").addClass("has-error");
                $parent.append("<span class='glyphicon glyphicon-remove form-control-feedback '></span>")
                $parent.append("<span class='error_tip'>"+error_tip+"</span>")
            }else if(!str.test(this.value)&&this.value!=""){
                var error_tip="*邮箱地址格式有误";
                $parent.removeClass("has-success").addClass("has-error");
                $parent.append("<span class='glyphicon glyphicon-remove form-control-feedback '></span>")
                $parent.append("<span class='error_tip'>"+error_tip+"</span>")
            }else{
                $parent.removeClass("has-error").addClass("has-success");
                $parent.append("<span class='glyphicon glyphicon-ok form-control-feedback'></span>")
            }
        }
    });

});
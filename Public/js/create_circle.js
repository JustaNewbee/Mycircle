$(function () {
    var circle_avatar_src;
    var select1 = $("#circle_class");
    var select_group = $(".circle-class-group");
    var select2="<select  class=\"form-control circle_class circle_class_son\">\n" +
        "                    <option selected value=\"\">请选择</option>\n" +
        "                </select>";
    select_group.append(select2);
     $.ajax({
         url: MODULE + "/Circle/get_circle_class",
         type: "post",
         success: function (data) {
             for(i in data){
                 var op = "<option value='" + i + "'>" + data[i] + "</option>";
                 select1.append(op);
             }
         }, error: function () {
             alert("error");
         }
     });
    select1.change(function () {
        select2 = $(".circle_class_son");
        $.ajax({
            data:{select:this.value},
            url: MODULE + "/Circle/get_circle_class",
            type: "post",
            success: function (data) {
                $(".s2-child").remove();
                if(data){
                    select2.show(500);
                    for(i in data){
                        var op = "<option class='s2-child' value='" + i + "'>" + data[i] + "</option>";
                        select2.append(op);
                    }
                }else{
                    select2.hide(500);
                }
            }, error: function () {
                alert("error");
            }
        });
    });
    $("#circle_face").change(function () {
        var face = $('#circle_face');
        var fd = new FormData();
        face_change(this);
        fd.append('photo',face[0].files[0]);
        $.ajax({
            type:'post',
            url:MODULE+"/Circle/upload",
            processData: false,
            contentType: false,
            data: fd,
            success:function (data) {
                if(data['head']){
                    circle_avatar_src = data['content'];
                    tip_success();
                    setTimeout(tip_success,1500);
                }else{
                    $(".tip_fail").text(data['content']);
                    tip_fail();
                    setTimeout(tip_fail,1500);
                    setTimeout(function () {
                        $("#img-uploader span").removeClass("glyphicon-option-horizontal").addClass("glyphicon-upload");
                    },1500);
                }
            },error:function () {
                alert('文件上传错误');
            }
        });
    });
    $(".circle-create").submit(function () {
        $.ajax({
            type:"post",
            url:MODULE +"/Circle/create_circle",
            data:{circle_name:$("#circle_name").val(),circle_intro:$("#circle_intro").val(),
            circle_class:$("#circle_class").val(),circle_avatar:circle_avatar_src},
            success:function (url) {
                window.location.reload();
            },error:function () {
                alert("error");
            }
        })
    });


});
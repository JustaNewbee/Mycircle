$(function () {
    var select1 = $("#circle_class");
    var select_group = $(".circle-class-group");
    var select2="<select  class=\"form-control circle_class circle_class_son\">\n" +
        "                    <option selected value=\"\">请选择</option>\n" +
        "                </select>";
    select_group.append(select2);
     $.ajax({
         url: module + "/Circle/get_circle_class",
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
            url: module + "/Circle/get_circle_class",
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
    $(".circle-create").submit(function () {
        $.ajax({
            type:"post",
            url:module+"/Circle/create_circle",
            data:{circle_name:$("#circle_name").val(),circle_intro:$("#circle_intro").val(),
            circle_class:$("#circle_class").val()/*circle_face*/},
            success:function () {
                window.location.reload();
            },error:function () {
                alert("error");
            }
        })
    })
    
});
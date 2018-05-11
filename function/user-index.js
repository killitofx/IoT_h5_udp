/**
 * Created by 廉晟 on 2018/5/8.
 */
$(document).ready(function(){
    weather();
    $(".not").each(function(){
        $(this).on("click",fresh);
    });
    $(".tc").each(function(){
        $(this).on("click",tc);
    });
    $(".cg").each(function(){
        $(this).on("click",cg);
    });
    $(".fav").each(function(){
        $(this).on("click",fav);
    });
    $(".del").each(function(){
        $(this).on("click",del);
    });
    $(".add").on("click",add_port);
});

function fresh(){
    var id=$(this).parent("div").attr("dev");
    //alert("del:"+ id);
    midd = "." +id;
    var st=$(midd).children(".st");
    $.get( "../function/api.php", { method: "select",obj:"port",token:1,pid:id }, function( data ) {
        //console.log(data.state);
        if(data.state=="1"){
            st.text("打开");
        }else {
            st.text("关闭");
        }
    },"json");
}

function tc(){
    var id=$(this).parent("div").attr("dev");
    window.location.href="add_time.php?pid="+ id;
}

function cg(){
    var id=$(this).parent("div").attr("dev");
    midd = "." +id;
    var st=$(midd).children(".st");
    var state=$(this).children(".state");
    var stated=state.text();
    if(stated=="关闭"){
        $.get( "../function/api.php", { method: "update",obj:"port",name:"p_state", id_name:"pid",token:1,data:0,id:id }, function( data ) {
           if(data=="200"){
               state.text("打开");
               st.text("关闭");
           }
        });

    }else{
        $.get( "../function/api.php", { method: "update",obj:"port",name:"p_state", id_name:"pid",token:1,data:1,id:id }, function( data ) {
           if(data=="200"){
               state.text("关闭");
               st.text("打开");
           }
        });
    }
}

function weather(){
    $.get( "../function/api.php", { method: "weather",token:1}, function( data ) {
        $("#city").text(data.city);
        var weather = data.wendu + '度 '+data.type + ' ' + data.fx +  ' ' + data.quality;
        $("#weather").text(weather);
        var weather_f ="PM2.5 "+data.pm25 + " | " + "湿度 "+data.shidu;
        $("#weather_f").text(weather_f);

    },"json")
}

function fav(){
    var pid=$(this).parent("div").attr("dev");
    var uid=$("#uid").text();
    var massage = $('#result');
    var massage_data = $("#msg");
    var txd = $(this).children(".favs").text();
    var tx = $(this).children(".favs");
    //alert("fav:"+ id);
    if(txd=="收藏"){
        $.get( "../function/api.php", { method: "add",token:1,obj:"fav",pid:pid,uid:uid}, function( data ) {
            if(data=="200"){
                tx.text("已收藏");
                //massage_data.text("添加成功");
                //massage.modal({
                //    keyboard: true
                //});
            }else {
                tx.text("收藏");
                massage_data.text("添加失败");
                massage.modal({
                    keyboard: true
                });
            }
        });
    }else{
        $.get( "../function/api.php", { method: "delete",token:1,obj:"fav",pid:pid}, function( data ) {
            if(data=="200"){
                tx.text("收藏");
                //massage_data.text("取消成功");
                //massage.modal({
                //    keyboard: true
                //});
            }else {
                tx.text("已收藏");
                massage_data.text("取消失败");
                massage.modal({
                    keyboard: true
                });
            }
        });
    }

}

function del(){
    var id=$(this).parent("div").attr("dev");
    var massage = $('#result');
    var massage_data = $("#msg");

    $.get( "../function/api.php", { method: "delete",token:1,obj:"port",pid:id}, function( data ) {
       if(data=="200"){
           $.get( "../function/api.php", { method: "delete",token:1,obj:"fav",pid:id}, function( data ) {
               if(data=="200"){
                   massage_data.text("设备删除成功");
                   massage.modal({
                       keyboard: true
                   });
               }
           });

           setTimeout("location.reload()",1500);

       } else {
           massage_data.text("设备删除失败");
           massage.modal({
               keyboard: true
           });
       }
    });
}

function add_port(){
    var name=$("#add_name").val();
    var room=$("#add_room").find("option:selected").val();
    var io=$("#add_io").find("option:selected").val();
    var massage = $('#result');
    var massage_data = $("#msg");
    if(name !==""){
        $.get( "../function/api.php", { method: "add",token:1,obj:"port",name:name,room:room,type:io}, function( data ) {
            if(data=="200"){
                location.reload();
            }else{
                massage_data.text("设备添加失败");
                massage.modal({
                    keyboard: true
                });
            }
        });
    }else {
        massage_data.text("名称不能为空");
        massage.modal({
            keyboard: true})
    }


}
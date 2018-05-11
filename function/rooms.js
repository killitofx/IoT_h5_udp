/**
 * Created by 廉晟 on 2018/5/10.
 */
$(document).ready(function(){
    $(".del").each(function(){
        $(this).on("click",del);
    });
    $(".open_all").each(function(){
        $(this).on("click",open_all);
    });
    $(".close_all").each(function(){
        $(this).on("click",close_all);
    });
    $("#add_room").on("click",add_room);
    $("#room_update").on("click",update_room);
    $("#room_port_update").on("click",update_port_room);
});

function del(){
    var id=$(this).attr("id");
    var num=$(this).attr("num");
    var massage = $('#result');
    var massage_data = $("#msg");
    if(id=="0"){
        massage_data.text("无法删除默认房间");
        massage.modal({
            keyboard: true
        });
    }else {
        if(num=="0"){
            $.get( "../function/api.php", { method: "delete",token:1,obj:"room",room_id:id}, function( data ) {
                if(data=="200"){
                    massage_data.text("房间删除成功");
                    massage.modal({
                        keyboard: true
                    });
                    setTimeout("location.reload()",1500);
                }else{
                    massage_data.text("房间删除失败,该房间可能已经被删除");
                    massage.modal({
                        keyboard: true
                    });
                }
            });
        }else{
            massage_data.text("要删除房间，请先删除房间下的所有设备");
            massage.modal({
                keyboard: true
            });
        }

    }

}

function add_room(){
    var name=$("#add_name").val();
    var massage = $('#result');
    var massage_data = $("#msg");
    if (name !==""){
        $.get( "../function/api.php", { method: "add",token:1,obj:"room",name:name}, function( data ) {
            if(data=="200"){
                massage_data.text("房间创建成功");
                massage.modal({
                    keyboard: true
                });
                setTimeout("location.reload()",1500);
            }else{
                massage_data.text("创建失败，请检测房间名是否重复");
                massage.modal({
                    keyboard: true
                });
            }
        });
    }else{
        massage_data.text("请输入房间名称");
        massage.modal({
            keyboard: true
        });
    }
}

function update_room(){
    var old_name=$("#old_name").val();
    var new_name=$("#new_name").val();
    var massage = $('#result');
    var massage_data = $("#msg");
    $.get( "../function/api.php", { method: "update",token:1,obj:"room",old_data:old_name,new_data:new_name}, function( data ) {
        if (data="200"){
            massage_data.text("修改成功");
            massage.modal({
                keyboard: true
            });
            var a=$("#"+old_name);
            a.text(new_name);
        }else{
            console.log(data);
            massage_data.text("修改失败");
            massage.modal({
                keyboard: true
            });
        }
    });
}


function open_all(){
    var id=$(this).attr("id");
    var massage = $('#result');
    var massage_data = $("#msg");
    $.get( "../function/api.php", { method: "update",token:1,obj:"batch",room_id:id,state:1}, function( data ) {
        if (data=="200"){
            massage_data.text("该房间设备已全部打开");
            massage.modal({
                keyboard: true
            });
        }else{
            console.log(data);
            massage_data.text("该房间设备打开失败");
            massage.modal({
                keyboard: true
            });
        }
    });
}

function close_all(){
    var id=$(this).attr("id");
    var massage = $('#result');
    var massage_data = $("#msg");
    $.get( "../function/api.php", { method: "update",token:1,obj:"batch",room_id:id,state:0}, function( data ) {
        if (data=="200"){
            massage_data.text("该房间设备已全部关闭");
            massage.modal({
                keyboard: true
            });
        }else{
            console.log(data);
            massage_data.text("该房间设备关闭失败");
            massage.modal({
                keyboard: true
            });
        }
    });
}

function update_port_room(){
    var port_id=$("#up_se_port").find("option:selected").val();
    var room_id=$("#up_se_room").find("option:selected").val();
    var massage = $('#result');
    var massage_data = $("#msg");
    if(port_id=="" | room_id==""){
        massage_data.text("选项不能为空");
        massage.modal({
            keyboard: true
        });
    }else {
        $.get( "../function/api.php", { method: "update",token:1,obj:"port",name:"room",data:room_id,id_name:"pid",id:port_id}, function( data ) {
            if(data="200"){
                massage_data.text("修改成功");
                massage.modal({
                    keyboard: true
                });
                setTimeout("location.reload()",1500);
            }else{
                console.log(data);
                massage_data.text("修改失败");
                massage.modal({
                    keyboard: true
                });
            }
        });
    }

}


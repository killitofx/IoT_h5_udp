/**
 * Created by 廉晟 on 2018/5/13.
 */
$(document).ready(function(){
    $(".del").on("click",del_rule);
    $("#base_add").on("click",add_base);
    $("#adv_add").on("click",add_adv);
});

function del_rule(){
    var rid = $(this).attr("id");
    var massage = $('#result');
    var massage_data = $("#msg");
    $.get( "../function/api.php", { method: "delete",token:1,obj:"rule",rid:rid}, function( data ) {
        if(data=="200"){
            massage_data.text("删除成功");
            massage.modal({
                keyboard: true
            });
            setTimeout("location.reload()",1500);
        }else {
            massage_data.text("删除失败");
            massage.modal({
                keyboard: true
            });
        }
    });
}


function add_base(){
    var father=$("#fpid").find("option:selected").val();
    var son=$("#spid").find("option:selected").val();
    var same=$("#same").find("option:selected").val();
    var massage = $('#result');
    var massage_data = $("#msg");
    if(father==son){
        massage_data.text("父设备与子设备不能相同");
        massage.modal({
            keyboard: true
        });
    }else {
        $.get( "../function/api.php", { method: "add",token:1,obj:"b-rule",father:father,same:same,son:son}, function( data ) {
            if(data=="200"){
                massage_data.text("添加成功");
                massage.modal({
                    keyboard: true
                });
            }else {
                massage_data.text("添加失败");
                massage.modal({
                    keyboard: true
                });
            }
        });
    }

}

function add_adv(){
    var father=$("#afpid").find("option:selected").val();
    var tg=$("#tg").val();
    var to1=$("#to1").val();
    var to2=$("#to2").val();
    var to3=$("#to3").val();
    var fo1=$("#fo1").val();
    var fo2=$("#fo2").val();
    var fo3=$("#fo3").val();
    var massage = $('#result');
    var massage_data = $("#msg");
    if(tg!==""){
        $.get( "../function/api.php", { method: "add",token:1,obj:"a-rule",father:father,tg:tg,t_order:to1,t_order2:to2,t_order3:to3,f_order:fo1,f_order2:fo2,f_order3:fo3}, function( data ) {
            if(data=="200"){
                massage_data.text("添加成功");
                massage.modal({
                    keyboard: true
                });
            }
        });
    }else{
        massage_data.text("判断语句不能为空");
        massage.modal({
            keyboard: true
        });
    }

}

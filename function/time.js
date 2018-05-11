/**
 * Created by 廉晟 on 2018/5/10.
 */
$(document).ready(function(){
    $(".del").each(function(){
        $(this).on("click",del);
    });
    $("#tos").each(function(){
        $(this).on("click",add_time);
    });

});

function del(){
    var tid=$(this).attr("id");
    var massage = $('#result');
    var massage_data = $("#msg");
    $.get( "../function/api.php", { method: "delete",token:1,obj:"time",tid:tid}, function( data ) {
        if(data=="200"){
            massage_data.text("删除成功");
            massage.modal({
                keyboard: true
            });
            setTimeout("location.reload()",1500);
        }else {
            console.log(data);
            massage_data.text("删除失败,该内容可能已经被删除");
            massage.modal({
                keyboard: true
            });
        }
    })
}

function add_time(){
    var sel="option:selected";
    var pid_obj=$("#pid");
    var massage = $('#result');
    var massage_data = $("#msg");
    var pid=$(pid_obj).find(sel).val();
    var name=$(pid_obj).find(sel).text();
    var flag=$("#flag").find(sel).val();
    var power=$("#power").find(sel).val();
    var lp=$("#loop").find(sel).val();
    var sth=$("#sth").find(sel).val();
    var stm=$("#stm").find(sel).val();
    var cth=$("#cth").find(sel).val();
    var ctm=$("#ctm").find(sel).val();
    var st=sth+stm;
    var ct=cth+ctm;
    $.get( "../function/api.php", { method: "add",token:1,obj:"time",pid:pid,st:st,ct:ct,ctrl:power,lp:lp,name:name}, function( data ) {
        if(data=="200"){
            massage_data.text("规则添加成功");
            massage.modal({
                keyboard: true
            });
        }else{
            console.log(data);
            massage_data.text("规则添加失败");
            massage.modal({
                keyboard: true
            });
        }
    });

}
/**
 * Created by 廉晟 on 2018/5/7.
 */
$(document).ready(function(){
    $("#user-name").on("blur",check_name);
    $("#login").on("click",check_passwd)
});

function check_name(){
    var username = $("#user-name").val();
    var loginbtn = $("#login");
    var massage = $('#result');
    var massage_data = $("#msg");
    $.post( "function/user-api.php", { method: "select",name:username }, function( data ) {
        if(data==200){
            //alert("用户存在");
            loginbtn.attr("class","btn btn-block btn-brand waves-attach waves-light");
        }else {
            //alert("用户不存在");
            loginbtn.attr("class", "btn btn-block btn-brand waves-attach waves-light disabled");
            massage_data.text("用户`"+ username + "`不存在,请检查输入或重新注册");
            massage.modal({
                keyboard: true
            })
        }
    })
}

function check_passwd(){
    var username = $("#user-name").val();
    var pw = $("#passwd").val();
    var massage = $('#result');
    var massage_data = $("#msg");
    $.post( "function/user-api.php", { method: "check",name:username ,pw:pw}, function( data ){
        if (data.method == "success"){
            console.log( data.name );
            console.log( data.uid );
            massage_data.text("欢迎回来"+ username);
            massage.modal({
                keyboard: true
            });
            var url = "user/index.php";
            setTimeout("top.location.href = '" + url + "'",2000);
        }else {
            massage_data.text("密码错误,请重试");
            massage.modal({
                keyboard: true
            });
        }

    }, "json")
}
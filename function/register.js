/**
 * Created by 廉晟 on 2018/5/7.
 */
$(document).ready(function(){
    var names = $("#name");
    var passwd = $("#passwd");
    names.on("click",click_name);
    names.on("blur",check_name);
    passwd.on("blur",show_button);
    passwd.on("click",click_name);
    $("#repasswd").on("click",click_repw);
    $("#tos").on("click",check_same);
});

function click_name(){
    $("#passwd").val("");
    $("#repasswd").val("");
}
function click_repw(){
    $("#repasswd").val("");
}

function check_name(){
    var username = $("#name").val();
    var nx = $('#tos');
    var massage = $('#result');
    var massage_data = $("#msg");
    if(username !=''){
        $.post( "function/user-api.php", { method: "select",name:username }, function( data ) {
            if(data==200){
                //alert("用户存在");
                nx.attr("nx","f");
                massage_data.text("用户`"+ username + "`已存在,重新输入用户名");
                massage.modal({
                    keyboard: true
                })

            }else {
                //alert("用户不存在");
                nx.attr("nx","t");

            }
        })
    }else {
        massage_data.text("用户名不能为空");
        massage.modal({
            keyboard: true
        })
    }
}

function show_button(){
    var passwd = $("#passwd").val();
    var repasswd = $("#repasswd").val();
    var btn = $('#tos');
    var nx = btn.attr("nx");
    var massage = $('#result');
    var massage_data = $("#msg");
    if (nx == 't'){
        if(passwd != ''){
            btn.attr("class","btn btn-block btn-brand waves-attach waves-light");
        }else {
            btn.attr("class","btn btn-block btn-brand waves-attach waves-light disabled");
            massage_data.text("密码不能为空");
            massage.modal({
                keyboard: true
            })
        }
    }else {
        btn.attr("class","btn btn-block btn-brand waves-attach waves-light disabled");
        massage_data.text("请检查用户名");
        massage.modal({
            keyboard: true
        })
    }
}

function check_same(){
    var passwd = $("#passwd").val();
    var repasswd = $("#repasswd").val();
    var btn = $('#tos');
    var nx = btn.attr("nx");
    var massage = $('#result');
    var massage_data = $("#msg");
    var username = $("#name").val();
    if (nx == 't'){
        console.log("1");
        if(repasswd != ''){
            console.log("2");
            if(repasswd == passwd){
                console.log("3");
                $.post( "function/user-api.php", { obj: "user",name:username,passwd:passwd }, function( data ) {
                    if (data=="200"){
                        massage_data.text("注册成功");
                        massage.modal({
                            keyboard: true
                        });
                        var url = "login.php";
                        setTimeout("top.location.href = '" + url + "'",2000);
                    }else{
                        massage_data.text("注册失败，请重试");
                        massage.modal({
                            keyboard: true
                        })
                    }
                });

            }else {
                massage_data.text("请检测密码的一致性");
                massage.modal({
                    keyboard: true
                })
            }
        }else {
            massage_data.text("密码不能为空");
            massage.modal({
                keyboard: true
            })
        }
    }else {
        btn.attr("class","btn btn-block btn-brand waves-attach waves-light disabled");
        massage_data.text("请检查用户名");
        massage.modal({
            keyboard: true
        })
    }
}


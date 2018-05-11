<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/8
 * Time: 0:44
 */
@session_start();
if(isset($_SESSION['uid'])){
    $uid=$_SESSION['uid'];
}else{
    header("Location: ../login.php");
}
include_once("../function/config.php");

echo"<span id='uid' hidden>".$uid."</span>";
//获取房间列表
$get_room_url = SERVER . "?token=1&method=select&obj=room";
$room_arr = GetJson($get_room_url);
$i=0;
$room_d = array();
foreach ($room_arr as $key=>$port_name) {
    $get_room_port_num = SERVER . "?token=1&method=select&obj=port&room=".$key;
    $room_all_port = GetJson($get_room_port_num);
    $port_num=count($room_all_port);
    $room_d[] = array("name" =>$port_name,"id"=>$key,"num"=>$port_num);
}

$get_port_url = SERVER . "?token=1&method=select&obj=port";
$port_arr = GetJson($get_port_url);


?>
<!--<a href="../logout.php">登出</a>-->
<html>
<!--头部-->
<head>
    <meta charset="UTF-8">
    <title>user</title>
    <?php include("../com/internal-header.php") ?>

</head>
<body class="page-orange">
<!--侧边栏-->
<?php include("../com/Internal-sidebar.php") ?>
<script src="../function/rooms.js"></script>

<!--主体-->
<main class="content">
    <div class="content-header ui-content-header">
        <div class="container">
            <h1 class="content-heading">房间管理</h1>
        </div>
    </div>
    <!--循环体-->
    <div class="container">
        <section class="content-inner margin-top-no">



            <div class="col-lg-6 col-md-6">

                <?php
                foreach ($room_d as $room2) {
                    echo"<div class=\"card margin-bottom-no\">
                    <div class=\"card-main\">
                        <div class=\"card-inner\">
                            <div class=\"card-inner\">
                                <p class=\"card-heading\" id=".$room2["name"].">".room_link($room2["id"],$room2["name"])."</p>
                                <p>设备数量：<span class='rpn'>".$room2["num"]."</span></p>
                            </div>
                            <div class=\"card-action\">
                                <div class=\"card-action-btn pull-right\">
                                <button class=\"btn btn-flat waves-attach open_all\" id=".$room2["id"]." num=".$room2["num"]."><span class=\"icon\">check</span>&nbsp;打开全部</button>
                                <button class=\"btn btn-flat waves-attach close_all\" id=".$room2["id"]." num=".$room2["num"]."><span class=\"icon\">check</span>&nbsp;关闭全部</button>
                                <button class=\"btn btn-flat waves-attach del\" id=".$room2["id"]." num=".$room2["num"]."><span class=\"icon\">check</span>&nbsp;删除</button>";

                    echo"</div>
                            </div>
                        </div>
                    </div>
                </div>";
                }
                ?>

            </div>

            <div class="col-lg-6 col-md-6">

                <div class="card margin-bottom-no">
                    <div class="card-main">
                        <div class="card-inner">
                            <div class="card-inner">
                                <p class="card-heading">添加房间</p>
                                <div class="form-group form-group-label">
                                    <label class="floating-label" for="oldpwd">房间名称 请不要重复</label>
                                    <input class="form-control" id="add_name" type="text">
                                </div>


                            </div>
                            <div class="card-action">
                                <div class="card-action-btn pull-right">
                                    <button class="btn btn-flat waves-attach add" id="add_room" ><span class="icon">check</span>&nbsp;提交</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card margin-bottom-no">
                    <div class="card-main">
                        <div class="card-inner">
                            <div class="card-inner">
                                <p class="card-heading">重命名房间</p>
                                <div class="form-group form-group-label">
                                    <label class="floating-label" for="oldpwd">原房间名称</label>
                                    <input class="form-control" id="old_name" type="text">
                                </div>

                                <div class="form-group form-group-label">
                                    <label class="floating-label" for="oldpwd">新房间名称</label>
                                    <input class="form-control" id="new_name" type="text">
                                </div>


                            </div>
                            <div class="card-action">
                                <div class="card-action-btn pull-right">
                                    <button class="btn btn-flat waves-attach update" id="room_update" ><span class="icon">check</span>&nbsp;提交</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card margin-bottom-no">
                    <div class="card-main">
                        <div class="card-inner">
                            <div class="card-inner">
                                <p class="card-heading">修改节点所属房间</p>
                                <div class="form-group form-group-label">
                                    <div class="row">
                                        <div class="col-md-10 col-md-push-1">
                                            <label class="floating-label" for="imtype">选择设备</label>
                                            <select class="form-control" id="up_se_port">
                                                <option></option>
                                                <?php foreach($port_arr as $key2=>$port_name){
                                                    echo "<option value=".$key2.">".$port_name." id:".$key2."</option>";
                                                }?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-group-label">
                                    <div class="row">
                                        <div class="col-md-10 col-md-push-1">
                                            <label class="floating-label" for="imtype">选择房间</label>
                                            <select class="form-control" id="up_se_room">
                                                <option></option>
                                                <?php foreach($room_arr as $key=>$rooms_name){
                                                    echo "<option value=".$key.">".$rooms_name."</option>";
                                                }?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-action">
                                <div class="card-action-btn pull-right">
                                    <button class="btn btn-flat waves-attach " id="room_port_update" ><span class="icon">check</span>&nbsp;提交</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!--提示框-->
            <?php include("../com/Modal.php"); ?>

        </section>
    </div>


</main>


<!--页脚-->
<?php include("../com/footer.php")?>

</body>
</html>
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
    $uname=$_SESSION['name'];
}else{
    header("Location: ../login.php");
}
include_once("../function/config.php");
//django
//$get_port_url = SERVER . "num/";
//echo"<span id='server' hidden>../function/api.php</span>";
//展示收藏的界面
$get_port_url = SERVER . "?token=1&method=select&obj=port&fav=".$uid;
$port_arr = GetJson($get_port_url);
$i=0;
$s = array();
$d = array();
foreach ($port_arr as $key=>$port_name) {
//    django
//    $get_port_state = SERVER . "id/" . $key;
    $get_port_state = SERVER."?token=1&method=select&obj=port&pid=".$key;
    $port_data = GetJson($get_port_state);
    $port_state =  $port_data['state'];
    $port_type = $port_data['type'];
//    django
//    $port_change = $port_data['change'];

//    mysql
    $port_dev = $port_data['device'];
    $port_room = $port_data['room'];


    if ($port_type == 1){
        $href = '';
    }
//    elseif($port_type == 0){
        if ($port_state=="1"){
            $cn_state = "打开";
            $cnsn = "关闭";
        }
        else{
            $cn_state = "关闭";
            $cnsn = "打开";
        }
//    }
    if ($i==0){
        $s[] = array("name" =>$port_name, "state" =>$port_state,"type"=>$port_type,"cns"=>$cn_state,"id"=>$key,"dev"=>$port_dev,"room"=>$port_room,"cnsn"=>$cnsn);
        $i=1;
    }elseif($i==1){
        $d[] = array("name" =>$port_name, "state" =>$port_state,"type"=>$port_type,"cns"=>$cn_state,"id"=>$key,"dev"=>$port_dev,"room"=>$port_room,"cnsn"=>$cnsn);
        $i=0;
    }
}
//print_r($s);
//print_r($d);
?>
<!--<a href="../logout.php">登出</a>-->
<html>
<!--头部-->
<head>
    <meta charset="UTF-8">
    <title>user</title>
    <?php include("../com/internal-header.php") ?>
    <script src="../function/user-index.js"></script>
</head>
<body class="page-orange">
<!--侧边栏-->
<?php include("../com/Internal-sidebar.php") ?>

<!--主体-->
<main class="content">
    <div class="content-header ui-content-header">
        <div class="container">
            <h1 class="content-heading"><?php echo $uname; ?>的家</h1>
        </div>
    </div>
<!--循环体-->
    <div class="container">
        <section class="content-inner margin-top-no">
            <div class="col-lg-6 col-md-6">

                <div class="card margin-bottom-no">
                    <div class="card-main">
                        <div class="card-inner">
                            <div class="card-inner">
                                <p class="card-heading" id="city">城市</p>
                                <dl class="dl-horizontal">
                                    <dt style="font-size: 15px" id="weather">气温  天气 风向  空气质量 </dt>
                                </dl>
                            </div>
                            <div class="card-action">
                                <div class="card-action-btn pull-left">
                                    <span class="btn btn-flat waves-attach" id="weather_f"> PM2.5 值 | 湿度 值</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
                foreach ($d as $port) {
                echo"<div class=\"card margin-bottom-no\">
                    <div class=\"card-main\">
                        <div class=\"card-inner\">
                            <div class=\"card-inner\">
                                <p class=\"card-heading\">".$port["name"]."</p>
                                <p class=".$port["id"].">当前状态：<span class='st'>".$port["cns"]."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;位置：".$port["room"]."</p>

                            </div>
                            <div class=\"card-action\">
                                <div class=\"card-action-btn pull-right\" dev=".$port["id"].">
                                <!--<button class=\"btn btn-flat waves-attach del\"><span class=\"icon\">check</span>&nbsp;删除设备</button>-->";
if($port["type"]=="0"){
    echo"\n                                <button class=\"btn btn-flat waves-attach tc\"><span class=\"icon\">check</span>&nbsp;设置定时</button>
                                            <button class=\"btn btn-flat waves-attach cg\"><span class=\"icon\">check</span>&nbsp;<span class='state'>".$port["cnsn"]."</span></button>";
}else{echo"<button class=\"btn btn-flat waves-attach not\">&nbsp;不可动元素</button>";}
                                echo"</div>
                            </div>
                        </div>
                    </div>
                </div>";
                }
                ?>
            </div>

            <div class="col-lg-6 col-md-6">

                <?php
                foreach ($s as $port2) {
                    echo"<div class=\"card margin-bottom-no\">
                    <div class=\"card-main\">
                        <div class=\"card-inner\">
                            <div class=\"card-inner\">
                                <p class=\"card-heading\">".$port2["name"]."</p>
                                <p class=".$port2["id"].">当前状态：<span class= 'st'>".$port2["cns"]."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;位置：".$port2["room"]."</p>

                            </div>
                            <div class=\"card-action\">
                                <div class=\"card-action-btn pull-right\" dev=".$port2["id"].">
                                <!--<button class=\"btn btn-flat waves-attach del\"><span class=\"icon\">check</span>&nbsp;删除设备</button>-->";
                    if($port2["type"]=="0"){
                        echo"<button class=\"btn btn-flat waves-attach tc\"><span class=\"icon\">check</span>&nbsp;设置定时</button>
                                <button class=\"btn btn-flat waves-attach cg\"><span class=\"icon\">check</span>&nbsp;<span class='state'>".$port2["cnsn"]."</span></button>";
                    }else{echo"<button class=\"btn btn-flat waves-attach not\">&nbsp;不可动元素</button>";}
                    echo"</div>
                            </div>
                        </div>
                    </div>
                </div>";
                }
                ?>

            </div>

<!--提示框-->
            <?php include("../com/Modal.php"); ?>

        </section>
    </div>

<!--    <div class="container">-->
<!--        <section class="content-inner margin-top-no">-->
<!--            <div class="row">-->
<!---->
<!--        </section>-->
<!--    </div>-->
</main>


<!--页脚-->
<?php include("../com/footer.php")?>

</body>
</html>
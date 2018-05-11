<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/8
 * Time: 20:30
 */
error_reporting(E_ALL || ~E_NOTICE);
@session_start();
if(isset($_SESSION['uid'])){
    $uid=$_SESSION['uid'];
    $uname=$_SESSION['name'];
}else{
    header("Location: ../login.php");
}
if($_GET["pid"]){
    $pid=$_GET["pid"];
}else{
    $pid="";
}
include_once("../function/config.php");
$get_port_all = SERVER . "?token=1&method=select&obj=port";
$get_port_arr = GetJson($get_port_all);

?>
<html>
<!--头部-->
<head>
    <meta charset="UTF-8">
    <title>user</title>
    <?php include("../com/internal-header.php") ?>
    <script src="../function/time.js"></script>
</head>
<body class="page-orange">
<!--侧边栏-->
<?php include("../com/Internal-sidebar.php") ?>

<!--主体-->
<main class="content">
    <div class="content-header ui-content-header">
        <div class="container">
            <h1 class="content-heading">添加循环规则</h1>
        </div>
    </div>
    <!--循环体-->
    <div class="container">
        <section class="content-inner margin-top-no">

            <div class="col-lg-6 col-md-6">

            <div class="card">
                <div class="card-main">
<!--                    <div class="card-header">-->
                        <div class="card-inner">
                            <p class="card-heading">添加循环规则</p>
<!--                        </div>-->
                    </div>
                    <div class="card-inner">



                        <div class="form-group form-group-label">
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <label class="floating-label" for="imtype">设备ID</label>
                                    <select class="form-control" id="pid">
<!--                                        <option></option>-->
                                        <?php
                                        if($pid!=="" && array_key_exists($pid,$get_port_arr)){
                                            $p_name=$get_port_arr[$pid];
                                            echo"<option value=".$pid.">". $p_name."</option>";
                                        }else{
                                            foreach($get_port_arr as $key=>$data){
                                                echo"<option value=".$key.">".$data."</option>";
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-label">
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <label class="floating-label" for="repasswd">标识</label>
                                    <input class="form-control" id="flag" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-label">
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <label class="floating-label" for="imtype">使能</label>
                                    <select class="form-control" id="power">
<!--                                        <option></option>-->
                                        <option value="0" >关闭</option>
                                        <option value="1" selected>开启</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-label">
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <label class="floating-label" for="imtype">循环</label>
                                    <select class="form-control" id="loop">
<!--                                        <option></option>-->
                                        <option value="0" selected>关闭</option>
                                        <option value="1" >开启</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-label">
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <label class="floating-label" for="imtype">开启时间-H</label>
                                    <select class="form-control" id="sth">
<!--                                        <option></option>-->
                                        <?php
                                        for($x=0; $x<24; $x++){
                                            $var = sprintf("%02d", $x);
                                            echo"<option value=".$var.">".$var."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-label">
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <label class="floating-label" for="imtype">开启时间-M</label>
                                    <select class="form-control" id="stm">
<!--                                        <option></option>-->
                                        <?php
                                        for($x=0; $x<60; $x++){
                                            $var = sprintf("%02d", $x);
                                            echo"<option value=".$var.">".$var."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-label">
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <label class="floating-label" for="imtype">关闭时间-H</label>
                                    <select class="form-control" id="cth">
<!--                                        <option></option>-->
                                        <?php
                                        for($x=0; $x<24; $x++){
                                            $var = sprintf("%02d", $x);
                                            echo"<option value=".$var.">".$var."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-label">
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <label class="floating-label" for="imtype">关闭时间-M</label>
                                    <select class="form-control" id="ctm">
<!--                                        <option></option>-->
                                        <?php
                                        for($x=0; $x<60; $x++){
                                            $var = sprintf("%02d", $x);
                                            echo"<option value=".$var.">".$var."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10 col-md-push-1">
                                    <button id="tos" type="submit" class="btn btn-block btn-brand waves-attach waves-light" nx="f">提交</button>
                                </div>
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

<?php
if ($get_port_arr==array()){
    echo"<script>var massage = $('#result');
    var massage_data = $(\"#msg\");
    massage_data.text(\"请先添加一个节点\");
    massage.modal({
        keyboard: true
    });
    setTimeout(\"window.history.back(-1)\",2000);
    </script>";
}
?>

</body>
</html>
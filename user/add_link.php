<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/8
 * Time: 20:30
 */
@session_start();
if(isset($_SESSION['uid'])){
    $uid=$_SESSION['uid'];
    $uname=$_SESSION['name'];
}else{
    header("Location: ../login.php");
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
    <script src="../function/link.js"></script>
</head>
<body class="page-orange">
<!--侧边栏-->
<?php include("../com/Internal-sidebar.php") ?>

<!--主体-->
<main class="content">
    <div class="content-header ui-content-header">
        <div class="container">
            <h1 class="content-heading">添加联动规则</h1>
        </div>
    </div>
    <!--循环体-->
    <div class="container">
        <section class="content-inner margin-top-no">

            <div class="col-lg-6 col-md-6">
                <!--插入基本规则-->
                <div class="card">
                    <div class="card-main">
                        <div class="card-inner">
                            <p class="card-heading">添加基本规则</p>
                        </div>
                        <div class="card-inner">

                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="imtype">父设备ID</label>
                                        <select class="form-control" id="fpid">
                                            <!--                                        <option></option>-->
                                            <?php

                                                foreach($get_port_arr as $key=>$data){
                                                    echo"<option value=".$key.">".$data."</option>";
                                                }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="imtype">子设备ID</label>
                                        <select class="form-control" id="spid">
                                            <!--                                        <option></option>-->
                                            <?php

                                            foreach($get_port_arr as $key=>$data){
                                                echo"<option value=".$key.">".$data."</option>";
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="imtype">父设备触犯后子设备状态</label>
                                        <select class="form-control" id="same">
                                            <!--                                        <option></option>-->
                                            <option value="0" >不相同</option>
                                            <option value="1" selected>相同</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <button id="base_add" type="submit" class="btn btn-block btn-brand waves-attach waves-light" nx="f">提交</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

<!--            插入高级规则-->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-main">
                        <div class="card-inner">
                            <p class="card-heading">添加高级规则</p>
                        </div>
                        <div class="card-inner">

                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="imtype">父设备ID</label>
                                        <select class="form-control" id="afpid">
                                            <!--                                        <option></option>-->
                                            <?php

                                            foreach($get_port_arr as $key=>$data){
                                                echo"<option value=".$key.">".$data."</option>";
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="repasswd">判断语句</label>
                                        <input class="form-control" id="tg" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="repasswd">成功后执行1</label>
                                        <input class="form-control" id="to1" type="text" value="pass">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="repasswd">成功后执行2</label>
                                        <input class="form-control" id="to2" type="text" value="pass">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="repasswd">成功后执行3</label>
                                        <input class="form-control" id="to3" type="text" value="pass">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="repasswd">失败后执行1</label>
                                        <input class="form-control" id="fo1" type="text" value="pass">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="repasswd">失败后执行2</label>
                                        <input class="form-control" id="fo2" type="text" value="pass">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-label">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <label class="floating-label" for="repasswd">失败后执行3</label>
                                        <input class="form-control" id="fo3" type="text" value="pass">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10 col-md-push-1">
                                        <button id="adv_add" type="submit" class="btn btn-block btn-brand waves-attach waves-light" >提交</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </section>
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
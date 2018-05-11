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
$get_time_all = SERVER . "?token=1&method=select&obj=time";
$get_time_arr = GetJson($get_time_all);

?>
<html>
<!--头部-->
<head>
    <meta charset="UTF-8">
    <title>time loop</title>
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
            <h1 class="content-heading">定时控制</h1>
        </div>
    </div>
    <!--循环体-->
    <div class="container">
        <section class="content-inner margin-top-no">

            <div class="container">
                <div class="col-lg-12 col-sm-12">
                    <section class="content-inner margin-top-no">

                        <div class="card">
                            <div class="card-main">
                                <div class="card-inner">
                                    <p>系统中您设定的定时控制规则。</p>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">

                            <table class="table ">
                                <tr>
                                    <th>序号</th>
                                    <th>设备ID</th>
                                    <th>设备名称</th>
                                    <th>使能</th>
                                    <th>循环</th>
                                    <th>开始时间</th>
                                    <th>关闭时间</th>
                                    <th>说明</th>
                                    <th>操作</th>
                                </tr>


                                    <?php
                                    foreach($get_time_arr as $key=>$times){
                                        echo" <tr>";
                                        echo "<td>".$times["tid"]."</td>";
                                        echo "<td>".$times["pid"]."</td>";
                                        echo "<td>".$times["name"]."</td>";
                                        echo "<td>".$times["ctrl"]."</td>";
                                        echo "<td>".$times["lp"]."</td>";
                                        echo "<td>".$times["st"]."</td>";
                                        echo "<td>".$times["ct"]."</td>";
                                        echo "<td>".$times["tag"]."</td>";
                                        echo"<td><a class=\"btn btn-brand-accent del\" id=".$times["tid"].">删除</a></td>";
                                        echo"</tr>";
                                    }
                                    ?>


                            </table>

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
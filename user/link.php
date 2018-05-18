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
$get_rule_url = SERVER . "?token=1&method=select&obj=rule";
$rule_arr = GetJson($get_rule_url);
$a=array();
$d=array();
foreach ($rule_arr as $key=>$rule){
//    普通参数
    $rid = $rule["rid"];
    $father= $rule["father"];
    $son =$rule["son"];
    $same = $rule["same"];
    $advanced=(int)$rule["advanced"];
//    高级参数
    $tg= $rule["tg"];
    $t_order= $rule["t_order"];
    $t_order2= $rule["t_order2"];
    $t_order3= $rule["t_order3"];
    $f_order= $rule["f_order"];
    $f_order2= $rule["f_order2"];
    $f_order3= $rule["f_order3"];
    if($advanced){
        $a[]=array("father"=>$father,"tg"=>$tg,"t_order"=>$t_order,"t_order2"=>$t_order2,"t_order3"=>$t_order3,"f_order"=>$f_order,"f_order2"=>$f_order2,"f_order3"=>$f_order3,"rid"=>$rid);
    }else{
        $d[]=array("father"=>$father,"son"=>$son,"same"=>$same,"rid"=>$rid);
    }
}


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
            <h1 class="content-heading">联动规则</h1>
        </div>
    </div>
    <!--循环体-->
    <div class="container">
        <section class="content-inner margin-top-no">

        <div class="card">
            <div class="card-main">
                <div class="card-inner">
                    <p>系统中您设定的联动控制规则。</p>
                </div>
            </div>
        </div>



            <div class="card">
                <div class="card-main">
                    <div class="card-inner">
                        <nav class="tab-nav margin-top-no">
                            <ul class="nav nav-justified">
                                <li class="active">
                                    <a class="waves-attach" data-toggle="tab" href="#rule_table">基本规则</a>
                                </li>
                                <li>
                                    <a class="waves-attach" data-toggle="tab" href="#link_table">高级规则</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="card-inner">
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="rule_table">
                                    <div class="table-responsive">

                                        <table class="table">
                                            <tr>
                                                <th>规则编号</th>
                                                <th>父设备ID</th>
                                                <th>子设备ID</th>
                                                <th>相同状态</th>
                                                <th>操作</th>

                                            </tr>

                                            <?php
                                            foreach($d as $key=>$ruler){
                                                echo" <tr>";
                                                echo "<td>".$ruler["rid"]."</td>";
                                                echo "<td>".$ruler["father"]."</td>";
                                                echo "<td>".$ruler["son"]."</td>";
                                                echo "<td>".$ruler["same"]."</td>";
                                                echo"<td><a class=\"btn btn-brand-accent del\" id=".$ruler["rid"].">删除</a></td>";
                                                echo"</tr>";
                                            }
                                            ?>

                                        </table>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="link_table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>规则编号</th>
                                                <th>父设备ID</th>
                                                <th>判断语句</th>
                                                <th>正确执行1</th>
                                                <th>正确执行2</th>
                                                <th>正确执行3</th>
                                                <th>错误执行1</th>
                                                <th>错误执行2</th>
                                                <th>错误执行3</th>
                                                <th>操作</th>
                                            </tr>

                                            <?php
                                            foreach($a as $key=>$ruler){
                                                echo" <tr>";
                                                echo "<td>".$ruler["rid"]."</td>";
                                                echo "<td>".$ruler["father"]."</td>";
                                                echo "<td>".$ruler["tg"]."</td>";
                                                echo "<td>".$ruler["t_order"]."</td>";
                                                echo "<td>".$ruler["t_order2"]."</td>";
                                                echo "<td>".$ruler["t_order3"]."</td>";
                                                echo "<td>".$ruler["f_order"]."</td>";
                                                echo "<td>".$ruler["f_order2"]."</td>";
                                                echo "<td>".$ruler["f_order3"]."</td>";
                                                echo"<td><a class=\"btn btn-brand-accent del\" id=".$ruler["rid"].">删除</a></td>";
                                                echo"</tr>";
                                            }
                                            ?>


                                        </table>
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
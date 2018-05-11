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
?>
<html>
<!--头部-->
<head>
    <meta charset="UTF-8">
    <title>user</title>
    <?php include("../com/internal-header.php") ?>
<!--    <script src="../function/xx.js"></script>-->
</head>
<body class="page-orange">
<!--侧边栏-->
<?php include("../com/Internal-sidebar.php") ?>

<!--主体-->
<main class="content">
    <div class="content-header ui-content-header">
        <div class="container">
            <h1 class="content-heading">公告</h1>
        </div>
    </div>
    <!--循环体-->
    <div class="container">
        <section class="content-inner margin-top-no">

            <div class="card">
                <div class="card-main">
                    <div class="card-inner">
                        <h1>公告</h1><br>
                        <p>这里是公告</p>
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
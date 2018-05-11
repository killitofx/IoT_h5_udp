<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/7
 * Time: 22:02
 */
@session_start();
if(isset($_SESSION['uid'])){
    header("Location: user/index.php");
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <?php include("com/header.php"); ?>
</head>
<body class="page-brand">
<?php include("com/External-sidebar.php"); ?>

<main class="content">
    <div class="content-header ui-content-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-push-0 col-sm-12 col-sm-push-0">
                    <h1 class="content-heading">Binbinss</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <section class="content-inner margin-top-no">



            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-main">
                        <div class="card-inner">
                            <p>IoT Control System</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12">
                <div class="card card-brand">
                    <div class="card-main">
                        <div class="card-inner">
                            <p class="card-heading">注册</p>
                            <p>
                                没有账户？点击按钮注册一个。
                            </p>
                        </div>
                        <div class="card-action">
                            <div class="card-action-btn pull-left">
                                <a class="btn btn-flat waves-attach waves-light waves-effect" href="register.php"><span class="icon">pregnant_woman</span>&nbsp;注册</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12">
                <div class="card card-brand-accent">
                    <div class="card-main">
                        <div class="card-inner">
                            <p class="card-heading">登录</p>
                            <p>
                                有账户了？点击登录。
                            </p>
                        </div>
                        <div class="card-action">
                            <div class="card-action-btn pull-left">
                                <a class="btn btn-flat waves-attach waves-light waves-effect" href="login.php"><span class="icon">vpn_key</span>&nbsp;登录</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>


<footer class="ui-footer">
    <div class="container">
        &copy; Binbinss  <a href="#">STAFF</a> 		</div>
</footer>
</footer>

</body>
</html>

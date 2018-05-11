<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/7
 * Time: 20:43
 */
@session_start();
if(isset($_SESSION['uid'])){
    header("Location: user/index.php");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>登陆</title>
    <?php include("com/header.php"); ?>
    <script src="function/login.js"></script>
</head>
<body class="page-brand">

<?php include("com/External-sidebar.php"); ?>
<main class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-push-4 col-sm-6 col-sm-push-3">
                <section class="content-inner">

<!--                    <nav class="tab-nav margin-top-no">-->
<!--                        <ul class="nav nav-justified">-->
<!--                            <li class="active">-->
<!--                                <a class="waves-attach" data-toggle="tab" href="#passwd_login">密码登录</a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </nav>-->
                    <div class="card-inner">
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="passwd_login">
                                <div class="card">
                                    <div class="card-main">
                                        <div class="card-header">
                                            <div class="card-inner">
                                                <h1 class="card-heading">登录到用户中心</h1>
                                            </div>
                                        </div>
                                        <div class="card-inner">
                                            <form action="javascript:void(0);"  method="POST">
                                                <p class="text-center">
														<span class="avatar avatar-inline avatar-lg">
															<img alt="Login" src="img/user.jpg">
														</span>
                                                </p>

                                                <div class="form-group form-group-label">
                                                    <div class="row">
                                                        <div class="col-md-10 col-md-push-1">
                                                            <label class="floating-label" for="email">用户名</label>
                                                            <input class="form-control" id="user-name" type="text" name="Email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-label">
                                                    <div class="row">
                                                        <div class="col-md-10 col-md-push-1">
                                                            <label class="floating-label" for="passwd">密码</label>
                                                            <input class="form-control" id="passwd" type="password" name="Password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-10 col-md-push-1">
                                                            <button id="login" type="submit" class="btn btn-block btn-brand waves-attach waves-light disabled">登录</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix">
<!--                        <p class="margin-no-top pull-left"><a class="btn btn-flat btn-brand waves-attach" href="/password/reset">忘记密码</a></p>-->
                        <p class="margin-no-top pull-left"><a class="btn btn-flat btn-brand waves-attach" href="register.php">注册个帐号</a></p>
                    </div>

                    <?php include("com/Modal.php"); ?>

                </section>
            </div>
        </div>
    </div>
</main>

<footer class="ui-footer">
    <div class="container">
        &copy; Binbinss  <a href="#">STAFF</a> 		</div>

</footer>
</footer>
</body>
</html>

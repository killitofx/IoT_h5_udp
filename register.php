<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/7
 * Time: 20:58
 */

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <?php include("com/header.php")?>
    <script src="function/register.js"></script>
</head>
<body class="page-brand">

<?php include("com/External-sidebar.php")?>

<main class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-push-4 col-sm-6 col-sm-push-3">
                <section class="content-inner">
                    <div class="card">
                        <div class="card-main">
                            <div class="card-header">
                                <div class="card-inner">
                                    <h1 class="card-heading">和我签订契约，成为魔法少女吧。</h1>
                                </div>
                            </div>
                            <div class="card-inner">
                                <p class="text-center">
										<span class="avatar avatar-inline avatar-lg">
											<img alt="Login" src="img/user.jpg">
										</span>
                                </p>

                                <div class="form-group form-group-label">
                                    <div class="row">
                                        <div class="col-md-10 col-md-push-1">
                                            <label class="floating-label" for="name">昵称</label>
                                            <input class="form-control" id="name" type="text">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group form-group-label">
                                    <div class="row">
                                        <div class="col-md-10 col-md-push-1">
                                            <label class="floating-label" for="passwd">密码</label>
                                            <input class="form-control" id="passwd" type="password">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-group-label">
                                    <div class="row">
                                        <div class="col-md-10 col-md-push-1">
                                            <label class="floating-label" for="repasswd">重复密码</label>
                                            <input class="form-control" id="repasswd" type="password">
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-10 col-md-push-1">
                                            <button id="tos" type="submit" class="btn btn-block btn-brand waves-attach waves-light disabled" nx="f">注册</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-10 col-md-push-1">
                                            <p>注册即代表同意<a href="tos.php">服务条款</a>，以及保证所录入信息的真实性，如有不实信息会导致账号被删除。</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <p class="margin-no-top pull-left"><a class="btn btn-flat btn-brand waves-attach" href="login.php">已经注册？请登录</a></p>
                    </div>

                    <?php include("com/Modal.php"); ?>

                </section>
            </div>
        </div>
    </div>
</main>


</body>
</html>

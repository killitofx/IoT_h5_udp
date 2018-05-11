<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/6
 * Time: 20:23
 */
session_start();
session_destroy();
//echo"<script>alert('登出成功');history.go(-1);</script>";
//echo"<script>alert('登出成功');</script>";
?>
<script>
    alert('登出成功');
    var url = "index.php";
    setTimeout("top.location.href = '" + url + "'",100);
</script>
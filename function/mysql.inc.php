<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/5
 * Time: 9:18
 */

$dbServer='192.169.10.8';
$dbUser='iot2';
$dbPass='Tfve3wVYZHQdU9yz';
$dbName='iot2';
/** 新建 连接 */
$mysqli = new mysqli($dbServer, $dbUser, $dbPass, $dbName);
/** 调试连接是否正常 */
//var_dump($mysqli);

/** check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
//$conn = @mysqli_connect($dbServer,$dbUser,$dbPass,$dbName);
//if (mysqli_connect_errno($conn))
//    die("无法连接服务器");
//mysqli_set_charset($conn,"utf8");
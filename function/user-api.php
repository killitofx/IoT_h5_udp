<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/6
 * Time: 9:37
 */
session_start();
include("mysql.inc.php");
include("config.php");

if(isset($_POST['method']) && isset($_POST['name']) && !isset($_POST['pw'])){
    if($_POST['method']=='select'){
        $name=$_POST['name'];
        $sql_select="SELECT * FROM `user` WHERE `name` ='$name' limit 1";
        if ($result = $mysqli->query($sql_select)) {
            if($num = $result->num_rows){
                echo "200";
            }else{
                echo "201";
            }
        }
    }
}


elseif (isset($_POST['method']) && isset($_POST['name']) && isset($_POST['pw'])) {
    if($_POST['method']=='check'){
        $name = $_POST['name'];
        $upw = $_POST['pw'];
        $pw=toks($upw,$name);
        $sql_select = "select * from  user WHERE `name`='$name'";
        if ($result = $mysqli->query($sql_select)) {
            while ($row = $result->fetch_array()) {
                $true_pw = $row["passwd"];
                $uid = $row["id"];
                if ($pw == $true_pw) {
                    $arr = array("method"=>"success","name"=>$name,"uid" =>$uid);
                    $_SESSION['uid']=$uid;
                    $_SESSION['name']=$name;
                    echo json_encode($arr);
                }else{
                    $arr0 = array("method"=>"fail");
                    echo json_encode($arr0);
                }
            }
        }
    }
}

elseif ($_POST['obj'] == "user" && isset($_POST['name']) && isset($_POST['passwd'])) {
    if (isset($_POST['mail'])) {
        $mail = $_POST['mail'];
    } else {
        $mail = null;
    }
    $name=$_POST['name'];
    $upw=$_POST['passwd'];
    $passwd=toks($upw,$name);
    $sql_inset = "insert into user(name,passwd,mail) VALUE('$name','$passwd','$mail')";
    if ($mysqli->query($sql_inset) === true) {
//        echo("insert table ok");
        echo("200");
    } else {
//        echo("insert table failed:" . $mysqli->error);
        echo("201");
    }
}
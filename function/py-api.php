<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/11
 * Time: 14:08
 */
include("mysql.inc.php");
include("config.php");
if (isset($_GET["token"])=="python"){
//    更新天气
    if ($_GET["method"]=="weather" && isset($_GET["value"]) && isset($_GET["key"])){
        $data=$_GET["value"];
        $key=$_GET["key"];
        $sql_update = "update `weather` set `op_value` = '$data' where `op_keys` = '$key'";
        if ($mysqli->query($sql_update) === true) {
            echo"200";
        }else{
            echo("sql_update table failed:" . $mysqli->error);
            echo $sql_update;
        }
//        获取城市
    }elseif($_GET["method"]=="weather" && isset($_GET["city"])){
        $sql_select="select * from `weather` WHERE `op_keys` = 'city'";
        if ($result = $mysqli->query($sql_select)) {
            while ($row = $result->fetch_array()) {
                echo $row["op_value"];
            }
        }
    }
//查询端口状态
    elseif ($_GET["method"]=="s" &&isset($_GET['pid'])) {
        $device = $_GET['pid'];
        $sql_select = "select * from  port WHERE pid=$device";
        if ($result = $mysqli->query($sql_select)) {
            while ($row = $result->fetch_array()) {
                $data = array("pid" => $row["pid"], "type" => $row["type"],"state" => $row["p_state"]);
            }
            $sql_update = "update port set `change`= 0 where pid = $device";
            if ($mysqli->query($sql_update) === true) {
                echo json_encode($data);
            }
        }
    }
//修改端口状态
    elseif($_GET["method"]=="up" && isset($_GET['pid']) && isset($_GET['state'])){
        $pid=$_GET['pid'];
        $state = $_GET['state'];
        $sql_update = "update `port` set `p_state` = $state , `change` = 1 where `pid` = $pid";
        if ($mysqli->query($sql_update) === true) {
//                        echo("sql_update table ok");
            echo"200";
            $sock = socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);
            $sd_data=array("from" => "php","pid"=>$pid,"state" => $state,"method"=>"up");
            $msg=json_encode($sd_data);
            $len=strlen($msg);
            socket_sendto($sock,$msg,$len,0,'127.0.0.1',9999);
        } else {
            echo"$sql_update";
            echo("sql_update table failed:" . $mysqli->error);
//                    echo"201";
        }
    }

//    查询ruler
    elseif($_GET["method"]=="s_rule") {
        $father = $_GET['father'];
        $sql_select = "select * from  `rulers` WHERE father ='$father'";
        $data = array();
        if ($result = $mysqli->query($sql_select)) {
            while ($row = $result->fetch_array()) {
                $data[] = array("son" => $row["son"], "father" => $row["father"], "same" => $row["same"], "advanced" =>
                    $row["advanced"], "tg" => $row["tg"], "t_order" => $row["t_order"], "f_order" => $row["f_order"]
                , "t_order2" => $row["t_order2"], "f_order2" => $row["f_order2"], "t_order3" => $row["t_order3"], "f_order3" => $row["f_order3"]);
            }
            echo json_encode($data);

        }
    }

//    更改change=0



}


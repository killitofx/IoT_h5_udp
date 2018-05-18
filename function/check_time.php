<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/18
 * Time: 10:43
 */
include_once("config.php");
include("mysql.inc.php");
function change_state($pid,$state,$mysqli){
        $sql_update = "update port set p_state = $state , `change` = 1 where pid = $pid";
        if ($mysqli->query($sql_update) === true) {
//            echo"200";
        } else {
            echo"$sql_update";
            echo("sql_update table failed:" . $mysqli->error);
        }
}

function get_time(){
    return (int)date('Gi');
}

function get_time_list($mysqli){
    $sql_select = "select * from  `time` WHERE `ctrl`=1";
    if ($result = $mysqli->query($sql_select)) {
        while ($row = $result->fetch_array()) {
            $st = (int)$row['st'];
            $ct = (int)$row['ct'];
            $pid = $row['pid'];
            $lp = (int)$row['lp'];
            $tid = (int)$row['tid'];
            echo get_time().'<br>';
            echo $st;

            if($st == get_time()){
                change_state($pid,1,$mysqli);
                echo $pid."1";
            }elseif($ct==get_time()){
                change_state($pid,0,$mysqli);
                echo $pid."0";
            }elseif(get_time()>$ct && $lp==0){
                $sql_delete = "delete from `time` where tid=$tid";
                $mysqli->query($sql_delete);
            }

        }
    }
}
get_time_list($mysqli);

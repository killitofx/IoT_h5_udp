<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/4
 * Time: 19:31
 */
//define('SERVER','http://192.169.10.15:8000/api/');
define('SERVER','http://192.169.10.11/iot3/function/api.php');
function GetJson($url){
    $port_data = file_get_contents($url);
    $port_arr = json_decode($port_data,true);
    return $port_arr;
}

//function passwd($Str,$Check_data){
//    $data = array();
//    $Token=(int)date("Hi");
//    for ($x=-1; $x<=1; $x++) {
//        $data[]= base64_encode(hash_hmac("SHA1",$Str,$x+$Token, true));
//    }
//    if (in_array($Check_data, $data))
//        {
//            return 1;
//        }else{
//        return 0;
//        }
//    }
function tok($str){
    $Token=date("Hi");
    $data= base64_encode(hash_hmac("SHA1",$str,$Token,true));
    return $data;
}

function toks($str,$Token)
{
    $data = base64_encode(hash_hmac("SHA1", $str, $Token, true));
    return $data;
}

function room_link($id,$name){
    $data="<a href=room.php?room_id=".$id."&room_name=".$name.">".$name."</a>";
    return $data;
}
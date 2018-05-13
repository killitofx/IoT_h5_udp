<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/5
 * Time: 9:04
 */
include("mysql.inc.php");
if (isset($_GET['token'])) {
    if ($_GET['token'] == '1') {
//        echo date("Hi")."<br>";

        if ($_GET['method'] == "add") {

//            插入device
            if ($_GET['obj'] == "device" && isset($_GET['name'])) {
//              查询最大device最大id
                $sql = "select max(dev_id) from device";
                $result = $mysqli->query($sql);
                $row = $result->fetch_row();
                $next_num = (int)$row[0] + 1;
//              插入数据
                if (isset($_GET['img'])) {
                    $img_url = $_GET['img'];
                } else {
                    $img_url = 'null';
                }
                $dev_name = $_GET['name'];
                $sql_inset = "insert into device(dev_id,d_name,img) VALUE('$next_num','$dev_name','$img_url')";
                if ($mysqli->query($sql_inset) === true) {
                    echo("insert table ok");
                } else {
                    echo("insert table failed:" . $mysqli->error);
                }
            }

//            插入port
            elseif ($_GET['obj'] == "port" && isset($_GET['name'])) {
//              查询最大device最大id
                $sql = "select max(pid) from port";
                $result = $mysqli->query($sql);
                $row = $result->fetch_row();
                $next_num = (int)$row[0] + 1;
//              插入数据
                if (isset($_GET['type'])) {
                    $types = $_GET['type'];
                } else {
                    $types = '0';
                }
                if (isset($_GET['room'])) {
                    $room = $_GET['room'];
                } else {
                    $room = '1';
                }
                $port_name = $_GET['name'];
                $sql_inset = "insert into port(pid,p_name,`type`,room) VALUE('$next_num','$port_name','$types','$room')";
                if ($mysqli->query($sql_inset) === true) {
//                    echo("insert table ok");
                    echo"200";
                } else {
//                    echo("insert table failed:" . $mysqli->error);
                    echo("insert table failed:" . $mysqli->error);
                }
            }

//            插入房间
            elseif ($_GET['obj'] == "room" && isset($_GET['name'])) {
//              查询最大device最大id
                $sql = "select max(room_id) from room";
                $result = $mysqli->query($sql);
                $row = $result->fetch_row();
                $next_num = (int)$row[0] + 1;
//              插入数据
                $room_name = $_GET['name'];
                $sql_inset = "insert into room(room_id,room_name) VALUE('$next_num','$room_name')";
                if ($mysqli->query($sql_inset) === true) {
                    echo("200");
                } else {
                    echo("insert table failed:" . $mysqli->error);
                }
            }

//            插入时间
            elseif ($_GET['obj'] == "time" && isset($_GET['pid']) && isset($_GET['st']) && isset($_GET['ct'])) {
                if (isset($_GET['ctrl'])) {
                    $ctrl = $_GET['ctrl'];
                } else {
                    $ctrl = 1;
                }
                if (isset($_GET['lp'])) {
                    $lp = $_GET['lp'];
                } else {
                    $lp = 0;
                }
                if (isset($_GET['tag'])) {
                    $tag = $_GET['tag'];
                } else {
                    $tag = "默认的规则";
                }
                if (isset($_GET['name'])) {
                    $name = $_GET['name'];
                } else {
                    $name = "默认的名字";
                }
//                max
                $sql = "select max(tid) from time";
                $result = $mysqli->query($sql);
                $row = $result->fetch_row();
                $next_num = (int)$row[0] + 1;
//              插入数据
                $pid = $_GET['pid'];
                $st = $_GET['st'];
                $ct = $_GET['ct'];

                $sql_inset = "insert into time(tid,pid,ctrl,lp,st,ct,tag,name) VALUE('$next_num','$pid','$ctrl','$lp','$st','$ct','$tag','$name')";
                if ($mysqli->query($sql_inset) === true) {
                    echo("200");
                } else {
                    echo("insert table failed:" . $mysqli->error);
                }
            }
//            创建用户
            elseif ($_GET['obj'] == "user" && isset($_GET['name']) && isset($_GET['passwd'])) {
                if (isset($_GET['mail'])) {
                    $mail = $_GET['mail'];
                } else {
                    $mail = null;
                }
                $name=$_GET['name'];
                $passwd=$_GET['passwd'];
                $sql_inset = "insert into user(name,passwd,mail) VALUE('$name','$passwd','$mail')";
                if ($mysqli->query($sql_inset) === true) {
                    echo("insert table ok");
                } else {
                    echo("insert table failed:" . $mysqli->error);
                }
            }

//            插入收藏列表
            elseif($_GET['obj'] == "fav"){
                if(isset($_GET['uid'])&& isset($_GET['pid'])){
                    $uid=$_GET['uid'];
                    $pid=$_GET['pid'];
                    $sql_inset = "insert into `relationship`(user_id,port_id) VALUE('$uid','$pid')";
                    if ($mysqli->query($sql_inset) === true) {
                        echo("200");
                    } else {
                        echo("insert table failed:" . $mysqli->error);
                    }
                }

            }

//            插入基本规则
            elseif($_GET['obj'] == "b-rule"){
                if(isset($_GET['father'])&& isset($_GET['son']) && isset($_GET['same'])){
                    $father=(int)$_GET['father'];
                    $son=(int)$_GET['son'];
                    $same = (int)$_GET["same"];
                    $stmt =$mysqli->prepare( "insert into `rulers`(father,son,same) VALUES(?,?,?)");
                    $stmt->bind_param("iii",$father,$son,$same);
                    $stmt->execute();
                    echo"200";
                    $stmt->close();

                }
            }
//插入高级规则
            elseif($_GET['obj'] == "a-rule"){
                if(isset($_GET['father'])&& isset($_GET['tg'])){
                    $father=(int)$_GET['father'];
                    $tg=$_GET['tg'];
                    if (isset($_GET['t_order'])) {
                        $t_order = $_GET['t_order'];
                    } else {
                        $t_order = "pass";}
                    if (isset($_GET['t_order2'])) {
                        $t_order2 = $_GET['t_order2'];
                    } else {
                        $t_order2 = "pass";}
                    if (isset($_GET['t_order3'])) {
                        $t_order3 = $_GET['t_order3'];
                    } else {
                        $t_order3 = "pass";}
                    if (isset($_GET['f_order'])) {
                        $f_order = $_GET['f_order'];
                    } else {
                        $f_order = "pass";}
                    if (isset($_GET['f_order2'])) {
                        $f_order2 = $_GET['f_order2'];
                    } else {
                        $f_order2 = "pass";}
                    if (isset($_GET['f_order3'])) {
                        $f_order3 = $_GET['f_order3'];
                    } else {
                        $f_order3 = "pass";}
                    $adv=1;
                    $stmt =$mysqli->prepare( "insert into `rulers`(father,advanced,tg,t_order,t_order2,t_order3,f_order,f_order2,f_order3) VALUES(?,?,?,?,?,?,?,?,?)");
                    $stmt->bind_param("iisssssss",$father,$adv,$tg,$t_order,$t_order2,$t_order3,$f_order,$f_order2,$f_order3);
                    $stmt->execute();
                    echo"200";
                    $stmt->close();

                }

            }

        }

//        查找数据
        elseif ($_GET['method'] == "select") {
//            查找设备编号
            if ($_GET['obj'] == "device") {
                $sql_select = "select * from  device order by dev_id";
                if ($result = $mysqli->query($sql_select)) {
                    #printf("Select returned %d rows.\n", $result->num_rows);
                    $data = array();
                    while ($row = $result->fetch_array()) {
                        #echo$row["dev_id"].'+ '.$row["d_name"].'+'.$row["img"];
                        $device = array("dev_id" => $row["dev_id"], "d_name" => $row["d_name"], "img" => $row["img"]);
                        $data[$row["dev_id"]] = $device;
                    }
                    echo json_encode($data);
                }
            }
//          通过port id获取详细列表
            elseif ($_GET['obj'] == "port") {
                if (isset($_GET['pid'])) {
                    $pid = $_GET['pid'];
                    $sql_select = "select * from  port WHERE pid=$pid";
                    if ($result = $mysqli->query($sql_select)) {
                        while ($row = $result->fetch_array()) {
                            $rm = $row["room"];
                            $id=$row["pid"];
                            $state=$row["p_state"];
                            $type=$row["type"];
                            $device=$row["device"];
                            $change=$row["change"];
                            $sql="select * from  room WHERE room_id=$rm";
                            if ($result = $mysqli->query($sql)) {
                                while ($row = $result->fetch_array()) {
                                    $rn = $row["room_name"];
                                    $device = array("id" => $id, "state" => $state, "type" => $type, "device" => $device, "room" => $rn,"change"=>$change);
                                }}
//                            $device = array("id" => $row["pid"], "state" => $row["p_state"], "type" => $row["type"], "device" => $row["device"], "room" => $rn);
                        }
                        echo json_encode($device);
                    }
                } //通过room获取端口列表
                elseif (isset($_GET['room'])) {
                    $room = $_GET['room'];
                    $sql_select = "select * from  port WHERE room=$room";
                    $device=array();
                    if ($result = $mysqli->query($sql_select)) {
                        while ($row = $result->fetch_array()) {
                            $device[$row["pid"]] = $row["p_name"];
                        }
                        echo json_encode($device);
                    }
                } //通过设备获取端口列表
                elseif (isset($_GET['device'])) {
                    $device = $_GET['device'];
                    $sql_select = "select * from  port WHERE device=$device";
                    if ($result = $mysqli->query($sql_select)) {
                        while ($row = $result->fetch_array()) {
                            $device = array("pid" => $row["pid"], "p_name" => $row["p_name"]);
                        }
                        echo json_encode($device);
                    }
                }
//根据userid 查收藏列表
                elseif(isset($_GET['fav'])) {
                    $favs=$_GET['fav'];
                    $data = array();
                    $sql_select = "select * from  relationship WHERE user_id='$favs'";
                    if ($result = $mysqli->query($sql_select)) {
                        while ($row = $result->fetch_array()) {
                            $pid = $row["port_id"];
                            $sql="select * from port WHERE pid=$pid";
//                            echo $pid;
                            if ($result2 = $mysqli->query($sql)) {
                                while ($row2 = $result2->fetch_array()) {
                                    $data[$row2["pid"]] = $row2['p_name'];
                                }
                            }

                        }
                        echo json_encode($data);
                    }
                }



                //获取所有端口信息
                else {
                    $sql_select = "select * from  port order by pid";
                    if ($result = $mysqli->query($sql_select)) {
                        $data = array();
                        while ($row = $result->fetch_array()) {
                            $data[$row["pid"]] = $row['p_name'];
                        }
                        echo json_encode($data);
                    }

                }

            }

            elseif($_GET["obj"]=="rule") {
                $sql_select = "select * from  `rulers`";
                $data = array();
                if ($result = $mysqli->query($sql_select)) {
                    while ($row = $result->fetch_array()) {
                        $data[] = array("son" => $row["son"], "father" => $row["father"], "same" => $row["same"], "advanced" =>
                            $row["advanced"], "tg" => $row["tg"], "t_order" => $row["t_order"], "f_order" => $row["f_order"]
                        , "t_order2" => $row["t_order2"], "f_order2" => $row["f_order2"], "t_order3" => $row["t_order3"], "f_order3" => $row["f_order3"],"rid"=>$row["rid"]);
                    }
                    echo json_encode($data);

                }
            }

//返回所有room
            elseif ($_GET['obj'] == "room") {
                $sql_select = "select * from  room order by room_id";
                if ($result = $mysqli->query($sql_select)) {
                    $data = array();
                    while ($row = $result->fetch_array()) {
                        $data[$row["room_id"]] = $row['room_name'];
                    }
                    echo json_encode($data);
                }
            }

//            返回所有时间控制表


//根据pid查找时间控制表
            elseif ($_GET['obj'] == "time") {
                if (isset($_GET['pid'])) {
                    $pid = $_GET['pid'];
                    $sql_select = "select * from  time WHERE pid=$pid";
                    if ($result = $mysqli->query($sql_select)) {
                        $data = array();
                        while ($row = $result->fetch_array()) {
                            $device = array("tid" => $row["tid"],"pid" => $row["pid"], "ctrl" => $row["ctrl"], "lp" => $row["lp"], "st" => $row["st"], "ct" => $row["ct"]);
                            $data[$row["pid"]] = $device;
                        }
                        echo json_encode($data);
                    }
                }else{
                    $sql_select = "select * from  time order by tid";
                    if ($result = $mysqli->query($sql_select)) {
                        $data = array();
                        while ($row = $result->fetch_array()) {
                            $device = array("tid" => $row["tid"],"pid" => $row["pid"], "ctrl" => $row["ctrl"], "lp" => $row["lp"], "st" => $row["st"], "ct" => $row["ct"],"tag"=>$row["tag"],"name"=>$row["name"]);
                            $data[] = $device;
                        }
                        echo json_encode($data);
                    }
                }

            }
//            根据uid查收藏列表
            elseif($_GET['obj'] == "fav"){
                if(isset($_GET['uid'])){
                    $fav=$_GET['uid'];
                    $sql_select="select * from relationship WHERE user_id='$fav'";
                    if ($result = $mysqli->query($sql_select)) {
                        $data = array();
                        while ($row = $result->fetch_array()) {
                            $data[]=$row["port_id"];
                        }
                        echo json_encode($data);
                    }
                }
            }
        }

//删除数据
        elseif ($_GET['method'] == "delete") {
//          删除时间控制器
            if($_GET['obj'] == "time"){
                if(isset($_GET['tid'])){
                    $tid=$_GET['tid'];
                    $sql_delete = "delete from time where tid=$tid";
                    if ($mysqli->query($sql_delete) === true) {
                        echo("200");
                    } else {
                        echo("delete table data failed:" . $mysqli->error);
                    }
                }
            }
//          删除房间
            elseif($_GET['obj'] == "room"){
                if(isset($_GET['room_id'])){
                    $room_id=$_GET['room_id'];
                    $sql_delete = "delete from `room` where room_id=$room_id";
                    if ($mysqli->query($sql_delete) === true) {
                        echo("200");
                    } else {
                        echo("201");
                    }
                }
            }
//          删除端口
            elseif($_GET['obj'] == "port"){
                if(isset($_GET['pid'])){
                    $pid=$_GET['pid'];
                    $sql_delete = "delete from `port` where pid=$pid";
                    if ($mysqli->query($sql_delete) === true) {
//                        echo("delete table data ok");
                        echo"200";
                    } else {
//                        echo("delete table data failed:" . $mysqli->error);
                        echo"201";
                    }
                }
            }
//          删除设备
            elseif($_GET['obj'] == "device"){
                if(isset($_GET['dev_id'])){
                    $dev_id=$_GET['dev_id'];
                    $sql_delete = "delete from `device` where dev_id=$dev_id";
                    if ($mysqli->query($sql_delete) === true) {
                        echo("delete table data ok");
                    } else {
                        echo("delete table data failed:" . $mysqli->error);
                    }
                }
            }
//            删除使用者
            elseif($_GET['obj'] == "user"){
                if(isset($_GET['uid'])){
                    $uid=$_GET['uid'];
                    $sql_delete = "delete from `user` where id=$uid";
                    if ($mysqli->query($sql_delete) === true) {
                        echo("delete table data ok");
                    } else {
                        echo("delete table data failed:" . $mysqli->error);
                    }
                }
            }

//            联动删除收藏
            elseif($_GET['obj'] == "fav"){
                if(isset($_GET['pid'])){
                    $pid=$_GET['pid'];
                    $sql_delete = "delete from `relationship` where port_id=$pid";
                    if ($mysqli->query($sql_delete) === true) {
                        echo("200");
                    } else {
//                        echo("delete table data failed:" . $mysqli->error);
                        echo("201");
                    }
                }
            }

//            删除规则
            elseif($_GET['obj'] == "rule"){
                if(isset($_GET['rid'])){
                    $rid=$_GET['rid'];
                    $stmt = $mysqli->prepare( "delete from `rulers` where rid=?");
                    $stmt->bind_param("i", $rid);
                    $stmt->execute();
                    echo "200";
                    $stmt->close();
                }
            }


        }
//修改数据
        elseif ($_GET['method'] == "update") {
//            修改房间名称
            if($_GET['obj']=="room" && isset($_GET['old_data']) && isset($_GET['new_data'])){
                $old_data=$_GET['old_data'];
                $new_data = $_GET['new_data'];
                $sql_update = "update room set room_name = '$new_data' where room_name = '$old_data'";
                if ($mysqli->query($sql_update) === true) {
//                        echo("sql_update table ok");
                    echo"200";
//                    echo"$sql_update";
                    } else {
                        echo"$sql_update";
                        echo("sql_update table failed:" . $mysqli->error);
//                    echo"201";
                    }
            }
//          根据房间批量修改端口状态
            if($_GET['obj']=="batch" && isset($_GET['room_id']) && isset($_GET['state'])){
                $room_id=$_GET['room_id'];
                $state = $_GET['state'];
                $sql_update = "update port set p_state = $state,`change`=1 where room = $room_id and type=0";
                if ($mysqli->query($sql_update) === true) {
//                        echo("sql_update table ok");
                    echo"200";
//                    echo"$sql_update";
                    $sock = socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);
                    $sd_data=array("from" => "php","method"=>"up_all");
                    $msg=json_encode($sd_data);
                    $len=strlen($msg);
                    socket_sendto($sock,$msg,$len,0,'127.0.0.1',9999);
                } else {
                    echo"$sql_update";
                    echo("sql_update table failed:" . $mysqli->error);
//                    echo"201";
                }
            }
//更新状态程序
            elseif(isset($_GET['obj']) && isset($_GET['name']) && isset($_GET['data']) && isset($_GET['id_name']) && isset($_GET['id'])){
                $obj=$_GET['obj'];
                $id=$_GET['id'];
                $id_name = $_GET['id_name'];
                $name=$_GET['name'];
                $data=$_GET['data'];
                $sql_update = "update $obj set $name = $data , `change` = 1 where $id_name = $id";
                if ($mysqli->query($sql_update) === true) {
//                        echo("sql_update table ok");
                    echo"200";
                    $sock = socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);
                    $sd_data=array("from" => "php","pid"=>$id,"state" => $data,"method"=>"up");
                    $msg=json_encode($sd_data);
                    $len=strlen($msg);
                    socket_sendto($sock,$msg,$len,0,'127.0.0.1',9999);
                } else {
                    echo"$sql_update";
                    echo("sql_update table failed:" . $mysqli->error);
//                    echo"201";
                }
            }
        }
//查找天气数据
        elseif ($_GET['method'] == "weather"){
            $sql_select = "select * from  weather ORDER BY id";
            $data=array();
            if ($result = $mysqli->query($sql_select)) {
                while ($row = $result->fetch_array()) {
                    $data[$row["op_keys"]]=$row["op_value"];
                }
                echo json_encode($data);
            }
        }
    }



    $mysqli->close();
}
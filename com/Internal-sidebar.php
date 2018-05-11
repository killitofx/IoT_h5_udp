<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/8
 * Time: 13:09
 */
include_once("../function/config.php");
$get_room_url = SERVER . "?token=1&method=select&obj=room";
$room_arr = GetJson($get_room_url);

echo"<header class=\"header header-orange header-transparent header-waterfall ui-header\">
    <ul class=\"nav nav-list pull-left\">
        <div>
            <a data-toggle=\"menu\" href=\"#ui_menu\">
                <span class=\"icon icon-lg text-white\">menu</span>
            </a>
        </div>
    </ul>

    <ul class=\"nav nav-list pull-right\">
        <div class=\"dropdown margin-right\">
            <a class=\"dropdown-toggle padding-left-no padding-right-no\" data-toggle=\"dropdown\">
                <span class=\"access-hide\">kirito</span>
                <span class=\"avatar avatar-sm\"><img alt=\"alt text for John Smith avatar\" src=\"../img/user.jpg\"></span>
            </a>
            <ul class=\"dropdown-menu dropdown-menu-right\">
                <li>
                    <a class=\"padding-right-lg waves-attach\" href=\"#\"><span class=\"icon icon-lg margin-right\">account_box</span>用户中心</a>
                </li>
                <li>
                    <a class=\"padding-right-lg waves-attach\" href=\"../logout.php\"><span class=\"icon icon-lg margin-right\">exit_to_app</span>登出</a>
                </li>
            </ul>

        </div>
    </ul>
</header>
<nav aria-hidden=\"true\" class=\"menu menu-left nav-drawer nav-drawer-md\" id=\"ui_menu\" tabindex=\"-1\">
    <div class=\"menu-scroll\">
        <div class=\"menu-content\">
            <a class=\"menu-logo\" href=\"/\"><i class=\"icon icon-lg\">person_pin_circle</i>&nbsp;用户面板</a>
            <ul class=\"nav\">
                <li>
                    <a class=\"waves-attach\" data-toggle=\"collapse\" href=\"#ui_menu_me\">我的</a>
                    <ul class=\"menu-collapse collapse in\" id=\"ui_menu_me\">
                        <li>
                            <a href=\"index.php\">
                                <i class=\"icon icon-lg\">recent_actors</i>&nbsp;首页
                            </a>
                        </li>

                        <li>
                            <a href=\"profile.php\">
                                <i class=\"icon icon-lg\">info</i>&nbsp;账户信息
                            </a>
                        </li>

                        <li>
                            <a href=\"#\">
                                <i class=\"icon icon-lg\">loyalty</i>&nbsp;邀请码
                            </a>
                        </li>

                        <li>
                            <a href=\"announcement.php\">
                                <i class=\"icon icon-lg\">announcement</i>&nbsp;查看公告
                            </a>
                        </li>
                    </ul>


                    <a class=\"waves-attach\" data-toggle=\"collapse\" href=\"#ui_menu_use\">设备管理</a>
                    <ul class=\"menu-collapse collapse in\" id=\"ui_menu_use\">
                        <li>
                            <a href=\"device.php\">
                                <i class=\"icon icon-lg\">router</i>&nbsp;节点管理
                            </a>
                        </li>



                        <li>
                            <a href=\"time.php\">
                                <i class=\"icon icon-lg\">sync_problem</i>&nbsp;定时控制
                            </a>
                        </li>

                        <li>
                            <a href=\"add_time.php\">
                                <i class=\"icon icon-lg\">youtube_searched_for</i>&nbsp;添加时间
                            </a>
                        </li>

                        <li>
                            <a href=\"link.php\">
                                <i class=\"icon icon-lg\">compare_arrows</i>&nbsp;联动规则
                            </a>
                        </li>

                        <li>
                            <a href=\"add_link.php\">
                                <i class=\"icon icon-lg\">code</i>&nbsp;添加联动
                            </a>
                        </li>

                    </ul>



                    <a class=\"waves-attach\" data-toggle=\"collapse\" href=\"#ui_menu_detect\">房间管理</a>
						<ul class=\"menu-collapse collapse in\" id=\"ui_menu_detect\">
							<li><a href=\"rooms.php\"><i class=\"icon icon-lg\">assignment_late</i>&nbsp;房间管理</a></li>";

                            foreach($room_arr as $key=>$room_name){
                                echo"<li><a href=room.php?room_id=".$key."&room_name=".$room_name."><i class=\"icon icon-lg\">account_balance</i>&nbsp;".$room_name."</a></li>";
                            }

						echo"</ul>

                </li>
            </ul>
        </div>
    </div>
</nav>";
//echo"<li><a href=\"rooms.php\"><i class=\"icon icon-lg\">account_balance</i>&nbsp;审计规则</a></li>";
//echo"                        <li>
//                            <a href=\"rooms.php\">
//                                <i class=\"icon icon-lg\">account_balance</i>&nbsp;房间管理
//                            </a>
//                        </li>";
echo"";
echo"";
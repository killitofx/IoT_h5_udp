<?php
/**
 * Created by PhpStorm.
 * User: 廉晟
 * Date: 2018/5/7
 * Time: 20:09
 */

//@session_start();
//if (isset($_SESSION['name'])){
//    echo ">exit_to_app</span>登出</a>
//                </li>\"";
//}else{
//    echo"<li>
//                    <a class=\"padding-right-lg waves-attach\" href=\"login.php\"><span class=\"icon icon-lg margin-right\">account_box</span>登录</a>
//                </li>
//                <li>
//                    <a class=\"padding-right-lg waves-attach\" href=\"register.php\"><span class=\"icon icon-lg margin-right\">pregnant_woman</span>注册</a>
//                </li>";
//}




echo"<header class=\"header header-transparent header-waterfall ui-header\">
    <ul class=\"nav nav-list pull-left\">
        <li>
            <a data-toggle=\"menu\" href=\"#ui_menu\">
                <span class=\"icon icon-lg\">menu</span>
            </a>
        </li>
    </ul>

    <ul class=\"nav nav-list pull-right\">
        <li class=\"dropdown margin-right\">
            <a class=\"dropdown-toggle padding-left-no padding-right-no\" data-toggle=\"dropdown\">
                <span class=\"access-hide\">未登录</span>
                <span class=\"avatar avatar-sm\"><img alt=\"alt text for John Smith avatar\" src=\"img/user.jpg\"></span>
            </a>
            <ul class=\"dropdown-menu dropdown-menu-right\">
                <li>
                    <a class=\"padding-right-lg waves-attach\" href=\"login.php\"><span class=\"icon icon-lg margin-right\">account_box</span>登录</a>
                </li>
                <li>
                    <a class=\"padding-right-lg waves-attach\" href=\"register.php\"><span class=\"icon icon-lg margin-right\">pregnant_woman</span>注册</a>
                </li>
            </ul>

        </li>
    </ul>
</header>
<nav aria-hidden=\"true\" class=\"menu menu-left nav-drawer nav-drawer-md\" id=\"ui_menu\" tabindex=\"-1\">
    <div class=\"menu-scroll\">
        <div class=\"menu-content\">
            <a class=\"menu-logo\" href=\"#\"><i class=\"icon icon-lg\">restaurant_menu</i>&nbsp;菜单</a>
            <ul class=\"nav\">
                <li>
                    <a  href=\"index.php\"><i class=\"icon icon-lg\">bookmark_border</i>&nbsp;首页</a>
                </li>
                <li>
                    <a  href=\"tos.php\"><i class=\"icon icon-lg\">text_format</i>&nbsp;TOS</a>
                </li>
                <!--<li>-->
                <!--    <a  href=\"#\"><i class=\"icon icon-lg\">code</i>&nbsp;邀请码</a>-->
                <!--</li>-->
                <li>
                    <a  href=\"login.php\"><i class=\"icon icon-lg\">vpn_key</i>&nbsp;登录</a>
                </li>
                <li>
                    <a  href=\"register.php\"><i class=\"icon icon-lg\">pregnant_woman</i>&nbsp;注册</a>
                </li>
            </ul>
        </div>
    </div>
</nav>";

?>


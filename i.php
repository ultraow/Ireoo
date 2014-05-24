<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
require_once("lib/mysql.class.php");
require_once("lib/user.class.php");
require_once("lib/store.class.php");
require_once("lib/goods.class.php");
require_once("lib/movie.class.php");
require_once("include/php/php.php");
if(!isset($_SESSION['user'])) header("Location: http://{$_SERVER['HTTP_HOST']}/login?url=" . curPageURL());
$mysql = new mysql;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $o['username'].' - '.HOST_NAME; ?></title>
    <meta name="keywords" content="<?php echo '会员中心，' . KEYWORDS; ?>" />
    <meta name="description" content="<?php echo DESCRIPTION; ?>" />
    <link href="include/css/head.css" rel="stylesheet" type="text/css">
    <link href="include/css/i.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="include/js/jquery.js"></script>
    <script type="text/javascript">
        $(function() {
            if($('body').height() < $(window).height()) {
                $('div.myself').height($(window).height() - 40);
            }else{
                $('div.myself').height($('body').height() - 40);
            }
            $(window).bind("resize", function() {
                if($('body').height() < $(window).height()) {
                    $('div.myself').height($(window).height() - 40);
                }else{
                    $('div.myself').height($('body').height() - 40);
                }
            });
        });
    </script>
    <style type="text/css">
        div.top div.logo{float: left;}
        div.top div.logo a{padding: 5px; font-size: 20px; font-weight: bold; background: #4898F8; color: #FFF; border-radius: 5px;}
        div.top div.logo input.keyword{padding: 5px; font-size: 20px; width: 500px;}
    </style>
</head>
<body>
<?php
if(!isset($_GET['s'])) {
    $s = 'index';
}else{
    $s = $_GET['s'];
}
?>
<div class="m">
    <h1>
        琦益用户管理中心
    </h1>
    <ul>
        <li<?php if($s == 'index') {echo ' class="active"';} ?>><a href="/i">首页</a></li>
        <li<?php if($s == 'person') {echo ' class="active"';} ?>><a href="?s=person">个人资料</a></li>
        <?php if($o['show'] == 1 or $o['show'] == 2 or $o['show'] == 3 or $o['show'] == 10000) { ?>
            <li<?php if($s == 'store') {echo ' class="active"';} ?>><a href="?s=store">实体店</a></li>
        <?php } ?>
        <?php if($o['show'] == 3) { ?>
            <li<?php if($s == 'business') {echo ' class="active"';} ?>><a href="?s=business">商家管理</a></li>
        <?php } ?>
        <?php if($o['show'] == 10000) { ?>
            <li<?php if($s == 'company') {echo ' class="active"';} ?>><a href="?s=company">总管理</a></li>
            <li<?php if($s == 'system') {echo ' class="active"';} ?>><a href="?s=system">系统</a></li>
        <?php } ?>
        <li style="float: right"><a href="/">返回琦益网首页</a></li>
        <br style="clear: both;" />
    </ul>
</div>
<div class="mian">
    <?php
    include_once('include/person/' . $s . '.php');
    ?>
</div>
</body>
</html>
<?php
function curPageURL()
{
    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on")
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80")
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }
    else
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
?>
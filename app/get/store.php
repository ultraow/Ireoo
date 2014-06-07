<?php
/**
 * Created by PhpStorm.
 * User: s2
 * Date: 6/7/14
 * Time: 12:16 AM
 */
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
include_once('../../lib/mysql.class.php');
$mysql = new mysql;

if(isset($_POST)) {
    $_POST['uid'] = 123456789;
    $_POST['ip'] = getIP();
    $_POST['timer'] = time();

    print_r($_POST);
    if($mysql->insert('store', $_POST)) {
        echo '成功!';
    }else{
        echo mysql_error();
    }

}else{
    die('数据不存在!');
}



function getIP() {
    if (@$_SERVER["HTTP_X_FORWARDED_FOR"])
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    else if (@$_SERVER["HTTP_CLIENT_IP"])
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    else if (@$_SERVER["REMOTE_ADDR"])
        $ip = $_SERVER["REMOTE_ADDR"];
    else if (@getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (@getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (@getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else
        $ip = "unknown";
    return $ip;
}


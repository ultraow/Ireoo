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
    $_POST['GPS'] = '0, 0';
    $_POST['ZOOM'] = 12;

    //print_r($_POST);
    $s = array(
        'table' => 'store',
        'condition' => "sname = '{$_POST['sname']}' and city = '{$_POST['city']}'"
    );
    $r = $mysql->row($s);
    if(is_array($r)) {
        echo '[' . $_POST['sname'] . ']数据已经存在!';
    }else{
        if($mysql->insert('store', $_POST)) {
            echo '[' . $_POST['sname'] . ']数据保存成功!';
        }else{
            echo '[' . $_POST['sname'] . ']数据保存失败！失败代码：' . mysql_error();
        }
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


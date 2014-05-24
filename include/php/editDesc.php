<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-8-25
 * Time: 下午11:18
 * To change this template use File | Settings | File Templates.
 */
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
include_once("../../lib/mysql.class.php");
include_once("../../app/oauth/oauth2.php");

$mysql = new mysql();
$id = floor($_POST['sid']);
if(get_magic_quotes_gpc()){   //如果get_magic_quotes_gpc()是打开的
    $desc=stripslashes($_POST['desc']);  //将字符串进行处理
}else{
    $desc=$_POST['desc'];
}
$s = array(
    'desc' => $desc
);
//print_r($_POST);
$r1 = $mysql->update('store', $s, 'id=' . $id);
if($r1) {
    echo 1;
}else{
    echo '错误代码：' . mysql_error();
}





?>
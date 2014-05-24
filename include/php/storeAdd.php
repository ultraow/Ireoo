<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ultra
 * Date: 13-2-6
 * Time: 下午11:57
 * To change this template use File | Settings | File Templates.
 */
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
include_once("../../lib/mysql.class.php");
include_once("../../lib/user.class.php");
include_once("../../lib/store.class.php");
include_once("../../include/php/php.php");
include_once("../../app/oauth/oauth2.php");

//print_r($_POST);

if($o == '') die('未授权！');
if(!isset($_POST['`uid`']) or $_POST['`uid`'] == '') die('授权失败，无法创建圈圈！');
if(!isset($_POST['`sname`']) or $_POST['`sname`'] == '') die('请先输入您的圈圈名称！');


$mysql = new mysql();                                   //load mysql class

$store = new store($_POST);                             //load store class
$r = $store->ad($mysql);
if($r > 0) {
    die('创建圈圈成功！');
}else{
    die('创建圈圈失败，错误代码：[' . $r  . mysql_error() . ']');
}


?>
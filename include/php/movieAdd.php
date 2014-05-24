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
include_once("../../include/php/php.php");
include_once("../../app/oauth/oauth2.php");

//print_r($_POST);

if($o == '') die('未授权！');
if(!isset($_POST)) die('没有参数传递！');
//print_r($_POST);

$mysql = new mysql;
$players = $_POST['player'];
$type = $_POST['type'];
unset($_POST['player']);
unset($_POST['type']);


$l = array();
foreach($_POST as $key => $value) {
	$l["`$key`"] = $value;
}
print_r($l);
$r = $mysql->insert('movie', $l);
if(!$r) die('添加失败！错误代码: ' . mysql_error());
$mid = $r;
$zu = split("[,]", $players);
foreach($zu as $k => $v) {
	$zhi = array(
		'mid' => $mid,
		'uid' => $o['id'],
		'value' => $v
	);
	$r = $mysql->insert('movie_players', $zhi);
	if(!$r) die('添加失败！错误代码: ' . mysql_error());
}
$zu = split("[,]", $type);
foreach($zu as $k => $v) {
	$zhi = array(
		'mid' => $mid,
		'uid' => $o['id'],
		'value' => $v
	);
	$r = $mysql->insert('movie_type', $zhi);
	if(!$r) die('添加失败！错误代码: ' . mysql_error());
}
die('宝贝添加成功！');
/*
$mysql = new mysql();                                   //load mysql class

$store = new store($_POST);                             //load store class
$r = $store->ad($mysql);
if($r > 0) {
    die('创建圈圈成功！');
}else{
    die('创建圈圈失败，错误代码：[' . $r  . mysql_error() . ']');
}
*/
?>
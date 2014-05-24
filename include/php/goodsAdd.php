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

$l = array();
foreach($_POST as $key => $value) {
	if($key == 'desc' or $key == 'desc_txt') $value = strtr($value, array("\\" => ''));
	if($key == 'id') $gid = $value;
	if($key != 'props_name') {
		$l["`$key`"] = $value;
	}else{
		$canshu = $value;
	}
}

$r = $mysql->insert('goods', $l);
if(!$r) die('添加失败！错误代码: ' . mysql_error());

$zu = split(";", $canshu);
foreach($zu as $k => $v) {
	$l = split(":", $v);
	$key = $l[2];
	$value = $l[3];
	$zhi = array(
		'gid' => $gid,
		'uid' => $o['id'],
		'`key`' => $key,
		'`value`' => $value
	);
	$r = $mysql->insert('goods_mod', $zhi);
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
<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
include_once("../../app/oauth/oauth2.php");
include_once("../../lib/mysql.class.php");
include_once("../../lib/user.class.php");
include_once("php.php");

if(!isset($_SESSION['user'])) die('请先登陆');
if(!isset($_POST['txt'])) die('没有提交内容参数');
if(!isset($_POST['sid'])) die('没有提交ID');
if(trim($_POST['txt']) == '') die('内容不能为空');
if(trim($_POST['sid']) == '') die('商城ID不能为空');

$strtr = array(
    '<' => '&lt;',
    '>' => '&gt;',
    '"' => '”',
    "'" => '’'
);

$txt = strtr($_POST['txt'], $strtr);

$mysql = new mysql();
$user = new user();
$txt = array(
	'uid' => $_SESSION['user']['id'],
    'sid' => $_POST['sid'],
    'tid' => $_POST['tid'],
	'txt' => $txt,
    'img' => $_POST['img']
);
echo $user->say($mysql, $txt);

?>
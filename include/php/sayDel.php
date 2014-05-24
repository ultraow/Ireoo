<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ultra
 * Date: 13-2-5
 * Time: 下午8:09
 * To change this template use File | Settings | File Templates.
 */
include_once("../../app/oauth/oauth2.php");

if(!isset($_GET['id'])) die('未设置ID！');
if(!preg_match('/^[0-9]+$/', $_GET['id'])) die('ID只能设置为数字！');

include_once('../../lib/say.class.php');
include_once('../../lib/mysql.class.php');

$mysql = new mysql;
$id = $_GET['id'];
$say = new say;
if(!$say->del($mysql, $id)) {
    die('帖子删除失败,错误代码：[' . mysql_error() . ']');
}

die('帖子删除成功！');

?>
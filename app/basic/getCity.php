<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-9-7
 * Time: 下午4:34
 * To change this template use File | Settings | File Templates.
 */
header('Content-type:text/json');
include_once('../../lib/mysql.class.php');

$mysql = new mysql();
$s = array(
    'table' => 'region',
    'condition' => 'parent_id = ' . $_GET['id']
);
$r = $mysql->select($s);
echo json_encode($r);
?>
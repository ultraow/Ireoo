<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 13-12-8
 * Time: 下午1:51
 */

include_once('../../lib/mysql.class.php');

$mysql = new mysql();

$cardid = DATE('Ymd') . rand(1000, 9999) . rand(1000, 9999);

$sql = array(
    'table' => 'card',
    'condition' => 'sid = ' . $_GET['sid'] . ' and uid = ' . $_GET['uid'] . ' and lid = ' . $_GET['lid']
);
$result = $mysql->row($sql);

if(is_array($result)) {
    echo '{"card":"' . $result['card'] . '", "success":true}';
    exit();
}

$sql = array(
    'lid' => $_GET['lid'],
    'sid' => $_GET['sid'],
    'uid' => $_GET['uid'],
    'card' => $cardid,
    'timer' => time()
);

if(!$mysql->insert('card', $sql)) {
    $mysql->execute("UPDATE `cardList` SET `used` = `used` + 1 WHERE id = {$_GET['lid']}");
    echo '{"card":"' . $cardid . '", "success":true}';
}else{
    echo '{"error":"' . mysql_error() . '", "success":false}';
}

$sql = array(
    'card' => $cardid
);
$mysql->update('user', $sql, "id = {$_GET['uid']}");
<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 13-12-15
 * Time: 下午5:22
 */

session_start();
include_once('../../lib/mysql.class.php');

if(!isset($_SESSION['user'])) {
    echo json_encode(array('success'=>false, 'error'=>'请先登录后再关注!'));
    exit();
}

if($_GET['follow'] == 1) {

$mysql = new mysql;
$sql = array(
    'sid' => $_GET['id'],
    'uid' => $_SESSION['user']['id'],
    'timer' => time()
);

$re = $mysql->insert('follow', $sql);
if($re == 0) {
    die(json_encode(array('success'=>true, 'error'=>'亲爱的用户，您已经关注成功！', 'title'=>'取消关注')));
}else{
    die(json_encode(array('success'=>false, 'error'=>mysql_error())));
}

}else{

    $mysql = new mysql;
    if($mysql->delete('follow', "sid = '{$_GET['id']}' and uid = '{$_SESSION['user']['id']}'")) {
        die(json_encode(array('success'=>true, 'error'=>'亲爱的用户，从今以后，您再也不会即时获取该商家的任何信息！', 'title'=>'关注')));
    }else{
        die(json_encode(array('success'=>false, 'error'=>mysql_error())));
    }

}
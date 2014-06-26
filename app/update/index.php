<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-6-26
 * Time: 上午10:46
 */

//$store = $mysql->_count('`goods`');
header("Content-type: text/html; charset=utf-8");
include_once("../../lib/mysql.class.php");

$mysql = new mysql;

$s = array(
    'store' => $mysql->_count('`store`'),
    'goods' => $mysql->_count('`goods`'),
    'user' => $mysql->_count('`user`'),
    'timer' => time()
);

if($mysql->insert('system', $s)) {
    echo '系统数据已经更新';
}else{
    echo '系统数据更新失败，错误代码：' . mysql_error();
}

$s = array(
    'table' => 'form'
);
$f = $mysql->select($s);
$form = array();
foreach($f as $k => $v) {
    $form[$v['form']['id']] = $v['form']['value'];
}


foreach($form as $key => $value) {
    if($mysql->update('form', array('count' => $mysql->_count('`store`', "form = $key")), "id = $key")){
        echo $value . "数据更新完毕";
    }else{
        echo $value . "数据更新失败，错误才吗：" . mysql_error();
    }
}
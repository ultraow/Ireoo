<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-5-12
 * Time: 下午8:54
 */

if(!isset($o)) header("Location: /");

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        if(isset($_GET['m']) and $_GET['m'] == 'edit') {
            if($mysql->update('address', $_POST, 'id = ' . $_GET['id'])) {
                //$o = $user->getID($own, $o['id']);
            }else{
                echo mysql_error();
            }
        }elseif(isset($_GET['m']) and $_GET['m'] == 'del') {
            if($mysql->delete('address', 'id = ' . $_GET['id'])) {
                //$o = $user->getID($own, $o['id']);
            }else{
                echo mysql_error();
            }
        }elseif(isset($_GET['m']) and $_GET['m'] == 'default') {
            if($mysql->update('address', array('def' => 1), 'id = ' . $_GET['id'])) {
                //$o = $user->getID($own, $o['id']);
            }else{
                echo mysql_error();
            }
        }else{
            $_POST['uid'] = $o['id'];
            if($mysql->insert('address', $_POST)) {
                //$o = $user->getID($own, $o['id']);
            }else{
                echo mysql_error();
            }
        }

        $_SESSION['token'] = $_GET['token'];
    }
    header("Location: /i?s=person&i=address");
}

?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px;}
    div.mian ol li{font-size: 12px; padding-top: 5px; padding-bottom: 10px;}
    div.mian ol li a{font-size: 14px; cursor: pointer;}
    div.mian ol li a:hover{text-decoration: underline;}

    div.mian ol li label{display: inline-block; width: 100px; font-size: 12px; font-weight: bold; color: #000; padding: 5px; vertical-align: top;}
    div.mian ol li input{padding: 5px; font-size: 12px; width: 272px;}
    div.mian ol li input.check, div.mian ol li label.auto{width: auto;}
    div.mian ol li select.max{width: 212px;}
    div.mian ol li select{padding: 5px;}

    div.mian ol li ul.city{display: inline-block; width: 680px; margin-left: -4px; border: 1px solid #ffd88a; background: #FFE69F; padding: 10px;}
    div.mian ol li ul li{position: relative; display: inline-block; font-size: 14px; padding: 5px; cursor: pointer;}
    div.mian ol li ul li ul{position: absolute; display: none; left: 36px; top: 0; z-index: 3; width: 40px; border: 1px solid #4898F8; background: #FFF;}
    div.mian ol li ul li.hover{background: #4898F8; color: #FFF;}
    div.mian ol li ul li.hover ul{display: inline-block;}
    div.mian ol li ul li ul li{display: block; font-size: 12px;}
    div.mian ol li ul li ul li a{font-size: 12px;}
    div.mian ol li ul li ul li a:hover, div.mian ol li ul li ul li:hover a, div.mian ol li ul li ul li:hover{background: #4898F8; color: #FFF; text-decoration: none;}
    div.mian ol li ul h1{display: inline-block; border: none; font-size: 12px; font-weight: normal; color: #333; background: RGB(201, 201, 201); cursor: pointer;}

    textarea{width: 272px; padding: 5px; height: 80px;}
    button{padding: 5px 20px;}

    div.mian ol table{border-collapse: collapse; width: 100%;}
    div.mian ol table tr{margin-bottom: 10px;}
    div.mian ol table tr td{border: 1px #CCC solid; padding: 5px; font-size: 12px;}
    div.mian ol table thead tr td{background: #4898F8; color: #FFF; border-color: #4898F8;}
    div.mian ol table tr td.first{background: none; border: none; width: 40px; padding: 0;}
    div.mian ol table tr td.foot{background: none; border: none; width: 215px;}
    div.mian ol table tbody tr td a{padding: 3px; background: #4898F8; color: #FFF; cursor: pointer;}
    div.mian ol table tbody tr td img.headimg{width: 30px; height: 30px;}

    div.mian ol table tbody tr td span.red{color: red;}

</style>

<ol class="account">

    <h1>管理收藏夹</h1>
    <span class="h2"> </span>

</ol>

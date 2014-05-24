<?php
$id = $os['id'];

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        $r1 = $mysql->update('store', $_POST, "id = $id");
        //print_r($_POST);
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=store&i=storeAnalysis");
    }
}

$store = new store;
$s = $store->show($mysql, array('condition'=>"id = $id"));
$s = $s[0];

?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px;}
    div.mian ol table{border-collapse: collapse; width: 100%;}
    div.mian ol table, div.mian ol table tr, div.mian ol table tr td{border: 1px #CCC solid;}
    div.mian ol table tr td{padding: 5px; font-size: 12px;}
    div.mian ol table thead tr td{background: #CCC;}
    div.mian ol table tbody tr td a{padding: 3px; background: #4898F8; color: #FFF;}

    button{padding: 5px 20px;}
</style>

<ol>
      暂未开放
</ol>
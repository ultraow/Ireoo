<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-1-22
 * Time: 下午8:01
 */

if($o['show'] == 10000){}else{header("Location: /i?s=person");}
?>
<div class="myself">

    <?php

    if(!isset($_GET['i'])) {
        $page = 'user';
    }else{
        $page = $_GET['i'];
    }
    ?>
    <ul class="own">
        <h4>管理</h4>
        <a class="li<?php if($page == 'user') {echo ' on';} ?>" href="?s=company&i=user">用户管理</a>
        <a class="li<?php if($page == 'business') {echo ' on';} ?>" href="?s=company&i=business">商家管理</a>
        <a class="li<?php if($page == 'proxy') {echo ' on';} ?>" href="?s=company&i=proxy">代理管理</a>
        <h4>添加</h4>
        <a class="li<?php if($page == 'addProxy') {echo ' on';} ?>" href="?s=company&i=addProxy">添加代理</a>
    </ul>

</div>

<?php
include_once('include/person/company/' . $page . '.php');
?>

<div class="clear"></div>
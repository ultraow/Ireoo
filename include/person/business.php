<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-9-6
 * Time: 下午5:49
 * To change this template use File | Settings | File Templates.
 */
if($o['show'] == 3 or $o['show'] == 10000){}else{header("Location: /i?s=person");}
?>
<div class="myself">

    <?php

    if(!isset($_GET['i'])) {
        $page = 'index';
    }else{
        $page = $_GET['i'];
    }
    ?>
    <ul class="own">
        <a class="li<?php if($page == 'add') {echo ' on';} ?>" href="?s=business&i=add">添加商家</a>
        <a class="li<?php if($page == 'index') {echo ' on';} ?>" href="?s=business&i=index">商家管理</a>
        <h4>用户管理</h4>
        <a class="li<?php if($page == 'follow') {echo ' on';} ?>" href="?s=business&i=follow">用户管理</a>
        <a class="li<?php if($page == 'wcVIPManagement') {echo ' on';} ?>" href="?s=business&i=wcVIPManagement">微信用户</a>
    </ul>

</div>

<?php
include_once('include/person/business/' . $page . '.php');
?>

<div class="clear"></div>
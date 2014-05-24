<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-9-6
 * Time: 下午5:49
 * To change this template use File | Settings | File Templates.
 */
//if($o['show'] == 2 or $o['show'] == 3 or $o['show'] == 10000){}else{header("Location: /i?s=person");}
?>
<div class="myself">

    <?php
    $store = new store;
    $s = array(
        'condition' => 'uid = ' . $o['id']
    );
    //print_r($s);
    $quanquan = $store->show($mysql, $s);

    if(!isset($_GET['i'])) {
        $page = 'list';
    }else{
        $page = $_GET['i'];
    }
    ?>
    <ul class="own">

        <a class="li<?php if($page == 'list') {echo ' on';} ?>" href="?s=goods&i=list">产品管理</a>
        <a class="li<?php if($page == 'add') {echo ' on';} ?>" href="?s=goods&i=add">添加产品</a>

    </ul>
</div>

<?php
include_once('include/person/goods/' . $page . '.php');
?>

<div class="clear"></div>

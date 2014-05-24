<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-9-6
 * Time: 下午5:49
 * To change this template use File | Settings | File Templates.
 */

if($o['show'] == 1 or $o['show'] == 2 or $o['show'] == 3 or $o['show'] == 10000) {}else{header("Location: /i?s=person");}
if($os['wechat'] != '1') header("Location: /i?s=store&i=wxSetting");

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
        $page = 'wcVIPManagement';
    }else{
        $page = $_GET['i'];
    }
    ?>
    <ul class="own">
        <?php
        if(count($quanquan) > 0) {
            ?>
            <h4>会员功能</h4>
            <a class="li<?php if($page == 'wcVIPManagement') {echo ' on';} ?>" href="?s=wechat&i=wcVIPManagement">微信用户</a>
            <h4>扩展应用</h4>
            <a class="li<?php if($page == 'wcAPP') {echo ' on';} ?>" href="?s=wechat&i=wcAPP">添加应用</a>
        <?php
        }else{
            ?>
            <a class="li<?php if($page == 'storeAdd') {echo ' on';} ?>" href="?s=store&i=storeAdd">创建</a>
        <?php
        }
        ?>
    </ul>
</div>

<?php
include_once('include/person/wechat/' . $page . '.php');
?>

<div class="clear"></div>

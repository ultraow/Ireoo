<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-9-6
 * Time: 下午5:49
 * To change this template use File | Settings | File Templates.
 */
if($o['show'] == 1 or $o['show'] == 2 or $o['show'] == 3 or $o['show'] == 10000){}else{header("Location: /i?s=person");}
?>
<div class="myself">

    <?php
    $store = new store;
    $s = array(
        'condition' => 'uid = ' . $o['id']
    );
    //print_r($s);
    $quanquan = $store->show($mysql, $s);

    $goods = new goods;
    $baobei = $goods->getall($mysql, $o['id']);

    $movie = new movie;
    $dianying = $movie->getall($mysql, $o['id']);

    if(!isset($_GET['i'])) {
        if(count($quanquan) > 0) {
            $page = 'storeBid';
        }else{
            $page = 'storeAdd';
        }
    }else{
        $page = $_GET['i'];
    }
    ?>
    <ul class="own">
        <?php
        if(count($quanquan) > 0) {
            ?>
<!--            <a class="li--><?php //if($page == 'storeBid') {echo ' on';} ?><!--" href="?s=store&i=storeBid">竞价排名</a>-->
<!--            <h4>系统设置</h4>-->
            <a class="li<?php if($page == 'storeEditBasic') {echo ' on';} ?>" href="?s=store&i=storeEditBasic">基本信息</a>
            <a class="li<?php if($page == 'storeEditAvatar') {echo ' on';} ?>" href="?s=store&i=storeEditAvatar">头像设置</a>
            <a class="li<?php if($page == 'storeEditBg') {echo ' on';} ?>" href="?s=store&i=storeEditBg">背景设置</a>
            <a class="li<?php if($page == 'storeEditGPS') {echo ' on';} ?>" href="?s=store&i=storeEditGPS">地理位置</a>
            <a class="li<?php if($page == 'storeEditDesc') {echo ' on';} ?>" href="?s=store&i=storeEditDesc">企业简介</a>
<!--            <a class="li--><?php //if($page == 'wxSetting') {echo ' on';} ?><!--" href="?s=store&i=wxSetting">微信设置</a>-->
            <h4>内容管理</h4>
            <a class="li<?php if($page == 'storeNews') {echo ' on';} ?>" href="?s=store&i=storeNews">新闻动态</a>

<!--
            <h4>会员卡管理</h4>
            <a class="li<?php if($page == 'cardSetting') {echo ' on';} ?>" href="?s=store&i=cardSetting">卡片设置</a>
            <a class="li<?php if($page == 'storeCard') {echo ' on';} ?>" href="?s=store&i=storeCard">卡片管理</a>
-->
<!--            <h4>产品管理</h4>-->
            <a class="li<?php if($page == 'goodsAdd') {echo ' on';} ?>" href="?s=store&i=goodsAdd">添加产品</a>
            <a class="li<?php if($page == 'goodsList') {echo ' on';} ?>" href="?s=store&i=goodsList">产品管理</a>

            <h4>交易管理</h4>
            <a class="li<?php if($page == 'cart') {echo ' on';} ?>" href="?s=store&i=cart">已下订单</a>
            <a class="li<?php if($page == 'cartSuccess') {echo ' on';} ?>" href="?s=store&i=cartSuccess">交易完成</a>

            <h4>客服系统</h4>
            <a class="li<?php if($page == 'storeServer') {echo ' on';} ?>" href="?s=store&i=storeServer">客服管理</a>
            <a class="li<?php if($page == 'storeServerHistory') {echo ' on';} ?>" href="?s=store&i=storeServerHistory">历史信息</a>
            <h4>数据统计</h4>
            <a class="li<?php if($page == 'storeAnalysis') {echo ' on';} ?>" href="?s=store&i=storeAnalysis">数据分析</a>
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
include_once('include/person/store/' . $page . '.php');
?>

<div class="clear"></div>

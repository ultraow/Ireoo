<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-9-6
 * Time: 下午5:49
 * To change this template use File | Settings | File Templates.
 */
?>
<div class="myself">

    <?php


    if(!isset($_GET['i'])) {
        $page = 'account';
    }else{
        $page = $_GET['i'];
    }
    ?>
    <ul class="own">
        <a class="li<?php if($page == 'carte') {echo ' on';} ?>" href="http://w.ireoo.com/<?php echo $o['id']; ?>" target="_blank">微名片</a>
        <h4>资料设置</h4>
        <a class="li<?php if($page == 'account') {echo ' on';} ?>" href="?s=person&i=account">基本资料</a>
        <a class="li<?php if($page == 'avatar') {echo ' on';} ?>" href="?s=person&i=avatar">修改头像</a>
        <a class="li<?php if($page == 'password') {echo ' on';} ?>" href="?s=person&i=password">修改密码</a>
        <a class="li<?php if($page == 'spread') {echo ' on';} ?>" href="?s=person&i=spread">我的推广</a>
        <h4>资料管理</h4>
        <a class="li<?php if($page == 'photo') {echo ' on';} ?>" href="?s=person&i=photo">图片管理</a>
        <a class="li<?php if($page == 'address') {echo ' on';} ?>" href="?s=person&i=address">收货地址</a>
        <a class="li<?php if($page == 'favorites') {echo ' on';} ?>" href="?s=person&i=favorites">收藏夹</a>
        <a class="li<?php if($page == 'cart') {echo ' on';} ?>" href="?s=person&i=cart">购物车</a>
    </ul>

</div>

<?php
include_once('include/person/user/' . $page . '.php');
?>

<div class="clear"></div>
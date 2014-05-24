<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-2-17
 * Time: 上午10:15
 */

if($o['show'] == 3 or $o['show'] == 10000){}else{header("Location: /i?s=person");}
?>
<div class="myself">

    <?php

    if(!isset($_GET['i'])) {
        $page = 'wechat';
    }else{
        $page = $_GET['i'];
    }
    ?>
    <ul class="own">
        <a class="li<?php if($page == 'wechat') {echo ' on';} ?>" href="?s=system&i=index">微信信息</a>
    </ul>

</div>

<?php
include_once('include/person/system/' . $page . '.php');
?>

<div class="clear"></div>
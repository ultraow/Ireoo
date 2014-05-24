<style type="text/css">
        /*      div.g       */
    div.g{width: 300px; border: 5px #CCC solid; position: absolute; top: 24px; right: 44px;}
/*     div.g{position: fixed; top: 10px; right: 0px;} */

    div.g ul{margin-bottom: 5px;}
    div.g ul h1{font-size: 12px; font-weight: normal; color: #333; padding: 5px; background: #EBEBEB; border-top: 1px #CCC solid;}
    div.g ul li{border-top: 1px #EBEBEB solid; padding: 5px; overflow: auto;}
    div.g ul li.first{border-top: none;}
    div.g ul li div.con{float: right; width: 230px;}
    div.g ul li div.con div.txt{padding-top: 3px; color: #999; font-size: 12px;}
    div.g ul li div.con a{font-size: 12px; color: #666; line-height: 14px; padding-top: 3px;}
    div.g ul li div.con a:hover{text-decoration: underline;}
    div.g ul li div.con h2{font-size: 12px; padding-bottom: 1px;}
    div.g ul li div.con h2 a{font-size: 12px; line-height: 15px; color: #4898F8; padding: 0;}
    div.g ul li div.con h2 a{display: inline-block;}
    div.g ul li div.con h2 a:hover{text-decoration: underline;}

    /*      div.g ul.zanzhu      */
    div.g ul.zanzhu h2{font-size: 12px; margin-bottom: 6px;}
    div.g ul.zanzhu h2 a{font-size: 12px; color: #4898F8;}
    div.g ul.zanzhu h2 a:hover{text-decoration: underline;}
    div.g ul.zanzhu li{overflow: auto;}
    div.g ul.zanzhu li a.img{display: inline-block; width: 120px; height: 80px; position: relative; overflow: hidden; float: left;}
    div.g ul.zanzhu li a.img img{position: absolute; top: -20px;}
    div.g ul.zanzhu li div.txt{padding-left: 130px; color: #999; font-size: 12px; line-height: 16px;}



    div.g ul.fast li{padding: 0; margin: 0; border-top: none;}
    div.g ul.fast li a{font-size: 12px; display: block; padding: 5px; color: #4898F8;}
    div.g ul.fast li a:hover{text-decoration: none; background: RGB(239, 242, 247);}

    div.g ul.fast li a b{line-height: 16px;}
    div.g ul.fast li a b i{margin-right: 5px; float: left;}

    img.storeAvatar{width: 50px; height: 50px;}
</style>
<?php $store = new store; $r = $store->show($mysql, array('condition' => 'uid = ' . $o['id'], 'limit' => 'LIMIT 0, 6')); if(count($r) > 0) { ?>
<ul class="list">
    <h1>你可能感兴趣的圈圈</h1>
    <?php foreach($r as $k => $v) { ?>
    <li<?php if($k == 0) {echo ' class="first"';} ?>>
        <a href="<?php echo HOST_URL . $v['id']; ?>" title="<?php echo $v['sname']; ?>"><img class="storeAvatar" src="<?php echo $v['avatar_large']; ?>" /></a>
        <div class="con">
            <h2><a href="<?php echo HOST_URL . $v['id']; ?>"><?php echo $v['sname']; ?></a></h2>
            <div class="txt"><?php echo $v['synopsis']; ?></div>
            <a href="<?php echo HOST_URL . $v['id']; ?>">获取更多信息</a>
        </div>
    </li>
    <?php } ?>
</ul>
<?php } ?>

<!--
    <?php $store = new store; $r = $store->show($mysql, array('condition' => 'uid = ' . $o['id'], 'limit' => 'LIMIT 0, 2')); if(count($r) > 0) { ?>
    <ul class="list">
    	<h1>你可能感兴趣的宝贝</h1>
        <?php foreach($r as $k => $v) { ?>
        <a class="li<?php if($k == 2) {echo ' last';} ?>" href="<?php echo HOST_URL . $v['id']; ?>" title="<?php echo $v['sname']; ?>"><img src="<?php echo HOST_URL; ?>include/img.php?l=56&x=<?php echo $v['x']; ?>&y=<?php echo $v['y']; ?>&t=<?php echo $v['avatar']; ?>" /></a>
        <?php } ?>
    </ul>
    <?php } ?>
-->

<?php //$store = new store; $r = $store->show($mysql, array('condition' => 'uid = ' . $o['id'], 'limit' => 'LIMIT 0, 2')); if(count($r) > 0) { ?>
<ul class="list zanzhu">
    <h1>赞助链接</h1>
    <?php //foreach($r as $k => $v) { ?>
    <li class="first">
        <h2><a target="_blank" href="http://www.taobao.com/go/chn/tbk_channel/baby.php?pid=mm_27201356_3476513_11348994&eventid=101326
">淘宝家装频道</a></h2>
        <a class="img" target="_blank" href="http://www.taobao.com/go/chn/tbk_channel/baby.php?pid=mm_27201356_3476513_11348994&eventid=101326
" title="淘宝家装频道"><img style="width: 120px;" src="http://img1.tbcdn.cn/tfscom/T154xbXCNhXXXXXXXX.jpg" /></a>
        <div class="txt">打造第一居家达人馆，网罗更多创意极品和居家商品，为你共同打造属于你的浪漫满屋！</div>
    </li>
    <li>
        <h2><a target="_blank" href="http://www.taobao.com/go/chn/tbk_channel/lady.php?pid=mm_27201356_3476513_11349022&eventid=101345
">淘宝女装频道</a></h2>
        <a class="img" target="_blank" href="http://www.taobao.com/go/chn/tbk_channel/lady.php?pid=mm_27201356_3476513_11349022&eventid=101345
" title="淘宝女装频道"><img style="width: 120px;" src="http://img04.taobaocdn.com/bao/uploaded/i4/T17XHSXgRmXXcs5J75_055407.jpg_460x460.jpg" /></a>
        <div class="txt">淘宝最权威的女装风向标，集合了淘宝最热卖的优质商品，给买家带来全新的购物体验。</div>
    </li>
    <?php //} ?>
</ul>
<?php //} ?>

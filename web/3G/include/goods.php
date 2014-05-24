<style type="text/css">
    body{background: #EBEBEB;}
/*   goods     */
div.goods{padding: 2px 2px 10px 2px;}

div.goods a{display: block; cursor: pointer; box-shadow: 0 0 5px RGBA(0, 0, 0, 0.6); background: #FFF; overflow: hidden; margin: 0 5px 10px 5px; height: 110px;}
div.goods a:hover{box-shadow: 0 0 5px #4898F8;}
div.goods a img{width: 100px; height: 100px; float: left; margin: 5px 0 0 5px;}
div.goods a h1{font-size: 12px; padding: 5px; overflow: hidden; cursor: pointer; color: #000; text-decoration: none;}
div.goods a:hover h1{color: #000;}
</style>

<div class="goods">
    <?php
        $s = array(
            'table' => 'goods',
            'condition' => 'sid = ' . $this_store['id']
        );
        $r = $mysql->select($s);
        foreach($r as $k => $v) {
            $l = $v['goods'];
    ?>
        <a class="goods" style="border-left: 3px solid RGB(<?php echo rand(0, 255); ?>, <?php echo rand(0, 255); ?>, <?php echo rand(0, 255); ?>);" href="<?php echo HOST_URL . '3Ggoods.' . $l['id']; ?>"><img src="<?php echo $l['img']; ?>" /><h1><?php echo $l['title']; ?></h1></a>
    <?php } ?>
</div>
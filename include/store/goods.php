<style type="text/css">
/*   goods     */
div.goods ul{background: #FFF;}
div.goods ul li{float: left;}
div.goods ul li a{display: inline-block; width: 160px; padding: 10px; cursor: pointer;}

div.goods ul li a:hover{background: #fafafa;}

div.goods ul li a img{width: 160px; height: 160px; cursor: pointer;}
div.goods ul li a h1{display: inline-block; font-size: 14px; height: 24px; line-height: 24px; overflow: hidden; cursor: pointer; color: #333;}
div.goods ul li a:hover h1{color: #000;}

h1.t span{font-size: 12px; font-weight: normal; margin-left: 20px; color: #666;}
h1.t span b{color: #CCC; font-weight: normal;}
</style>
<div class="goods">

    <h1 class="t">产品<span><b>[</b> 共 <?php echo count($goods); ?> 个 <b>]</b></span></h1>

    <ul>
    <?php
        $s = array(
            'table' => 'goods',
            'condition' => 'sid = ' . $this_store['id']
        );
        $r = $mysql->select($s);
        foreach($r as $k => $v) {
            $l = $v['goods'];
            $img = explode(',', $l['img']);
            if(is_numeric($img[0])) {
                $url = "/image.{$img[0]}.160.160.1";
            }else{
                $url = $img[0];
            }
    ?>
        <li><a href="<?php echo HOST_URL . 'goods.' . $l['id']; ?>"><img width="160px" height="160px" src="<?php echo $url; ?>" /><h1><?php echo $l['title']; ?></h1></a></li>
    <?php } ?>
        <br class="clear" />
    </ul>
</div>
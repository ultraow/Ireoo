<style type="text/css">
    /*    index    */
    div.index{border: 1px #CCC solid; margin-bottom: 15px; background: #FFF;}/*float: left; width: 560px; */
    div.index ul{padding: 2px; position: relative;}

    div.index ul li h1{padding: 8px;}
    div.index ul li img{margin-top: 3px; margin-left: 3px;}

    div.index h1.t{font-family: "microsoft yahei"; font-size: 20px; line-height: 50px; height: 80px; border-bottom: 1px #CCC solid; padding-left: 10px;}
    div.index h1.t span{font-size: 12px; font-weight: normal; margin-left: 20px; color: #666;}
    div.index h1.t span b{color: #CCC; font-weight: normal;}

</style>

<div class="index">
    <h1 class="t">照片<span><b>[</b> 共 <?php echo count($photo); ?> 张 <b>]</b></span></h1>
    <ul>
        <li>
            <?php
            $timer = strtotime(date('Y-m-d'));
            $i = 0;
            if(is_array($photo)){ foreach($photo as $k => $v) {
                if($v['timer'] < $timer) {
                    echo '</li><li><h1>' . date('Y-m-d', $v['timer']) . '</h1>';
                    $i ++;
                    $timer = strtotime(date('Y-m-d', $v['timer']));
                }
                ?><a href="#"><img id="photo" rel="<?php echo $v['size']; ?>" src="<?php echo '/image.'.$v['id'].'.175.175.0'; ?>" /></a><?php }}else{echo '<li style="text-align: center; font-size: 12px; border: none;">管理员很懒，还没有上传照片！</li>';} ?>
        </li>
    </ul>
</div>
<script type="text/javascript" src="/app/box/box.class.js"></script>
<script type="text/javascript">
    $(function(){
        //box('img#photo');
    });
</script>
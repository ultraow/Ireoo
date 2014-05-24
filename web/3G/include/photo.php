<style type="text/css">
    /*    index    */
    div.index{margin-bottom: 15px; background: #FFF;}/*float: left; width: 560px; */
    div.index ul{padding: 2px; position: relative;}

    div.index ul li h1{padding: 2px 0 2px 2px; font-size: 16px;}
    div.index ul li img.photo{width: 25%;}

</style>
<script type="text/javascript">
    $(window).load(function() {
        $('img.photo').width($(window).width() * 0.25 - 5).height($('img.photo').width()).css({margin: '0 2px 4px 2px'});
    }).resize(function() {
            $('img.photo').width($(window).width() * 0.25 - 5).height($('img.photo').width()).css({margin: '0 2px 4px 2px'});
        });
</script>
<div class="index">
    <ul>
        <li>
            <?php
            $timer = 0;
            $i = 0;
            $photo = $store->getPhoto($mysql);
            if(is_array($photo)){ foreach($photo as $k => $v) {
                if($v['timer'] < $timer or $timer == 0) {
                    echo '</li><li><h1>' . date('Y-m-d', $v['timer']) . '</h1>';
                    $i ++;
                    $timer = strtotime(date('Y-m-d', $v['timer']));
                }
                ?><a href="#"><img class="photo" rel="<?php echo $v['size']; ?>" src="<?php echo '/image.'.$v['id'].'.175.175.0'; ?>" /></a><?php }}else{echo '<li style="text-align: center; font-size: 12px; border: none;">管理员很懒，还没有上传照片！</li>';} ?>
        </li>
    </ul>
</div>
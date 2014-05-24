<style type="text/css">
    div.mian{margin: auto; width: 1000px; padding-top: 10px;}
    div.mian div.speck{}

    div.show{float: left; width: 290px; background: #FFF;}
    div.show div.img{padding: 10px; border-bottom: 1px #EBEBEB solid;}
    div.show div.img img{width: 50px; float: left; margin-right: 5px;}
    div.show div.img h1{font-size: 20px; font-weight: bolder;}
    div.show div.img h2{font-size: 12px; font-weight: lighter; color: #555;}
    div.show ul{display: block;}
    div.show ul li{display: inline-block; width: 96px; float: left;}
    div.show ul li.money{border-right: 1px #EBEBEB solid;}
    div.show ul li.integral{border-right: 1px #EBEBEB solid;}
    div.show ul li.shoucang{}
    div.show ul li h1{font-size: 11px; font-weight: lighter; color: #8c9ca9; padding-top: 10px; text-align: center;}
    div.show ul li span{font-size: 18px; color: #4898F8; font-weight: bolder; padding-bottom: 10px; width: 100%; display: inline-block; text-align: center; overflow: hidden;}

    div.show ul a{display: block; padding: 3px 5px; border-radius: 3px; font-size: 12px; color: #333; line-height: 22px;}
    div.show ul a:hover{background: RGB(221, 222, 224);}

    div.show div.qiandao{padding: 10px; border-top: 1px #EBEBEB solid; background: #f6f6f6;}
    div.show div.qiandao button{font-size: 12px; padding: 10px 20px;}

    div.mian ol{width: 680px; background: #FFF; padding-bottom: 100px; margin: 0; float: right;}
    div.mian ol li{padding-top: 10px; padding-bottom: 10px; border-top: 1px #EBEBEB solid; overflow: auto;}
    div.mian ol li img{float: left; width: 50px; height: 50px;}
    div.mian ol li div{padding-left: 60px;}
    div.mian ol li div div.tweet{font-size: 14px; font-weight: normal; color: #000; padding: 0; line-height: 23px;}

    div.mian ol li div h2{font-size: 14px; display: block; margin-bottom: 5px; padding: 0; height: auto; line-height: normal;}
    div.mian ol li div h2 a{color: #000; font-size: 14px; font-weight: bold; font-family: 'microsoft yahei', 'Helvetica Neue';}
    div.mian ol li div h2 a:hover{text-decoration: underline; color: #555;}
    div.mian ol li div h2 span{margin-left: 10px;}
    div.mian ol li div h2 span a{color: #CCC; font-size: 12px; font-weight: lighter;}
    div.mian ol li div h2 span a span{margin: 0;}
    div.mian ol li div h2 span a:hover{color: #4898F8; text-decoration: none;}
    div.mian ol li div h2 span a:hover span{text-decoration: underline;}

    div.mian ol li div div.img{padding: 0; max-width: 303px; max-height: 303px; overflow: hidden;}
    div.mian ol li div div.img img{width: 100px; height: auto; float: left; margin-right: 1px; margin-bottom: 1px;}

    /*div.mian ol li div a.timer{float: right; margin-right: 5px; font-size:12px; font-style: normal; color: #CCC; cursor: pointer;}*/
    /*div.mian ol li div a.timer:hover{color: #666; text-decoration: underline;}*/

    div.mian ol li div em{font-style: normal; display: block; font-size: 12px; color: #999; padding-top: 10px;}
    div.mian ol li div em a{color: #4898F8;}
    div.mian ol li div em a:hover{text-decoration: underline;}
    div.mian ol li div em span div.hide{display: inline-block; padding: 0; margin: 0; font-size: 12px; color: #CCC;}
    div.mian ol li div em span div.hide a{font-size: 12px;}

    div.mian ol li.foot div{padding: 10px; margin: 5px; font-size: 12px; border: 1px #CCC solid; background: #EBEBEB; text-align: center;}

    a.del{color: #4898F8; text-decoration: none; display: inline-block; font-weight: bold; width: 15px; height: 15px; background: url("include/images/close.png") no-repeat 0 0; float: right;}
    a.del:hover{background-position: 0 -32px;}

</style>
<script type="text/javascript" src="include/js/title.js"></script>
<script type="text/javascript" src="include/js/saybox.js"></script>
<script type="text/javascript">
    $(function() {
        //alert($(window).width());
        if($(window).width() < 1100) $('div.g').hide();

        saybox('#saybox', 0, 0);

        $('a.del').click(
            function() {
                //alert($(this).attr('rel'));
                var li = $(this).parent().parent();
                //li.slideUp('slow');

                $.post('include/php/sayDel.php?id=' + $(this).attr('rel'), function(data) {
                    var div = $('<div />').css('position', 'fixed').css('background', 'RGBA(0, 0, 0, 0.9)').css('padding', '5px').css('color', '#FFF').css('font-size', '12px').css('width', 'auto').css('height', 'auto').css('max-width', '240px').text(data).hide().appendTo('body');
                    div.css('left', ($(window).width() - div.width())/2).css('top', ($(window).height() - div.height())/2).hide();

                    div.fadeIn('slow').delay(3000).fadeOut('slow');
                    //alert(data);
                    if(data == '帖子删除成功！') li.slideUp('slow');
                });
                return false;
            }
        ).hide().parent().parent().hover(
            function() {
                $(this).find('a.del').show();
            },
            function() {
                $(this).find('a.del').hide();
            }
        );
    });
</script>

<div class="show">

    <div class="img">

        <img src="<?php echo $o['avatar_large']; ?>" />
        <h1><?php echo $o['username']; ?></h1>
        <h2>@<?php echo $o['username']; ?></h2>
        <div class="clear"></div>
    </div>
    <ul>
        <li class="money">
            <h1>余额</h1>
            <span><?php echo $o['money']; ?></span>
        </li>
        <li class="integral">
            <h1>积分</h1>
            <span><?php echo $o['integral']; ?></span>
        </li>
        <li class="shoucang">
            <h1>收藏</h1>
            <span>0</span>
        </li>
        <div class="clear"></div>
        <?php $x=explode(".", $o['money']); ?>
    </ul>

    <div class="qiandao">
        <button>立即签到</button>
    </div>

</div>

<ol>

    <div id="saybox" class="speck"></div>

    <?
    include_once('lib/timer.class.php');

    $s = array(
        'table' => 'say',
        'condition' => "uid = {$o['id']}",
        'order' => 'id desc'
        //'limit' => 'LIMIT 0, 10'
    );
    $r = $mysql->select($s);
    //print_r($r);
    foreach($r as $k => $v) {
        $ge = false;
        $l = $v['say'];
        $s = array(
            'table' => 'user',
            'condition' => "id = {$l['uid']}"
        );
        $user = $mysql->row($s);
        if($l['sid'] > 0) {
            $s = array(
                'table' => 'store',
                'condition' => "id = {$l['sid']}"
            );
            $store = $mysql->row($s);
        }
        ?>
        <li>
            <img src="<?php echo $user['avatar']; ?>" /> <!-- . 'include/img.php?l=50&x=' . $user['x'] . '&y=' . $user['y'] . '&t='  -->
            <div>
                <?php if($l['uid'] == $o['id']) { ?><a class="del" title="删除帖子" rel="<?php echo $l['id']; ?>" href="?del=<?php echo $l['id']; ?>"></a><?php } ?>
                <h2><a href=""><?php echo $user['username']; ?></a><?php if($l['sid'] > 0) { ?><span><a href="<?php echo HOST_URL . $l['sid']; ?>">@<span><?php echo $store['sname']; ?></span></a></span><?php } ?></h2>
                <div class="tweet"><?php echo $l['txt']; ?></div>

                <?php $img = explode(',', $l['img']); if($img[0] != '') { ?>
                    <div class="img">
                        <?php
                        foreach($img as $k => $v) {
                            if(is_numeric($v)) {
                                $url = "/image.{$v}.100.100.0";
                            }else{
                                $url = $v;
                            }
                            ?>
                            <img src="<?php echo $url; ?>" />
                        <?php } ?>
                        <br class="clear" />
                    </div>
                <?php } ?>

                <em>
                <span>
					<a class="timer" rel="<?php echo date('Y年m月d日 H时i分', $l['timer']); ?>"><?php new timer($l['timer']); ?></a> 查看 <a href="http://t.ireoo.com/<?php echo $l['id']; ?>">详细信息</a>
                </span>
                </em>
            </div>
        </li>
    <?php } ?>
</ol>
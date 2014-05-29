<style type="text/css">
    div.mian{}
    div.mian div.speck{}

    div.mian ol{width: 700px;}
    div.mian ol li{padding: 10px; border: 1px #CCC solid; border-top: none; overflow: auto; background: #FFF;}
    div.mian ol li.first{border-top: 1px #CCC solid;}
    div.mian ol li img{float: left; width: 50px; height: 50px;}
    div.mian ol li div{padding-left: 60px;}
    div.mian ol li div div.tweet{font-size: 14px; font-weight: normal; color: #000; padding: 0; line-height: 23px;}

    div.mian ol li div div.img{padding: 0; max-width: 303px; max-height: 303px; overflow: hidden;}
    div.mian ol li div div.img img{width: 100px; height: auto; float: left; margin-right: 1px; margin-bottom: 1px;}

    div.mian ol li div h2{font-size: 14px; display: block; margin-bottom: 5px; padding: 0; height: auto; line-height: normal;}
    div.mian ol li div h2 a{color: #000; font-size: 14px; font-weight: bold; font-family: 'microsoft yahei', 'Helvetica Neue';}
    div.mian ol li div h2 a:hover{text-decoration: underline; color: #555;}
    div.mian ol li div h2 span{font-size: 12px; margin-left: 10px; color: #4898F8;}
    div.mian ol li div h2 span a{color: #FFF; font-size: 12px; font-weight: normal; background: #4898F8; padding: 2px 5px;}
    div.mian ol li div h2 span a:hover{background: #0055aa; color: #FFF; text-decoration: none;}

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
<script type="text/javascript" src="include/js/saybox.js"></script>
<script type="text/javascript">
    $(function() {
        //alert($(window).width());
        if($(window).width() < 1100) $('div.g').hide();

        saybox('#saybox', <?php echo $os['id']; ?>, 0);

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

<ol>
    <div id="saybox" class="speck"></div>
    <?
    include_once('lib/timer.class.php');

    $s = array(
        'table' => 'say',
        'condition' => "sid = {$os['id']}",
        'order' => 'id desc'
        //'limit' => 'LIMIT 0, 10'
    );
    $r = $mysql->select($s);
    //print_r($r);
    foreach($r as $k => $v) {
        $ge = false;
        $l = $v['say'];
        if($l['sid'] > 0) {
            $s = array(
                'table' => 'store',
                'condition' => "id = {$l['sid']}"
            );
            $store = $mysql->row($s);
        }
        ?>
        <li<?php if($k == 0) {echo ' class="first"';} ?>>
            <img src="<?php echo $store['avatar_large']; ?>" /> <!-- . 'include/img.php?l=50&x=' . $user['x'] . '&y=' . $user['y'] . '&t='  -->
            <div>
                <?php if($l['sid'] == $os['id']) { ?><a class="del" title="删除帖子" rel="<?php echo $l['id']; ?>" href="?del=<?php echo $l['id']; ?>"></a><?php } ?>

                <div class="tweet"><?php echo $l['txt']; ?></div>

                <?php $img = explode(',', $l['img']); if($img[0] != '') { ?>
                    <div class="img">
                        <?php foreach($img as $k => $v) { ?>
                            <img src="/image.<?php echo $v; ?>.100.100.0.jpg" />
                        <?php } ?>
                        <br class="clear" />
                    </div>
                <?php } ?>

                <em>
                <span>
					<a class="timer" rel="<?php echo date('Y年m月d日 H时i分', $l['timer']); ?>"><?php new timer($l['timer']); ?></a>
                </span>
                </em>
            </div>
        </li>
    <?php } ?>

</ol>
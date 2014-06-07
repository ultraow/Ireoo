<style type="text/css">
    /*    index    */
    div.index{border: 1px #CCC solid; margin-bottom: 15px; background: #FFF;}/*float: left; width: 560px; */
    div.index ul{padding: 10px; position: relative;}

    div.index ul li{padding-top: 15px; overflow: auto; border-bottom: 1px RGB(242, 242, 242) dashed; position: relative;}
    div.index ul li span.img{width: 60px; position: absolute; top: 15px; left: 0;}
    div.index ul li span.img img{width: 60px; height: 60px;}
    div.index ul li div{font-weight: normal; font-family: Arial, Helvetica, sans-serif; padding-left: 70px; position: relative;}

    div.index ul li div div.img{padding: 0; max-width: 609px; max-height: 609px; overflow: hidden;}
    div.index ul li div div.img img{float: left; height: auto; margin-bottom: 3px; margin-right: 3px;}

    div.index ul li div h1{font-size: 12px; margin-bottom: 10px;}
    div.index ul li div h1 a.name{color: #4898F8; text-decoration: none; font-size: 14px;}
    div.index ul li div h1 a.name:hover{text-decoration: underline;}
    div.index ul li div span{display: block; padding-bottom: 10px; font-size: 14px; color: #000;}
    div.index ul li div em{font-size: 12px; font-style: normal; display: block; color: #999;}
    div.index ul li div em a{color: #4898F8; text-decoration: none;}
    div.index ul li div em a:hover{text-decoration: underline;}
    div.index ul li div em span.hide{display: inline-block; clear: both; float: none; width: auto; padding: 0px; margin: 0px; line-height: normal; font-size: 12px; color: #CCC;}
    div.index ul li.me{background: #F1FAFE;}
    div.index ul li div span.bottom{color: #777; font-size: 12px; padding-top: 10px;}
    div.index ul li div span.bottom a{color: #4898F8; cursor: pointer;}
    div.index ul li div span.bottom a:hover{text-decoration: underline;}
    div.index ul li div span.bottom em{float: right; font-style: normal;}
    div.index ul li div span.bottom em i{padding-left: 5px; padding-right: 5px; color: #CCC;}
    div.index ul li a.close{display: none; position: absolute; top: 20px; right: 0; width: 14px; height: 14px; line-height: 14px; text-align: center; font-size: 14px; font-weight: bold; color: #CCC; cursor: pointer;}
    div.index ul li a.close:hover{background: #CCC; color: #FFF;}

    div.index ul div.copy{position: absolute; bottom: 0; left: 0; width: 560px; font-size: 60px; font-weight: 100; text-align: center; color: RGB(242, 242, 242); height: 100px; line-height: 100px;}

    a.del{color: #4898F8; text-decoration: none; display: inline-block; font-weight: bold; width: 15px; height: 15px; background: url("include/images/close.png") no-repeat 0 0; float: right;}
    a.del:hover{background-position: 0 -32px;}

    div.index h1.t{font-family: "microsoft yahei"; font-size: 20px; line-height: 50px; height: 80px; border-bottom: 1px #CCC solid; padding-left: 10px;}
    div.index h1.t span{font-size: 12px; font-weight: normal; margin-left: 20px; color: #666;}
    div.index h1.t span b{color: #CCC; font-weight: normal;}
</style>
<?php require_once('lib/timer.class.php'); ?>
<style type="text/css">
    li.say{position: relative;}
    li.say div{padding-left: 84px;}
    li.say img{top: 0; left: 0; position: absolute;}
</style>
<div class="index">
    <h1 class="t">动态<span><b>[</b> 共 <?php echo count($say); ?> 条 <b>]</b></span></h1>

    <ul>
        <?php if(is_array($say)){ foreach($say as $k => $v) { ?>
            <li>
        	<span class="img">
                <?php $user = new user; $u = $user->getID($mysql, $v['uid']); ?>
                <img src="<?php echo $u['avatar']; ?>" />
            </span>
                <div>
                <span>
                    <?php if($v['uid'] == $o['id']) { ?><a class="del" title="删除帖子" rel="<?php echo $v['id']; ?>" href="?del=<?php echo $v['id']; ?>"></a><?php } ?>
                    <h1><a class="name" href="#" id="user" rel="<?php echo $this_store['uid']; ?>"><?php echo $u['username']; ?></a></h1><?php echo html_entity_decode(htmlentities($v['txt'])); ?>
                </span>

                    <?php $img = explode(',', $v['img']); if($img[0] != '') { ?>
                        <div class="img">
                            <?php foreach($img as $k1 => $v1) { ?>
                                <img src="/image.<?php echo $v1; ?>.200.200.0.jpg" />
                            <?php } ?>
                            <br class="clear" />
                        </div>
                    <?php } ?>

                    <em>
                        <a class="timer" rel="<?php echo date('Y年m月d日，H时i分', $v['timer']); ?>"><?php new timer($v['timer']); ?></a> 查看 <a href="http://www.ireoo.com/w/<?php echo $v['id']; ?>">详细信息</a>
                    </em>
                </div>
                <br />
            </li>
        <?php }}else{echo '<li style="text-align: center; font-size: 12px; border: none;">暂无信息</li>';} ?>
    </ul>
</div>

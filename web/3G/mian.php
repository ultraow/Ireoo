<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 13-12-31
 * Time: 下午5:02
 */
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
require_once("../../lib/mysql.class.php");
require_once("../../lib/user.class.php");
require_once("../../lib/store.class.php");


if(!isset($_GET['id'])) header('Location: '.HOST_URL.'1');
$id = intval($_GET['id']);
//获取当前ID
$mysql = new mysql();                                   //load mysql class
$store = new store(array('id' => $id));                 //load store class

//$store->browse();

$user = new user();                                     //加载新用户
$this3G = $store->show3G($mysql);
//if(!is_array($thisM)) header('Location: ' . HOST_URL . '3G');

if(isset($_GET['openid']) and isset($_GET['wid'])) {
    $_SESSION['openid'] = $_GET['openid'];
    $_SESSION['wid'] = $_GET['wid'];
    $s = array(
        'table' => 'userToWechat',
        'condition' => "openid = '{$_SESSION['openid']}' and wid = '{$_SESSION['wid']}'"
    );
    $r = $mysql->row($s);
    //print_r($r);
    if(is_array($r)) {
        $_SESSION['user']['id'] = $r['uid'];
        $mysql->update('wechat', array('uid' => $r['uid']), "openid = '" . $_SESSION['openid'] . "' and wid = '" . $_SESSION['wid'] . "'");
        //echo '获取用户信息' . "openid = '" . $_SESSION['openid'] . "' and wid = '" . $_SESSION['wid'] . "'";
        //header('Location: '.$_GET['url']);
    }
}
require_once("../../include/php/php.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo HOST_NAME; ?></title>
    <meta name="keywords" content="<?php echo KEYWORDS; ?>" />
    <meta name="description" content="<?php echo DESCRIPTION; ?>" />
    <link href="<?php echo HOST_URL; ?>web/3G/css/mian.css" rel="stylesheet" type="text/css">
    <script src="<?php echo HOST_URL; ?>include/js/jquery.js"></script>
    <script src="<?php echo HOST_URL; ?>include/js/jquery.mobile.js"></script>
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/changeSize.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            //size(<?php echo $_GET['id']; ?>, '3g');

            $('div.ui-loader').hide();

            var w = 0;
            $(window).resize(function() {
                resize();
                w = $(window).width();
            });
            resize();

            var imgOn = false;
            var imgX = 0;
            var imgs = [];
            w = $(window).width();
            $('div.background').width(w);
            $('div.background div.one').each(function(i) {
                imgs[i] = $(this);
                $(this).width(w).hide();
                //alert(i + ' : ' + $(this).attr('src'));
            }).on("swiperight", function(e){
                    if(imgs.length > 1) {
                        clearInterval(timer);
                        sright();
                        timer = setInterval(sleft, 3000);
                    }
                }
            ).on("swipeleft", function(e){
                    if(imgs.length > 1) {
                        clearInterval(timer);
                        sleft();
                        timer = setInterval(sleft, 3000);
                    }
                }
            );
            var now = 0;
            imgs[0].show();
            function sleft() {
                if(imgs.length > 1) {
                    var p = now - 1;
                    if(p<0) p = imgs.length - 1;
                    imgs[p].hide();
                    imgs[now].css({zIndex: '4'}).animate({left:-w + 'px'}, 1000);

                    now = now + 1;
                    if(now >= imgs.length) {
                        now = 0;
                        imgs[now].css({zIndex: '3', left: w+'px'}).show().animate({left: '0px'}, 1000);
                    }else{
                        imgs[now].css({zIndex: '3', left: w+'px'}).show().animate({left: '0px'}, 1000);
                    }
                    resize();
                }
            }
            function sright() {
                if(imgs.length > 1) {
                    var p = now + 1;
                    if(p >= imgs.length) p = 0;
                    imgs[p].hide();
                    imgs[now].css({zIndex: '4'}).animate({left: w + 'px'}, 1000);

                    now = now - 1;
                    if(now < 0) {
                        now = imgs.length - 1;
                        imgs[now].css({zIndex: '3', left: -w+'px'}).show().animate({left: '0px'}, 1000);
                    }else{
                        imgs[now].css({zIndex: '3', left: -w+'px'}).show().animate({left: '0px'}, 1000);
                    }
                    resize();
                }
            }

            var timer = setInterval(sleft, 3000);
        });


        function resize() {  //全屏幻灯片使用
            $('body').height($(window).height());
            $('div.background.style0').height($(window).height()).width($(window).width());
            $('div.background.style0 div.one').height($(window).height()).each(function() {
                img = $(this).width($(window).width()).find('img');
                img.css({top: ($(window).height() - img.height())/2});
            });
        }
    </script>
</head>
<body>

<div class="background style<?php echo $this3G['imgt']; ?>">
    <?php
    $images = explode(',', $this3G['imgs']);
    if(count($images)==0 or !is_array($images)) {
        $images = array(
            '/uploads/background/default.jpg',
            '/uploads/background/default1.jpg',
            '/uploads/background/default2.jpg'
        );
    }
    foreach($images as $key => $v) {
    ?>
    <div class="one"><img src="<?php echo $v; ?>" /></div>
    <?php } ?>
</div>

<ul class="meun style0">
    <li><a target="_blank" href="3G<?php echo $id; ?>?openid=<?php echo $_GET['openid']; ?>&wid=<?php echo $_GET['wid']; ?>"><img src="" /><span>简介</span></a></li>
    <li><a target="_blank" href="3G<?php echo $id; ?>?i=comment&openid=<?php echo $_GET['openid']; ?>&wid=<?php echo $_GET['wid']; ?>"><img src="" /><span>动态</span></a></li>
    <li><a target="_blank" href="3G<?php echo $id; ?>?i=photo&openid=<?php echo $_GET['openid']; ?>&wid=<?php echo $_GET['wid']; ?>"><img src="" /><span>相册</span></a></li>
    <li><a target="_blank" href="3G<?php echo $id; ?>?i=goods&openid=<?php echo $_GET['openid']; ?>&wid=<?php echo $_GET['wid']; ?>"><img src="" /><span>产品</span></a></li>
    <li><a target="_blank" href="3G<?php echo $id; ?>?i=card&openid=<?php echo $_GET['openid']; ?>&wid=<?php echo $_GET['wid']; ?>"><img src="" /><span>会员卡</span></a></li>
</ul>

<div class="foot">
    © 2014 <strong>新益信息科技</strong> 技术支持
</div>
<?php include('include/foot.php'); ?>
</body>
</html>
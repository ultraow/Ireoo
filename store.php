<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
require_once("lib/mysql.class.php");
require_once("lib/user.class.php");
require_once("lib/store.class.php");
require_once("include/php/php.php");

include_once("lib/runtime.class.php");
$run = new runtime();
$run->start();

if(!isset($_GET['id'])) header('Location: '.HOST_URL.'1');
$id = intval($_GET['id']);
//获取当前ID
$mysql = new mysql();                                   //load mysql class
$store = new store(array('id' => $id));                 //load store class

//$store->browse();

$user = new user();                                     //加载新用户
$this_store = $store->show_one($mysql);
if(!is_array($this_store)) header('Location: ' . HOST_URL . 'store');
//获取当前ID的店面基本信息
$admin = $user->getID($mysql, $this_store['uid']);
//获取该店管理员身份
//print_r($this_store);

$mysql->execute("UPDATE `store` SET `count` = `count` + 1 WHERE id = {$_GET['id']}");

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php if($this_store['id'] != 1) {echo $this_store['sname'] . ' - ' ;} echo HOST_NAME; ?></title>
    <meta name="keywords" content="<?php echo $this_store['sname'] . '，' . KEYWORDS; ?>" />
    <meta name="description" content="<?php if($this_store['synopsis'] != '-' and $this_store['synopsis'] != '') {echo $this_store['synopsis'];}else{echo DESCRIPTION;} ?>" />
    <link href="<?php echo HOST_URL; ?>include/css/head.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/store.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/foot.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/title.js"></script>
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/changeSize.js"></script>
    <script type="text/javascript">
        $(function() {

            size(<?php echo $_GET['id']; ?>, 'index');
            $('a.del').click(
                function() {
                    var li = $(this).parent().parent().parent();
                    //li.slideUp('slow');
                    $.post('include/sayDel.php?id=' + $(this).attr('rel'), function(data) {
                        var div = $('<div />').css('position', 'fixed').css('background', 'RGBA(0, 0, 0, 0.9)').css('padding', '5px').css('color', '#FFF').css('font-size', '12px').css('width', 'auto').css('height', 'auto').css('max-width', '240px').text(data).hide().appendTo('body');
                        div.css('left', ($(window).width() - div.width())/2).css('top', ($(window).height() - div.height())/2).hide();

                        div.fadeIn('slow').delay(3000).fadeOut('slow');
                        //alert(data);
                        if(data == '帖子删除成功！') li.slideUp('slow');
                    });
                    return false;
                }
            );

            $('ul.waring li.right button').click(function() {
                var follow = 1;
                var button = $(this);
                if($(this).text() == '取消关注') follow = 0;
                $.getJSON('include/php/follow.php?id=<?php echo $_GET['id']; ?>&follow=' + follow, function(data) {
                    if(data.success) {
                        alert(data.error);
                        button.text(data.title);
                        if(data.title == '关注') {
                            $('span#follow').text(parseInt($('span#follow').text()) - 1);
                        }else{
                            $('span#follow').text(parseInt($('span#follow').text()) + 1);
                        }
                    }else{
                        alert(data.error);
                    }
                });
            });
        });
    </script>

    <!--    <script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21390994"></script>  淘宝链接 -->
</head>
<body>
<?php require_once("include/php/head.php"); ?>
<div class="x">

    <div class="shead">
        <div class="avatar">
            <span class="img" id="editimg"><img src="<?php echo $this_store['avatar_large']; ?>" /></span>
        </div>
        <div class="name">
            <h1><?php echo $this_store['sname']; ?><?php if($this_store['show'] == 1) {echo '<i class="Icon Icon--verified Icon--small" style="color: #4898F8; font-size: 20px; margin-left: 10px;"></i>';} ?></h1>
        </div>
        <div class="b">
            <img src="<?php echo $this_store['bg']; ?>" />
        </div>

    </div>
</div>

<?php
$followsql = array(
    'table' => 'follow',
    'condition' => "sid = '{$_GET['id']}' and uid = '{$o['id']}'"
);
$followre = $mysql->row($followsql);
$followsql = array(
    'table' => 'follow',
    'condition' => "sid = '{$_GET['id']}'"
);
$followMember = $mysql->select($followsql);
$follow = is_array($followre);
?>

<div class="mian">



    <div class="show">
        <ul class="m">
            <a class="first" href="/store.<?php echo $this_store['id']; ?>.html">简介</a><a href="/store.<?php echo $this_store['id']; ?>.html?i=comment">动态<span><?php $say = $store->getSay($mysql); if(is_array($say)) {if(count($say) <= 99) {echo count($say);}else{echo '99+';}}else{echo 0;} ?></span></a><a href="/store.<?php echo $this_store['id']; ?>.html?i=photo">照片<span><?php $photo = $store->getPhoto($mysql);  if(is_array($photo)) {if(count($photo) <= 99) {echo count($photo);}else{echo '99+';}}else{echo 0;} ?></span></a><a href="/store.<?php echo $this_store['id']; ?>.html?i=goods">宝贝<span><?php $goods = $store->getGoods($mysql);  if(is_array($goods)) {if(count($goods) <= 99) {echo count($goods);}else{echo '99+';}}else{echo 0;} ?></span></a>
        </ul>
        <?php
        if(isset($_GET['i'])) {
            $index = $_GET['i'];
        }else{
            $index = 'index';
        }
        include_once('include/store/' . $index . '.php');
        ?>
    </div>

    <div class="right">
        <ul class="waring">
            <!-- <li>关注人数：<span id="follow"><?php //echo count($followMember); ?></span></li> -->
            <li>已经有 <span><?php echo $this_store['count'] + 1; ?></span> 人浏览过该页面。</li>
            <!-- <li class="right"><?php //if($follow) {echo '<button>取消关注</button>';}else{echo '<button>关注</button>';} ?></li>
                <li class="right">关注我们，领取会员卡，获得更多优惠！  </li> -->
        </ul>
    </div>

    <br class="clear" />
</div>


<br class="clear" />
<?php require_once("include/php/foot.php"); ?>
</body>
</html>

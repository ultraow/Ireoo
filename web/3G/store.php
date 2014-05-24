<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
require_once("../../lib/mysql.class.php");
require_once("../../lib/user.class.php");
require_once("../../lib/store.class.php");
require_once("../../include/php/php.php");
if(isset($_GET['openid']) and isset($_GET['wid'])) {
    $_SESSION['openid'] = $_GET['openid'];
    $_SESSION['wid'] = $_GET['wid'];
}
//if(!is_array($o)) header('Location: http://'.$_SERVER['HTTP_HOST'].'/3Glogin');

if(!isset($_GET['id'])) header('Location: '.HOST_URL.'1');
$id = intval($_GET['id']);
//获取当前ID
$mysql = new mysql();                                   //load mysql class
$store = new store(array('id' => $id));                 //load store class

//$store->browse();

$user = new user();                                     //加载新用户
$this_store = $store->show_one($mysql);
if(!is_array($this_store)) header('Location: ' . HOST_URL . 's');
//获取当前ID的店面基本信息
$admin = $user->getID($mysql, $this_store['uid']);
//获取该店管理员身份
//print_r($this_store);

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
    <link href="<?php echo HOST_URL; ?>web/3G/css/store.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/foot.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/title.js"></script>
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/changeSize.js"></script>
    <script type="text/javascript">
        $(function() {

            size(<?php echo $_GET['id']; ?>, '3g');

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
        });
    </script>
</head>
<body>
<?php include("../../include/php/head.php"); ?>

<div class="mian">
    <div class="shead">
        <div class="avatar">
            <span class="img" id="editimg"><img src="<?php echo $this_store['avatar_large']; ?>" /></span>
        </div>
        <div class="name">
            <h1><?php echo $this_store['sname']; ?></h1>
        </div>
        <div class="b">
            <img src="<?php echo $this_store['bg']; ?>" />
        </div>
        <ul class="m">
            <a href="/3G<?php echo $this_store['id']; ?>">简介</a><a href="/3G<?php echo $this_store['id'] . '?i=comment'; ?>">动态</a><a href="/3G<?php echo $this_store['id'] . '?i=photo'; ?>">照片</a><a href="/3G<?php echo $this_store['id'] . '?i=goods'; ?>">产品</a>
        </ul>
    </div>

    <?php
    if(isset($_GET['i'])) {
        $index = $_GET['i'];
    }else{
        $index = 'index';
    }
    include_once('include/' . $index . '.php');
    ?>
</div>

<?php include('../../include/php/foot.php'); ?>
</body>
</html>

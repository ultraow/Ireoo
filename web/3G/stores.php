<?php
date_default_timezone_set("PRC");
session_start();
require_once("../../lib/mysql.class.php");
require_once("../../lib/user.class.php");
require_once("../../lib/store.class.php");
require_once("../../lib/keyword.class.php");
require_once("../../include/php/php.php");
//if(!is_array($o)) header('Location: http://'.$_SERVER['HTTP_HOST'].'/3Glogin');
include_once("../../lib/runtime.class.php");
$run = new runtime();
$run->start();

$store = new store();
$mysql = new mysql();

$now = 1;
$show = 20;
if(isset($_GET['y'])) {
    $now = $_GET['y'];
}
$from = ( $now - 1 ) * $show;
$s = array('limit' => "LIMIT $from, $show");

//当前页面页数操作

$k = '';
if(isset($_GET['k'])) {
    $k = htmlentities($_GET['k'], ENT_QUOTES, "UTF-8");
    if($k == '') header('Location: ' . HOST_URL . 's');
}
$kw = new keyword($k);
$kw->ad($mysql);
$keyword = $kw->show($mysql);
//关键词操作

$top_sql = array('limit' => "LIMIT 0, 5");
$tops = $store->show($mysql, $top_sql);
//获取推荐

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php if($k != '') {echo $k.'_搜索';} ?><?php echo HOST_NAME; ?></title>
    <meta name="keywords" content="<?php if($k != '') {echo $k;} echo '|' . KEYWORDS; ?>" />
    <meta name="description" content="<?php echo DESCRIPTION; ?>" />
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/jquery.js"></script>
    <link href="<?php echo HOST_URL; ?>include/css/head.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>web/3G/css/stores.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/foot.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/changeSize.js"></script>
    <!-- <script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21390994"></script> -->
    <script type="text/javascript">
        $(function() {

            size(0, '3g');

            $('form input').hover(function() {
                    $(this).addClass('hover');
                },
                function() {
                    $(this).removeClass('hover');
                }).focus(function(e) {
                    $(this).addClass('focus');
                }).blur(function(e) {
                    $(this).removeClass('focus');
                });

            $('form button').hover(function() {
                    $(this).addClass('hover');
                },
                function() {
                    $(this).removeClass('hover');
                }).focus(function(e) {
                    $(this).addClass('focus');
                }).blur(function(e) {
                    $(this).removeClass('focus');
                });

        });
    </script>
</head>
<body>
<?php require_once("../../include/php/head.php"); ?>

<div class="mian">

    <div class="news">

        <ul class="if">
            <li>
                <label>分类：</label>
                <?php
                foreach($form as $k => $v) {
                    echo "<a href='$k'>$v</a>";
                }
                ?>
            </li>
        </ul>

        <?php if(isset($_GET['k'])) { ?>
            <div class="tags">
                你是不是想找：
                <?php foreach($keyword as $k => $v) { ?>
                    <a href="<?php echo HOST_URL; ?>s?k=<?php echo $v['keyword']; ?>"><?php echo $v['keyword']; ?></a>
                <?php } ?>
            </div>
        <?php } ?>

        <ul class="nlist">
            <?php foreach($store->show($mysql, $s) as $k => $v) {
                ?>
                <li<?php // if($k % 2 == 1) {echo ' class="odd"';} ?>>
                    <a class="img" href="<?php echo HOST_URL; ?><?php echo $v['id']; ?>"><img src="<?php echo $v['avatar_large']; ?>" /></a>
                    <div class="con">
                        <h1><a href="<?php echo HOST_URL; ?><?php echo $v['id']; ?>"><?php echo $v['sname']; ?></a></h1>
                        <?php $_user = new user; $u = $_user->getID($mysql, $v['uid']); ?>
                        <ul>
                            <li>
                                <?php if($v['address'] != '') { ?><?php echo $v['address']; ?><?php } ?><br />
                                发布人<a href="?author=<?php echo $u['id']; ?>"><?php echo $u['username']; ?></a><br />
                                <?php $st = new store(array('id' => $v['id']));?>
                            </li>
                        </ul>
                    </div>

                    <br class="clear" />
                </li>
            <?php } ?>
        </ul>
        <?php
        $z = ceil(count($store->show($mysql, array('limit'=>'')))/$show);
        ?>
        <div class="page">
            <?php if($now != 1) { ?><a class="max" href="?y=<?php echo $now-1; ?>">上一页</a><?php } ?>
            <?php for($i=1; $i<=$z; $i++) { ?>
                <?php if($i == $now) { ?>
                    <span><?php echo $i; ?></span>
                <?php }else{ ?>
                    <a href="?y=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php }} ?>
            <?php if($now != $z) { ?><a class="max" href="?y=<?php echo $now+1; ?>">下一页</a><?php } ?>
        </div>

        <div class="clear"></div>
    </div>
</div>

<?php include('../../include/php/foot.php'); ?>
</body>
</html>

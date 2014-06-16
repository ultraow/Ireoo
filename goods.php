<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-1-16
 * Time: 上午9:55
 */

$id = $_GET['id'];

header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
require_once("lib/mysql.class.php");
require_once("lib/user.class.php");
require_once("lib/store.class.php");
require_once("lib/goods.class.php");
require_once("include/php/php.php");

include_once("lib/runtime.class.php");
$run = new runtime();
$run->start();

$mysql = new mysql;
$goods = new goods;
$this_goods = $goods->getOne($mysql, $id);
//print_r($this_goods);

if(isset($_GET['put']) and $_GET['put'] == 'yes') {
    if(isset($_SESSION['user'])) {
    $s = array(
        'sid' => $this_goods['sid'],
        'gid' => $id,
        'uid' => $o['id'],
        'member' => 1,
        'money' => $this_goods['rebate']
    );
    if($mysql->insert('cart', $s)) {
        echo '<script>alert("已将此产品放入购物车！");</script>';
        //header("Location: /goods." . $id);
    }
    }else{
        echo '<script>alert("请先登录！");</script>';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php if($this_store['id'] != 1) {echo $this_goods['title'] . ' - ' ;} echo HOST_NAME; ?></title>
    <meta name="keywords" content="<?php echo $this_goods['title'] . '，' . KEYWORDS; ?>" />
    <meta name="description" content="<?php if($this_goods['synopsis'] != '-' and $this_goods['synopsis'] != '') {echo $this_goods['synopsis'];}else{echo DESCRIPTION;} ?>" />
    <link href="<?php echo HOST_URL; ?>include/css/head.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/goods.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/foot.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/jquery.js"></script>
    <script type="text/javascript">
        if($(window).width() < 600) {
            location.href = 'http://mobile.ireoo.com/goods.<?php echo $id; ?>';
        }
    </script>
</head>
<body>
<?php require_once("include/php/head.php"); ?>
<div class="head">

    <div class="goods">
        <div class="img">
            <?php
            $img = explode(",", $this_goods['img']);
            if(is_numeric($img[0])) {
                $url = "/image.{$img[0]}.400.400.1";
            }else{
                $url = $img[0];
            }
            ?>
            <img width="400px" height="400px" src="<?php echo $url; ?>" />
        </div>

        <h1><?php echo $this_goods['title']; ?></h1>
        <ul class="mode">
            <li><label>售价</label>
                <ul>
                    <li class="nowMoney">¥<?php echo $this_goods['rebate']; ?></li>
                    <li>原价：¥<span class="money"><?php echo $this_goods['money']; ?></span></li>
                </ul>
            </li>

        </ul>
        <ul class="pay">
            <li><a class="pay" href="?pay=yes">立即购买</a><a class="cart" href="?put=yes">放入购物车</a><a class="jb" target="_blank" href="/jubao.php?id=<?php echo $_GET['id']; ?>">举报虚假信息!?</a></li>
            <!-- <li><a class="like" href="#">赞 (1234)</a><a class="like" href="#">收藏 (123)</a></li> -->
        </ul>
    </div>

    <div class="history">
        <ul>
            <?php
            $s = array(
                'table' => 'goods',
                'limit' => 'LIMIT 0, 2'
            );
            $list = $mysql->select($s);
            foreach($list as $key => $value) {
                $v = $value['goods'];
                $img = explode(',', $v['img']);
                if(is_numeric($img[0])) {
                    $url = "/image.{$img[0]}.400.400.1";
                }else{
                    $url = $img[0];
                }
            ?>
            <li>
                <a target="_blank" href="/goods.<?php echo $v['id']; ?>"><img src="<?php echo $url; ?>" /></a>
                <h1><?php echo $v['rebate']; ?></h1>
            </li>
            <?php } ?>
        </ul>
    </div>
    <br class="clear" />
</div>
<div class="com">

    <div class="compay">
        <?php
        $store = new store(array('id' => $this_goods['sid']));
        $this_store = $store->show_one($mysql);
        ?>
        <ul>
            <h1>归属</h1>
            <li>品牌：<a target="_blank" href="/<?php echo $this_store['id']; ?>"><?php echo $this_store['sname']; ?></a></li>
            <li>厂家：<?php echo $this_store['address']; ?></li>
            <li>联系电话：<?php echo $this_store['phone']; ?></li>
        </ul>

        <ul>
            <h1>客服</h1>
            <li>售前：</li>
            <li>售后：</li>
            <li>维护：</li>
        </ul>

        <ul style="padding: 0; border: none;">
            <script> var dsaid=40076; var dwidth=200; var dheight=200; </script> <script type="text/javascript" src="http://unionjs.dianxin.com/showPic.js" name="showpic" charset="utf-8" ></script>
        </ul>

    </div>

    <div class="synopsis">
        <h1>详细介绍</h1>
        <?php echo $this_goods['synopsis']; ?>
        <script> var dsaid=40083; var dwidth=960; var dheight=90; </script> <script type="text/javascript" src="http://unionjs.dianxin.com/showPic.js" name="showpic" charset="utf-8" ></script>
    </div>
    <br class="clear" />
</div>

<?php require_once("include/php/foot.php"); ?>
</body>
</html>

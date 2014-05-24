<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-1-30
 * Time: 下午3:05
 */

$id = $_GET['id'];

header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
require_once("../../lib/mysql.class.php");
require_once("../../lib/user.class.php");
require_once("../../lib/store.class.php");
require_once("../../lib/goods.class.php");
require_once("../../include/php/php.php");

include_once("../../lib/runtime.class.php");
$run = new runtime();
$run->start();

$mysql = new mysql;
$goods = new goods;
$this_goods = $goods->getOne($mysql, $id);
//print_r($this_goods);

$this_goods['like'] = rand(100, 1000);
$this_goods['keep'] = rand(100, 1000);

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
    <link href="<?php echo HOST_URL; ?>web/3G/css/goods.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/foot.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/jquery.js"></script>
    <script type="text/javascript">
        if($(window).width() > 600) {
            location.href = '/goods.<?php echo $id; ?>';
        }
    </script>
</head>
<body>
<?php require_once("../../include/php/head.php"); ?>
<div class="head">

    <div class="goods">
        <div class="img">
            <img src="<?php echo $this_goods['img']; ?>" />
        </div>
        <h1><?php echo $this_goods['title']; ?></h1>
        <ul class="mode">
            <li><label>售价</label>
                <ul>
                    <li class="nowMoney">¥<?php echo $this_goods['money'] * 8 / 10; ?></li>
                    <li>原价：¥<span class="money"><?php echo $this_goods['money']; ?></span></li>
                </ul>
            </li>

        </ul>
        <ul class="pay">
            <li class="left"><a class="pay" href="?pay=yes">立即购买</a></li>
            <li class="right"><a class="like" href="?like=yes">赞 (<?php echo $this_goods['like']; ?>)</a><a class="like" href="?keep=yes">收藏 (<?php echo $this_goods['keep']; ?>)</a></li>
        </ul>
    </div>

</div>
<div class="com">
    <div class="synopsis">
        <?php echo $this_goods['synopsis']; ?>
    </div>
    <div class="clear"></div>
</div>

<?php require_once("../../include/php/foot.php"); ?>
</body>
</html>
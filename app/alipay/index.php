<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
require_once("../../lib/mysql.class.php");
require_once("../../lib/user.class.php");
require_once("../../lib/store.class.php");
require_once("../../lib/goods.class.php");
require_once("../../lib/movie.class.php");
require_once("../../include/php/php.php");

if(!isset($_SESSION['user'])) header("Location: http://{$_SERVER['HTTP_HOST']}/login?url=" . curPageURL());
$mysql = new mysql;

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        if(isset($_GET['del']) and $_GET['del'] == 'yes') {
            $mysql->delete('cart', 'id = ' . $_GET['id']);
        }elseif(isset($_GET['add']) and $_GET['add'] == 'yes') {

            $s = array(
                'table' => 'cart',
                'condition' => 'id = ' . $_GET['id']
            );
            $r = $mysql->row($s);

            $s = array(
                'table' => 'goods',
                'condition' => 'id = ' . $r['gid']
            );
            $r = $mysql->row($s);
            $mysql->update('cart', array('member' => $_GET['m'] + 1, 'money' => ($_GET['m'] + 1) * $r['rebate']), 'id = ' . $_GET['id']);
        }elseif(isset($_GET['jian']) and $_GET['jian'] == 'yes') {
            if($_GET['m'] > 1) {
                $s = array(
                    'table' => 'cart',
                    'condition' => 'id = ' . $_GET['id']
                );
                $r = $mysql->row($s);

                $s = array(
                    'table' => 'goods',
                    'condition' => 'id = ' . $r['gid']
                );
                $r = $mysql->row($s);
                $mysql->update('favorites', array('member' => $_GET['m'] - 1, 'money' => ($_GET['m'] + 1) * $r['rebate']), 'id = ' . $_GET['id']);
            }
        }
        $_SESSION['token'] = $_GET['token'];
    }
    header("Location: /cart");
}

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $o['username'].' - '.HOST_NAME; ?></title>
        <meta name="keywords" content="<?php echo '会员中心，' . KEYWORDS; ?>" />
        <meta name="description" content="<?php echo DESCRIPTION; ?>" />
        <link href="../../include/css/head.css" rel="stylesheet" type="text/css">
        <link href="../../include/css/pay.css" rel="stylesheet" type="text/css">
        <link href="../../include/css/foot.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="../../include/js/jquery.js"></script>

        <link href="../../include/css/order.css" rel="stylesheet" type="text/css">

        <style type="text/css">
            div.top div.logo{float: left;}
            div.top div.logo a{padding: 5px; font-size: 20px; font-weight: bold; background: #4898F8; color: #FFF; border-radius: 5px;}
            div.top div.logo input.keyword{padding: 5px; font-size: 20px; width: 500px;}

        </style>
    </head>
    <body>
    <?php include_once("../../include/php/head.php"); ?>

    <div class="logo">

        <h1>琦益购物车</h1>

    </div>

    <div class="list">
        <div class="uc-process">
            <span class="unit current">确认订单</span>
                <span class="arrow-current">
                    <span class="next"></span>
                    <span class="prev"></span>
                </span>
            <span class="unit">支付</span>
                <span class="arrow">
                    <span class="next"></span>
                    <span class="prev"></span>
                </span>
            <span class="unit">支付成功</span>
                <span class="arrow">
                    <span class="next"></span>
                    <span class="prev"></span>
                </span>
            <span class="unit">确认收货</span>
                <span class="arrow">
                    <span class="next"></span>
                    <span class="prev"></span>
                </span>
            <span class="unit" style="width: 220px;">评价</span>
        </div>

        <h1>1.确认订单信息</h1>
        <table>

            <tr class="head">

                <td></td>
                <td style="width: 60%;">产品名称</td>
                <td style="width: 10%;">单价</td>
                <td style="width: 10%;">数量</td>
                <td style="width: 10%;">小记</td>
                <td style="width: 40px;"></td>

            </tr>

            <?php
            $s = array(
                'table' => 'cart',
                'condition' => 'pay = 0 and uid = ' . $o['id']
            );
            $r = $mysql->select($s);

            $money = 0;
            $title = '';
            $cart = '';

            foreach($r as $key => $value) {
                $v = $value['cart'];
                $sg = array(
                    'table' => 'goods',
                    'condition' => 'id = ' . $v['gid']
                );
                $rg = $mysql->row($sg);
                $img = explode(',', $rg['img']);
                $money += $v['money'];
                $title .= $rg['title'];
                if($key == 0){
                    $cart .= $v['id'];
                }else{
                    $cart .= ',' . $v['id'];
                }
            ?>

            <tr>

                <td style="text-align: center;"><img src="<?php echo $img[0]; ?>" /></td>
                <td><?php echo $rg['title']; ?></td>
                <td>¥<?php echo $v['money']; ?></td>
                <td><a class="edit" href="?jian=yes&m=<?php echo $v['member']; ?>&id=<?php echo $v['id']; ?>&token=<?php echo md5(rand(0, 100000000)); ?>">－</a><span><?php echo $v['member']; ?></span><a class="edit" href="?add=yes&m=<?php echo $v['member']; ?>&id=<?php echo $v['id']; ?>&token=<?php echo md5(rand(0, 100000000)); ?>">＋</a></td>
                <td>¥<?php echo $v['money']; ?></td>
                <td><a href="?del=yes&id=<?php echo $v['id']; ?>&token=<?php echo md5(rand(0, 100000000)); ?>">×</a></td>

            </tr>

            <?php } ?>

        </table>



        <div class="jiesuan">
            <form action="/pay?token=<?php echo md5(rand(0, 10000000000)); ?>" method="post">
            应付：<span>¥<?php echo $money; ?></span><br />
                <input type="hidden" name="queren" value="true" />
                <input type="hidden" name="cart" value="<?php echo $cart; ?>" />
            <button>确认订单</button>
            </form>
        </div>


    </div>


    <?php include_once("../../include/php/foot.php"); ?>
    </body>
    </html>
<?php
function curPageURL() {
    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }else{
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
?>
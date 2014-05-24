<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-5-15
 * Time: 下午5:43
 */

?>

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
        if(isset($_POST['queren']) and $_POST['queren'] == 'true') {
            //$mysql->update('cart', array('pay' => 1), 'uid = ' . $o['id']);
            $cart = explode(',', $_POST['cart']);
            foreach($cart as $key => $value) {
                $mysql->update('cart', array('pay' => 1), 'id = ' . $value);
            }
        }
        if(isset($_GET['del']) and $_GET['del'] == 'yes') {
            $mysql->delete('cart', 'id = ' . $_GET['id']);
        }
        $_SESSION['token'] = $_GET['token'];
    }
    //print_r($_POST);
    header("Location: /pay");
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

        <h1>琦益支付</h1>

    </div>

    <div class="list">
        <div class="uc-process">
            <span class="unit past">确认订单</span>
                <span class="arrow-complete">
                    <span class="next"></span>
                    <span class="prev"></span>
                </span>
            <span class="unit current">支付</span>
                <span class="arrow-current">
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
        <form action="/app/alipay/alipayapi.php?token=<?php echo md5(rand(0, 10000000000)); ?>" method="post">


            <h1>1.订单信息</h1>
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
                    'condition' => 'pay = 1 and uid = ' . $o['id']
                );
                $r = $mysql->select($s);

                $money = 0;
                $title = '';
                $cart = '';


                if(is_array($r) and count($r) > 0) {

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
                        if($key == 0) {
                            $cart = $v['id'];
                        }else{
                            $cart .= ',' . $v['id'];
                        }
                        ?>

                        <tr>

                            <td style="text-align: center;"><img src="<?php echo $img[0]; ?>" /></td>
                            <td><?php echo $rg['title']; ?></td>
                            <td>¥<?php echo $rg['rebate']; ?></td>
                            <td><?php echo $v['member']; ?></td>
                            <td>¥<?php echo $v['money']; ?></td>
                            <td><a href="?del=yes&id=<?php echo $v['id']; ?>&token=<?php echo md5(rand(0, 100000000)); ?>">×</a></td>

                        </tr>

                    <?php
                    }
                }else{
                    header("Location: /cart");
                }
                ?>

            </table>


            <h1>2.选择收货地址</h1>
            <ul>
                <?php
                $s = array(
                    'table' => 'address',
                    'condition' => 'uid = ' . $o['id']
                );
                $r = $mysql->select($s);
                foreach($r as $key => $value) {
                    $v = $value['address'];
                    ?>
                    <li>
                        <input<?php if($v['def'] == 1) {echo ' checked';} ?> id="address<?php echo $v['id']; ?>" type="radio" name="address" value="收货地址：<?php echo $v['address']; ?>；邮编：<?php echo $v['port']; ?>；联系人：<?php echo $v['username']; ?>；联系电话：<?php echo $v['phone']; ?>" />
                        <label for="address<?php echo $v['id']; ?>">收货地址：<?php echo $v['address']; ?>；邮编：<?php echo $v['port']; ?>；联系人：<?php echo $v['username']; ?>；联系电话：<?php echo $v['phone']; ?><?php if($v['def'] == 1) {echo '（默认）';} ?></label>
                    </li>
                <?php } ?>
                <button>新建收货地址</button>
            </ul>



            <div class="jiesuan">

                应付：<span>¥<?php echo $money; ?></span><br />
                <input type="hidden" name="cart" value="<?php echo $cart; ?>" />
                <input type="hidden" name="name" value="<?php echo $title; ?>" />
                <input type="hidden" name="money" value="<?php echo $money; ?>" />
                <button>确认支付</button>

            </div>
        </form>

    </div>


    <?php include_once("../../include/php/foot.php"); ?>
    </body>
    </html>
<?php
function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on")
    {
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
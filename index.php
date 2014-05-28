<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
include_once("lib/mysql.class.php");
include_once("lib/user.class.php");
include_once("lib/store.class.php");
include_once("lib/goods.class.php");
include_once("include/php/php.php");

include_once("lib/runtime.class.php");
$run = new runtime();
$run->start();

$mysql = new mysql;
?>
<?php //if(!is_array($o)) { ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo HOST_NAME; ?></title>
    <meta name="keywords" content="<?php echo KEYWORDS; ?>" />
    <meta name="description" content="<?php echo DESCRIPTION; ?>" />
    <link href="include/css/head.css" rel="stylesheet" type="text/css">
    <link href="include/css/index.css" rel="stylesheet" type="text/css">
    <link href="include/css/foot.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="include/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/changeSize.js"></script>
    <script type="text/javascript">

    </script>
</head>
<body>
<?php include_once("include/php/head.php"); ?>

<div class="indextop">

    <h1>琦益<span>产品直销平台</span></h1>

</div>

<ul class="m">
    <li><a class="b" href="#">购物指南</a></li>
    <li><a class="b" href="#">企业服务</a></li>
</ul>

<div class="show">

    <div class="mian">

        <div class="right">

            <ul>
                <li class="login">

                    <h1>欢迎来琦益</h1>
                    <span>您还没有登录呦</span>
                    <a style="margin-right: 10px;" href="/login">登录</a>
                    <a href="/reg">注册</a>
                    <br class="clear" />
                </li>

                <li class="qr">
                    <img src="include/images/qrcode.png" />
                    扫描二维码关注微信公众帐号<br />
                    <span>动动手指，就可赚钱</span>
                </li>
            </ul>



        </div>

        <div class="left">

            <div class="index h500">
                <ul class="caidan">
                    <h1>企业及产品行业分类</h1>
                    <?php
                    $s = array(
                        'table' => 'form',
                        'order' => 'xian asc'
                    );
                    $f = $mysql->select($s);
                    //print_r($f);
                    foreach($f as $key => $value) {
                        $v = $value['form'];
                        ?>
                        <li>
                            <a href="search.html?type=<?php echo $v['id']; ?>"><?php echo $v['value']; ?></a>
                        </li>
                    <?php }?>
                </ul>
                <div class="fox">
                    <ul class="img">
                        <li><img src="" /></li>
                        <li><img src="" /></li>
                        <li><img src="" /></li>
                        <li><img src="" /></li>
                        <li><img src="" /></li>
                    </ul>

                    <div class="index">
                        <h1>最新入驻企业</h1>
                        <ul>
                            <?php
                            $mysql = new mysql();
                            $store = new store();
                            $s = array(
                                'order' => 'id desc',
                                'limit' => 'LIMIT 0, 16'
                            );
                            $r = $store->show($mysql, $s);
                            //print_r($r);
                            foreach($r as $k => $v) {
                                ?>
                                <li>
                                    <a target="_blank" href="/store.<?php echo $v['id']; ?>.html">
                                        <img src="<?php echo $v['avatar_large']; ?>" />
                                        <div><?php echo $v['sname']; ?></div>
                                    </a>

                                </li>
                            <?php
                            }
                            ?>
                            <br class="clear" />
                        </ul>
                    </div>

                </div>
                <br class="clear" />
            </div>





        </div>

        <br class="clear" />

    </div>




</div>


<?php include_once("include/php/foot.php"); ?>
</body>
</html>

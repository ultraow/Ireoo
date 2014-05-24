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

    <h1>琦益<span>打造全球最大企业社交平台</span></h1>

</div>

<ul class="m">
    <li><a class="b" href="#">采购指南</a></li>
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
                    foreach($f as $k => $v) {
                        ?>
                    <li><?php echo $v['form']['value']; ?></li>
                    <?php }?>
                </ul>
                <ul class="fox">
                    <li><img src="" /></li>
                    <li><img src="" /></li>
                    <li><img src="" /></li>
                    <li><img src="" /></li>
                    <li><img src="" /></li>
                </ul>
            </div>


            <div class="index">
                <h1>最新加入的企业</h1>
                <ul>
                    <?php
                    $mysql = new mysql();
                    $store = new store();
                    $s = array(
                        'order' => 'id desc',
                        'limit' => 'LIMIT 0, 10'
                    );
                    $r = $store->show($mysql, $s);
                    //print_r($r);
                    foreach($r as $k => $v) {
                        ?>
                        <li class="t<?php echo $k; ?>">
                            <a target="_blank" href="/<?php echo $v['id']; ?>"><img src="<?php echo $v['avatar_large']; ?>" /></a>

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

    <div class="mian">

        <?php
        $s = array(
            'table' => 'form',
            'order' => 'xian asc'
        );
        $f = $mysql->select($s);
        foreach($f as $k => $v) {
            ?>
        <div class="index">
            <h1><?php echo $v['form']['value']; ?></h1>
            <ul>
                <?php
                $mysql = new mysql();
                $s = array(
                    'table' => 'goods',
                    'condition' => "type = " . $v['form']['id'],
                    'limit' => 'LIMIT 0, 12',
                    'order' => 'id desc'
                );
                $r = $mysql->select($s);
                //print_r($r);
                foreach($r as $key => $value) {
                    $v = $value['goods'];
                    ?>
                    <li class="f<?php echo $key; ?>">
                        <?php
                        $img = explode(",", $v['img']);
                        if(is_numeric($img[0])) {
                            $url = "/image.{$img[0]}.200.200.1";
                        }else{
                            $url = $img[0];
                        }
                        ?>
                        <a target="_blank" href="/goods.<?php echo $v['id']; ?>"><img src="<?php echo $url; ?>" /></a>

                    </li>
                <?php
                }
                ?>
                <br class="clear" />
            </ul>
        </div>
        <?php } ?>

    </div>


</div>


<?php include_once("include/php/foot.php"); ?>
</body>
</html>

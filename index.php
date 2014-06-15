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
$store = new store();
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
    <link href="include/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="include/css/foot.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="include/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/changeSize.js"></script>
    <script type="text/javascript">

    </script>
</head>
<body>
<?php include_once("include/php/head.php"); ?>

<div class="indextop">

    <h1>琦益<span>企业产品直销平台</span></h1>

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

                <li class="join">
                    <h1>琦益网状况</h1>
                    <span>收入企业总量：<b><?php echo $mysql->_count('`store`'); ?></b></span>
                    <span>收入产品总量：<b><?php echo $mysql->_count('`goods`'); ?></b></span>
                    <span>数据还在持续增加中...</span>
                </li>

                <li style="margin-bottom: 20px;">
                    <a href="http://s.click.taobao.com/t?e=m%3D2%26s%3D5rKrr7mEbjscQipKwQzePCperVdZeJviEViQ0P1Vf2kguMN8XjClAtUhQN%2BiGc9WDi2u4AAyFm1oTRyrWiMWJgwxTHigconOkNSp%2FaM4CD0Akp%2FXGYDIf%2Bdn1BbglxZYxUhy8exlzcq9AmARIwX9K2Zg%2BdzdQFOwfMRvoxSVDSdLyrb2g0H2G5JcxXijM%2BwneEHpPTskRHnPKdU%2FdTrgjbw4MC6y5nKlXF%2B87KN7TKeiZ%2BQMlGz6FQ%3D%3D" target="_blank"><img src="http://gtms03.alicdn.com/tps/i3/TB1LP1GFFXXXXajXXXXj64lTXXX-200-200.jpg" /></a>
                </li>

                <li>
                    <script type="text/javascript"> (function(win,doc){ var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0]; if (!win.alimamatk_show) { s.charset = "gbk"; s.async = true; s.src = "http://a.alimama.cn/tkapi.js"; h.insertBefore(s, h.firstChild); }; var o = { pid: "mm_27201356_3489904_23078787",/*推广单元ID，用于区分不同的推广渠道*/ appkey: "",/*通过TOP平台申请的appkey，设置后引导成交会关联appkey*/ unid: ""/*自定义统计字段*/ }; win.alimamatk_onload = win.alimamatk_onload || []; win.alimamatk_onload.push(o); })(window,document);</script>
                    <a data-type="2" biz-keyword="服装" data-tmpl="192x290" data-tmplid="9" data-rd="2" data-style="2" data-border="1" href="#">服装</a>
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
                            <a href="store?span=<?php echo $v['id']; ?>"><?php echo $v['value']; ?></a>
                        </li>
                    <?php }?>
                </ul>
                <div class="fox">
                    <ul class="img">
                        <li><a target="_blank" href="http://ai.taobao.com?pid=mm_27201356_3489904_23068843"><img src="" /></a></li>
                        <li><a target="_blank" href="http://ai.taobao.com?pid=mm_27201356_3489904_23068843"><img src="" /></a></li>
                        <li><a target="_blank" href="http://ai.taobao.com?pid=mm_27201356_3489904_23068843"><img src="" /></a></li>
                        <li><a target="_blank" href="http://ai.taobao.com?pid=mm_27201356_3489904_23068843"><img src="" /></a></li>
                        <li><a target="_blank" href="http://ai.taobao.com?pid=mm_27201356_3489904_23068843"><img src="" /></a></li>
                    </ul>

                    <div class="top">
                        <h1>最新入驻企业</h1>
                        <ul>
                            <?php

                            $s = array(
                                'order' => 'id desc',
                                'limit' => 'LIMIT 0, 16'
                            );
                            $r = $store->show($mysql, $s);
                            //print_r($r);
                            foreach($r as $k => $v) {
                                ?>
                                <li>
                                    <a target="_blank" href="/<?php echo $v['id']; ?>">
                                        <img src="<?php echo $v['avatar_large']; ?>" />
                                        <div><?php if($v['show'] == 1) {echo '<i class="Icon Icon--verified Icon--small"></i>';} ?><?php echo $v['sname']; ?></div>
                                    </a>

                                </li>
                            <?php
                            }
                            ?>
                            <br class="clear" />
                        </ul>
                    </div>

                    <div class="index">
                        <h1>已认证的企业</h1>
                        <ul>
                            <?php
                            $mysql = new mysql();
                            $store = new store();
                            $s = array(
                                'order' => 'id desc',
                                'condition' => '`show` = 1',
                                'limit' => 'LIMIT 0, 16'
                            );
                            $r = $store->show($mysql, $s);
                            //print_r($r);
                            foreach($r as $k => $v) {
                                ?>
                                <li>
                                    <a target="_blank" href="/<?php echo $v['id']; ?>">
                                        <img src="<?php echo $v['avatar_large']; ?>" />
                                        <div><?php echo $v['sname']; ?><?php if($v['show'] == 1) {echo '<i class="Icon Icon--verified Icon--small"></i>';} ?></div>
                                    </a>

                                </li>
                            <?php
                            }
                            ?>
                            <br class="clear" />
                        </ul>
                    </div>

                    <div class="index">
                        <h1>平台推荐产品</h1>
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
                                    <a target="_blank" href="/<?php echo $v['id']; ?>">
                                        <img src="<?php echo $v['avatar_large']; ?>" />
                                        <div><?php echo $v['sname']; ?><?php if($v['show'] == 1) {echo '<i class="Icon Icon--verified Icon--small"></i>';} ?></div>
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


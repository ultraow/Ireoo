<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-6-1
 * Time: 下午2:17
 */

date_default_timezone_set("PRC");
session_start();
require_once("lib/mysql.class.php");
require_once("lib/user.class.php");
require_once("lib/store.class.php");
require_once("lib/keyword.class.php");
require_once("include/php/php.php");

include_once("lib/runtime.class.php");
$run = new runtime();
$run->start();

$store = new store();
$mysql = new mysql();

$s = array('table' => 'goods', 'order' => 'id desc');

//当前页面页数操作

$k = '';
if(isset($_GET['k'])) {
    $k = htmlentities($_GET['k'], ENT_QUOTES, "UTF-8");
    if($k == '') header('Location: ' . HOST_URL . 'search.html');
}
$kw = new keyword($k);
$kw->ad($mysql);
$keyword = $kw->show($mysql);
//关键词操作

if(!isset($_GET['list'])) $_GET['list'] = 'min';  //设置默认显示形式
if(!isset($_GET['type'])) $_GET['type'] = 0;  //设置默认分类

//当有关键词是加上条件属性
$s['condition'] = "title like '%{$k}%'";

$show = 40;
$page = 0;
if(isset($_GET['page'])) $page = $_GET['page'] - 1;

$z = $s;
$s['limit'] = "LIMIT " . $page * $show . ", $show";

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
        <link href="<?php echo HOST_URL; ?>include/css/search.css" rel="stylesheet" type="text/css">
        <link href="<?php echo HOST_URL; ?>include/css/foot.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/changeSize.js"></script>
        <!-- <script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21390994"></script> -->
        <script type="text/javascript">
            $(function() {

                size(0, 'index');

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
    <?php require_once("include/php/head.php"); ?>
    <div class="mian">
        <div class="news">
            <div class="logo">
                <h1>琦益<span>企业产品直销平台</span></h1>
                <form action="<?php echo HOST_URL; ?>search.html" method="get">
                    <input type="text" name="k" value="<?php echo $k; ?>" />
                    <button>搜索</button>
                </form>
            </div>
        </div>
    </div>


    <div class="index">
        <div class="m">
            <ul>
                <h1>琦益推荐的企业</h1>
                <?php
                $sl = array(
                    'table' => 'store',
                    'limit' => 'LIMIT 0, 6'
                );
                $st = $mysql->select($sl);
                foreach($st as $key => $value) {
                    $v = $value['store'];
                    ?>
                    <li><a href="/store.<?php echo $v['id']; ?>.html"><img src="<?php echo $v['avatar_large']; ?>" /></a></li>
                <?php } ?>
                <br class="clear" />
            </ul>

            <ul>
                <h1>琦益推荐的产品</h1>
                <?php
                $sl = array(
                    'table' => 'goods',
                    'limit' => 'LIMIT 0, 6'
                );
                $st = $mysql->select($sl);
                foreach($st as $key => $value) {
                    $v = $value['goods'];
                    $img = explode(",", $v['img']);
                    if(is_numeric($img[0])) {
                        $url = "/image.{$img[0]}.400.400.1.jpg";
                    }else{
                        $url = $img[0];
                    }
                    ?>
                    <li><a href="/goods.<?php echo $v['id']; ?>.html"><img src="<?php echo $url; ?>" /></a></li>
                <?php } ?>
                <br class="clear" />
            </ul>


        </div>

        <ul class="nlist">

        <span class="t">
            搜索结果[<?php echo $form[$_GET['type']]; ?>]
        </span>

            <ul class="if">
                <li>
                    <a<?php if($_GET['type'] == 0) {echo ' class="on"';} ?> href="?<?php echoGet('type'); ?>type=0">全部</a>
                    <?php foreach($form as $key => $value) { ?>
                        <a<?php if($key == $_GET['type']) {echo ' class="on"';} ?> href="?<?php echoGet('type'); ?>type=<?php echo $key; ?>"><?php echo $value; ?></a>
                    <?php } ?>
                </li>
            </ul>

            <ul class="if back">

                <li>

                </li>
                <li class="right">
                    <a<?php if($_GET['list'] == 'max') {echo ' class="on"';} ?> href="?<?php echoGet('list'); ?>list=max">+</a>
                    <a<?php if($_GET['list'] == 'min') {echo ' class="on"';} ?> href="?<?php echoGet('list'); ?>list=min">-</a>
                    <br class="clear" />
                </li>
                <br class="clear" />

            </ul>

            <?php
            ?>
            <li>
                <?php
//                $s = array(
//                    'table' => 'goods',
//                    'condition' => "form = " . $_GET['type'],
//                    'order' => 'id desc'
//                );
                //print_r($s);
                $r = $mysql->select($s);
                foreach($r as $key => $value) {
                    $v = $value['goods'];
                    //print_r($v);
                    $img = explode(",", $v['img']);
                    if(is_numeric($img[0])) {
                        $url = "/image.{$img[0]}.400.400.1.jpg";
                    }else{
                        $url = $img[0];
                    }
                    ?>

                    <a class="img<?php if(($key+1)%4 == 0) {echo ' right';} ?>" target="_blank" href="goods.<?php echo $v['id']; ?>.html" title="<?php echo $v['title']; ?>">
                        <img src="<?php echo $url; ?>" alt="<?php echo $v['title']; ?>" />
                        <h1><span>100</span>¥<?php echo $v['rebate']; ?></h1>
                        <p><?php echo $v['title']; ?></p>
                    </a>

                <?php } ?>
                <br class="clear" />
            </li>
            <br class="clear" />

            <?php
            $l = $mysql->select($z);
            $zong = count($l);
            $y = ceil($zong/$show);
            //print_r($y);
            ?>

            <div class="page">
                <ul>
                    <li>
                        <a<?php if($page + 1 == 1) {echo ' class="on"';} ?> href="?<?php echoGet('page'); ?>page=1">1</a>

                        <?php for($i = 2; $i <= $y; $i++) { ?>
                        <a<?php if($page + 1 == $i) {echo ' class="on"';} ?> href="?<?php echoGet('page'); ?>page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php } ?>
                    </li>
                </ul>
            </div>

        </ul>



        <br class="clear" />
    </div>

    <?php require_once("include/php/foot.php"); ?>
    </body>
    </html>

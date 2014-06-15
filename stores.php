<?php
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

//当前页面页数操作

$k = '';
if(isset($_GET['k'])) {
    $k = htmlentities($_GET['k'], ENT_QUOTES, "UTF-8");
    if($k == '') header('Location: ' . HOST_URL . 'store');
}
$kw = new keyword($k);
$kw->ad($mysql);
$keyword = $kw->show($mysql);
//关键词操作

$top_sql = array('limit' => "LIMIT 0, 5");
$tops = $store->show($mysql, $top_sql);
//获取推荐

//当有关键词是加上条件属性
$s['condition'] = "sname like '%{$k}%'";

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
    <link href="<?php echo HOST_URL; ?>include/css/stores.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/normalize.css" rel="stylesheet" type="text/css">
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

    <ul class="if">

    </ul>
<div class="index">
    <ul class="m">
        <h1>所有企业行业分类</h1>
        <?php
        $s = array(
            'table' => 'form',
            'order' => 'xian asc'
        );
        $f = $mysql->select($s);
        foreach($f as $k => $v) {
        ?>
        <li><a href="?<?php echoGet('span'); ?>span=<?php echo $v['form']['id']; ?>"><?php echo $v['form']['value']; ?></a></li>
        <?php } ?>
    </ul>

    <ul class="nlist">

        <?php if(isset($_GET['span'])) { ?>
        <h1 style="border-bottom: 3px #CCC solid;"><?php echo $form[$_GET['span']]; ?></h1>
        <?php
        }

        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 0;
        }
        $show = 20;
        $start = $page * $show;
        $s = array(
            'table' => 'store',
            'limit' => "LIMIT $start, $show",
            'order' => 'id desc'
        );
        //print_r($s);
        if(isset($_GET['span'])) $s['condition'] = "form = " . $_GET['span'];
        $r = $mysql->select($s);
        foreach($r as $k => $v) {
        ?>
        <li>


                <a class="img" target="_blank" href="/<?php echo $v['store']['id']; ?>"><img src="<?php echo $v['store']['avatar_large']; ?>" alt="<?php echo $v['store']['sname']; ?>" /></a>
            <div>
                <h1>
                    <a target="_blank" title="<?php echo $v['store']['sname']; ?>" href="/<?php echo $v['store']['id']; ?>">
                        <?php echo $v['store']['sname']; ?>
                        <?php if($v['store']['show'] == 1) { ?>
                            <i class="Icon Icon--verified Icon--small ok" title="认证企业"></i>
                        <?php }else{ ?>
                            <i class="Icon Icon--verified Icon--small" title="未认证企业"></i>
                        <?php } ?>
                    </a>
                </h1>
                <span>详细地址：<?php echo $v['store']['address']; ?></span>
            </div>


            <br class="clear" />
        </li>
    <?php } ?>
        <br class="clear" />
        <div>

            <?php


            $zong = $mysql->_count('`store`');

            print_r($zong);


            ?>




            <?php if($page > 0) {?>
            <a href="?<?php echoGet('page'); ?>page=<?php echo $page - 1; ?>">上一页</a>
            <?php } ?>
            <a href="?<?php echoGet('page'); ?>page=<?php echo $page + 1; ?>">下一页</a>
        </div>
    </ul>


    <br class="clear" />
</div>

<?php require_once("include/php/foot.php"); ?>
</body>
</html>
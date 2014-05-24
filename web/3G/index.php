<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
include_once("../../lib/mysql.class.php");
include_once("../../lib/user.class.php");
include_once("../../lib/store.class.php");
include_once("../../include/php/php.php");

//if(!is_array($o)) header('Location: http://'.$_SERVER['HTTP_HOST'].'/3Glogin');

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
    <link href="<?php echo HOST_URL; ?>web/3G/css/head.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>web/3G/css/index.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>web/3G/css/foot.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/changeSize.js"></script>
    <script type="text/javascript">
        $(function() {

            size(-1, '3g');

        });
    </script>
</head>
<body>
<?php include_once("include/head.php"); ?>

<div class="indextop">

</div>

<div class="index">
    <ul>
        <?php
        $mysql = new mysql();
        $store = new store();
        $s = array(
            'order' => 'id desc'
        );
        $r = $store->show($mysql, $s);
        //print_r($r);
        foreach($r as $k => $v) {
            $sid = $v['id'];
            ?>
            <li class="f<?php echo $k; ?>">
                <a href="/<?php echo $v['id']; ?>"><img src="<?php echo $v['avatar_large']; ?>" /></a>
                <h1><?php echo $v['sname']; ?>
                    <span style="padding-top: 5px;">发布人：<a style="float: none; color: #333; text-decoration: none;" href="#"><?php echo $v['uid']; ?></a></span>
                </h1>
                <a id="follow" href="/3G<?php echo $v['id']; ?>">查看</a>
                <div style="clear: both;"></div>
            </li>
        <?php
        }
        ?>
    </ul>
</div>
<?php include('include/foot.php'); ?>
</body>
</html>

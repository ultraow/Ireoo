<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
require_once("lib/mysql.class.php");
require_once("lib/user.class.php");
require_once("lib/store.class.php");
require_once("include/php/php.php");

include_once("lib/runtime.class.php");
$run = new runtime();
$run->start();

$id = $_GET['id'];

//获取当前ID
$mysql = new mysql();                                   //load mysql class
$s = array(
    'table' => 'news',
    'order' => 'id desc'
);
$news = $mysql->select($s);

if(isset($_GET['id']))  $s['condition'] = "id = $id";

$this_news = $mysql->row($s);
//print_r($this_news);

header("Last-Modified: ".gmdate("D, d M Y H:i:s", $this_news['timer'])." GMT");
//header("Expires: " . date('D, d m Y H:i:s', $this_news['timer']) . " GMT");

//$store->browse();

$user = new user();                                     //加载新用户

$admin = $user->getID($mysql, $this_store['uid']);
//获取该店管理员身份
//print_r($this_store);

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $this_news['title'] . ' - ' . HOST_NAME; ?></title>
    <meta name="keywords" content="<?php echo $this_news['title'] . '，每天一点正能量，' . KEYWORDS; ?>" />
    <meta name="description" content="<?php echo DESCRIPTION; ?>" />
    <link href="<?php echo HOST_URL; ?>include/css/head.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/news.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/foot.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo HOST_URL; ?>include/js/jquery.js"></script>
    <script type="text/javascript">
        $(function() {

            //size(<?php echo $_GET['id']; ?>, 'index');

                if($(window).width() < 600) {
                    $('div.mian').css({padding: '0'}).find('br').remove();
                    $('div.list').css({maxWidth: '100%', float: 'none', borderRadius: '0'});
                    $('div.list ul').css({overflowY: 'none', height: 'auto'});
                    $('div.show').width($(window).width() - 20).css({float: 'none'});
                    if($('div.show img').width() > $('div.show').width()) {
                        $('div.show img').width($('div.show').width() - 40).css({margin: 'auto', display: 'block'});
                    }
                }


        });
    </script>
</head>
<body>
<?php require_once("include/php/head.php"); ?>

    <div class="mian">
        <div class="shead">


        </div>




        <div class="show">

            <h1><?php echo $this_news['title']; ?></h1>
            <div class="author">----发布于 <?php echo date('Y年m月d日 H:i', $this_news['timer']); ?> </div>

            <div style="float: left; margin-right: 10px; margin-bottom: 10px;">

                <script type="text/javascript">  var dianxin_said = 40657;var dianxin_width = 300;var dianxin_height = 280;  </script>  <script type="text/javascript" src="http://unionjs.dianxin.com/dianxin_showcc.js"  charset="utf-8" ></script>

            </div>

            <?php echo $this_news['con']; ?>

            <div style="display: inline-block; margin: auto;"><script type="text/javascript">  var dianxin_said = 40659;var dianxin_width = 250;var dianxin_height = 250;  </script>  <script type="text/javascript" src="http://unionjs.dianxin.com/dianxin_showcc.js"  charset="utf-8" ></script></div>


        </div>

        <div class="list">

            <ul>
                <?php foreach($news as $key => $value) { $v = $value['news'] ?>
                <li><a href="<?php echo HOST_URL; ?>news_<?php echo $v['id']; ?>.html" title="<?php echo $v['title']; ?>"><?php echo $v['title']; ?></a></li>
                <?php } ?>
            </ul>



        </div>




        <br class="clear" />
    </div>


<?php require_once("include/php/foot.php"); ?>

<script type="text/javascript" src="http://unionjs.dianxin.com/fm.js" name="cpv" data-said="40654" data-width="300" data-height="300" data-type="0" charset="utf-8" ></script>

</body>
</html>

<?php
$name = $_GET['n'];
$txt = $_GET['t'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $name; ?>给您拜年啦！</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style type="text/css">
        *{margin: 0; padding: 0;}
        html{background: #333;}
        body{position: relative; background: rgb(197, 8, 25); text-align: center; font-size: 1em; color: #FFF; max-width: 600px; margin: auto; box-shadow: 0 0 5px #000;}
        img{margin-bottom: 30px; width: 100%;}
        form{margin-top: 30px; background: #000; font-size: 12px; text-align: left; padding: 10px;}
        li{list-style: none; margin-bottom: 10px;}
        label{display: block;}
        input,textarea{width: 90%; padding: 5px;}
        button{}
        div.foot{position: absolute; bottom: 5px; font-size: 12px; color: #FFF; width: 100%; text-align: center;}
        .btn_music{
            display:inline-block;
            width:35px;
            height:35px;
            background:url('img/play.png') no-repeat center center;
            background-size:100% auto;
            position:absolute;
            z-index:100;
            left:15px;
            top:20px;
        }
        .btn_music.on{
            background-image:url('img/stop.png');
        }
    </style>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
//            $('#bg').width($(window).width());
//            //$('#bg').height($(window).height());
//            //alert($(window).width());
//            $(window).resize(function() {
//                $('#bg').width($(window).width());
//                //$('#bg').height($(window).height());
//            });
        });
    </script>
</head>

<body>
<img id="bg" src="img/tupian.png" />
<?php echo $name; ?>给大家拜年啦！<br />
<?php if(isset($txt) and $txt != '') {echo $txt;}else{echo '一祝家庭幸福，福传千里；<br />二愿财运亨通，通上彻下；<br />三望龙马精神，神采飞扬！';} ?>

<form method="get">
    <li><label>姓名:</label><input name="n" type="text" value="" /></li>
    <li><label>想说的话:</label><textarea name="t"></textarea></li>
    <li><button>制作自己的贺卡</button></li>
    <li><a style="color: red; font-size: 16px;" target="_blank" href="/app/card/?n=<?php echo $name; ?>&t=<?php echo $txt; ?>">贺卡制作后ios设备长按这里复制链接转发</a></li>
    <li><span style="font-size: 12px;">更多功能请关注新益［xinyinet］微信公众平台，或扫描二维码。</span>
    <img src="http://cli.clewm.net/qrcode/2014/01/30/1438544210.png" />
    </li>
    <li><span style="font-size: 12px;">由 <a style="color: #FFF; text-decoration: none; font-weight: bold;" href="http://ireoo.com/1">新益信息科技</a> 独家提供技术支持</span></li>
</form>

</body>

<script src="http://www.weiyibao.com/img/jquery.js" type="text/javascript"></script>
<span id="playbox" class="btn_music" onclick="playbox.init(this).play();">
	<audio loop="" id="audio" src="sound/newYearDay.mp3"></audio>
	<!-- <audio loop="" id="audio" src="sound.mp3"></audio> -->
</span>

</html>
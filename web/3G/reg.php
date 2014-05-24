<?php
/**
 * Created by PhpStorm.
 * User: Ultra
 * Date: 14-1-11
 * Time: 下午8:23
 */

header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
require_once("../../lib/mysql.class.php");
require_once("../../lib/user.class.php");
require_once("../../lib/store.class.php");
require_once("../../include/php/php.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>帐号注册 - <?php echo HOST_NAME; ?></title>
    <meta name="keywords" content="<?php echo '注册圈网帐号，' . KEYWORDS; ?>" />
    <meta name="description" content="<?php echo DESCRIPTION; ?>" />
    <link href="<?php echo HOST_URL; ?>include/css/head.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>web/3G/css/rl.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HOST_URL; ?>include/css/foot.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/include/js/jquery.js"></script>
    <script type="text/javascript">
        function yanzheng() {
            //alert('ok');
            yan = $('.get').parent();
            if($('#phone').val() == '') {
                yan.html('<a onclick="yanzheng()" class="get" href="#">请填写手机号</a>！');
                return false;
            }
            $.ajax({
                type: "get",
                url: "include/php/yanzheng.php?phone=" + $('#phone').val(),
                beforeSend: function(re){
                    yan.html('努力发送...');
                },
                success: function(data, textStatus){
                    yan.html('发送完成！' + data);
                },
                error: function(){
                    yan.html('发送失败，请稍后<a class="get" onclick="yanzheng()" href="#">重试</a>！');
                }
            });
            return false;
        }

        function reg() {
            //alert('ok');
            $('button.button').hide();
            yan = $('li.result').show();
            $.ajax({
                type: "post",
                url: "include/php/reg.php",
                data: {
                    phone:$('#phone').val(),
                    yanzheng:$('#yanzheng').val(),
                    username:$('#username').val(),
                    password:$('#password').val(),
                    password2:$('#password2').val()
                },
                beforeSend: function(re){
                    yan.show();
                    yan.html('努力注册中...');
                },
                success: function(data, textStatus){
                    yan.html(data);
                    if(data != '注册成功！') {
                        $('button.button').show();
                    }else{
                        location.href = '/i?i=account';
                    }
                }
            });
            return false;
        }
        $(function() {
            $('#username').keyup(function() {
                //$('.ur').html($(this).val());
                if($(this).val() != '') {
                    $.ajax({
                        type: "post",
                        url: "include/atname.php",
                        data: {
                            u: $(this).val()
                        },
                        success: function(data, textStatus){
                            $('.ur').html(data).show();
                        }
                    });
                }else{
                    $('.ur').html('').hide();
                }
            });
        });
    </script>
</head>
<body>
<?php require_once("../../include/php/head.php"); ?>
<div class="mian">
    <div>
        <h1>加入圈网</h1>
        <h2>圈网是最大的企业网站社交平台，欢迎来记录您公司的点点滴滴！</h2>
    </div>

    <ul>
        <h3>创建一个免费的帐号</h3>
        <li>
            <label>手机号码：</label>
            <input name="phone" id="phone" type="text" value="" />
        </li>
        <!--
        <li>
            <label>验证码：</label>
            <input name="yanzheng" id="yanzheng" class="sl" type="text" value="" />
            <span><a onclick="return yanzheng();" class="get" href="#">获取验证码</a></span>
        </li>
        -->
        <li>
            <label>昵称：</label>
            <input name="username" id="username" type="text" value="" />
            <span class="ur"></span>
        </li>
        <li>
            <label>注册密码：</label>
            <input name="password" id="password" type="password" value="" />
        </li>
        <li>
            <label>确认密码：</label>
            <input name="password2" id="password2" type="password" value="" />
        </li>
        <li class="result"></li>
        <li><button type="button" onclick="return reg();">立即注册</button></li>
    </ul>
    <div class="right" style="display: none;">
        <?php
        $mysql = new mysql;
        foreach($mysql->select(array('table'=>'store','limit'=>'LIMIT 0, 3')) as $k => $v) {
            echo '<a title="' . $v['store']['sname'] . '" href="' . HOST_URL . $v['store']['id'] . '"><img src="u/s' . $v['store']['id'] . '.jpg" /></a>';
        }
        ?>
    </div>
    <br class="clear" />

    <a href="http://www.ireoo.com/login">登陆</a>
    <a href="http://www.ireoo.com/password.php">忘记密码?</a>

</div>
<?php include('../../include/php/foot.php'); ?>
</body>
</html>

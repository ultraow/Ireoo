<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
include_once('../../lib/phpmailer.class.php');
include_once("../../app/oauth/oauth2.php");

$to = $_GET['email'];
if($to == '') die('<a onclick="yanzheng()" class="get" href="#">请填写邮箱</a>！');
$_SESSION['yanzheng'] = array(rand(10000000,99999999), $to);

function email( $sendto_email, $subject, $body){
    $mail = new PHPMailer();
    $mail->IsSMTP();                  // send via SMTP
    $mail->Host = "smtp.vip.olivemail.net";   // SMTP servers
	//$mail->Port = 465;   // SMTP servers
    $mail->SMTPAuth = true;           // turn on SMTP authentication
    $mail->Username = "server@own.cm";     // SMTP username  注意：普通邮件认证不需要加 @域名
    $mail->Password = "cc880108"; // SMTP password
    $mail->From = "server@own.cm";      // 发件人邮箱
    $mail->FromName =  "圈圈网系统管理员";  // 发件人

    $mail->CharSet = "utf8";   // 这里指定字符集！
    $mail->Encoding = "base64";
    $mail->AddAddress($sendto_email, "圈圈网用户");  // 收件人邮箱和姓名
    $mail->AddReplyTo("ultra@own.cm","www.own.cm");
    //$mail->WordWrap = 50; // set word wrap 换行字数
    //$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment 附件
    //$mail->AddAttachment("/tmp/image.jpg", "new.jpg");
    $mail->IsHTML(true);  // send as HTML
    // 邮件主题
    $mail->Subject = $subject;
    // 邮件内容
    $mail->Body = $body;
    $mail->AltBody ="text/plain";
	$mail->SMTPDebug = true;
    if(!$mail->Send())
    {
        //echo "邮件发送有误 <p>";
        echo "邮件错误信息: " . $mail->ErrorInfo;
        exit;
    }
    else {
        die("邮件发送成功!");
    }
}
// 参数说明(发送到, 邮件主题, 邮件内容, 附加信息, 用户名)
email($to, "圈圈网注册信息", "亲！你在www.own.cm的提交的邮箱验证码是".$_SESSION['yanzheng'][0].'。如果您没有在本网站使用此邮箱，您可以直接忽略。');
?>
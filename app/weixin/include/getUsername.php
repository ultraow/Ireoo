<?php
/**
 * Created by PhpStorm.
 * User: S2
 * Date: 13-12-5
 * Time: 下午4:40
 */
include_once('../../../lib/mysql.class.php');
include_once('getAccessToken.php');

$openid = $_GET['id'];

$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . ACCESS_TOKEN . "&openid=" . $openid; //接收XML地址
$header = "Content-type: text/json"; //定义content-type为xml
$ch = curl_init(); //初始化curl
curl_setopt($ch, CURLOPT_URL, $url); //设置链接
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设置是否返回信息
//curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //设置HTTP头
//curl_setopt($ch, CURLOPT_POST, 1); //设置为POST方式
//curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data); //POST数据
$re = curl_exec($ch); //接收返回信息

if(curl_errno($ch)){ //出错则显示错误信息
    print curl_error($ch);
}
curl_close($ch); //关闭curl链接

$user = json_decode($re, true);
//print_r($user);
$mysql = new mysql();
$r = $mysql->update('wechat', $user, "openid = '{$user['openid']}'");

echo $re; //显示返回信息
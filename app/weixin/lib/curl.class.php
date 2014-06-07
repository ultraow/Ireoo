<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13-12-9
 * Time: 上午8:31
 */

class cURL
{
    public $url = '';

    function __construct($url = '') {
        $this->url = $url;

    }

    public function post($data) {
        $header = "Content-type: text/json"; //定义content-type为xml
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $this->url); //设置链接
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设置是否返回信息
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //设置HTTP头
        curl_setopt($ch, CURLOPT_POST, 1); //设置为POST方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //POST数据
        $re = curl_exec($ch); //接收返回信息
        if(curl_errno($ch)){ //出错则显示错误信息
            return curl_error($ch);
        }
        curl_close($ch); //关闭curl链接
        return json_decode($re, true);
    }
}

?>
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-9-5
 * Time: 上午11:45
 * To change this template use File | Settings | File Templates.
 */

$url = parse_url($_SERVER['HTTP_REFERER']);
if(!isset($url['host'])) {
    //print_r($url);
    die('未经授权，无法使用！');
}
if($url['host'] != 'open.web.meitu.com' and $url['host'] != 'www.ireoo.com' and $url['host'] != 'ireoo.com') {
    //print_r($url);
    die('未经授权，无法使用！');
}
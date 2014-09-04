<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ultra
 * Date: 13-8-9
 * Time: 下午4:40
 * To change this template use File | Settings | File Templates.
 */

header("Content-type: text/xml; charset=utf-8");
session_start();
include_once('../../lib/mysql.class.php');
include_once('../../lib/user.class.php');
include_once('lib/news.php');
include_once('lib/wechat.class.php');
include_once('../image/getRemoteImage.php');

include_once('include/getAccessToken.php');  //获取accesstoken

/**
 * 获取连接的企业信息
 */
$mysql = new mysql();
$storeId = $_GET['wx'];

if($storeId > 0) {
    $sql = array(
        'table' => 'store',
        'condition' => 'id = ' . $storeId
    );
    $r = $mysql->row($sql);
    define("TOKEN", $r['TOKEN']);
}else{
    define("TOKEN", 'ireoo');
}

/**
 * 获取用户发送的信息
 */
$wechatObj = new wechatCallbackapiTest();

/**
 * 用户权限
 * userType = 0[未绑定用户] , 1[绑定用户] , 2[管理员]
 */
$userType = 0;
$uid = 0;
$us = array(
    'table' => 'userToWechat',
    'condition' => "openid = '{$wechatObj->array['FROMUSERNAME']}' and wid = '{$wechatObj->array['TOUSERNAME']}'"
);
$ur = $mysql->row($us);
if($ur) {
    $userType = 1;
    $uid = $ur['uid'];
}

$ss = array(
    'table' => 'store',
    'condition' => 'uid = ' . $uid
);
$sr = $mysql->row($ss);
$sid = $sr['id'];
if(is_array($sr)) $userType = 2;

//$wechatObj->text(json_encode($wechatObj->array) . ', tousername:' . $wechatObj->array['TOUSERNAME'] . ', fromusername:' . $wechatObj->array['FROMUSERNAME']);
switch($wechatObj->array['MSGTYPE'])
{
    case 'text':    // 文本信息

        if($wechatObj->array['CONTENT'] == '首页'){
            $wechatObj->news(news($mysql, $wechatObj->array, $storeId));
        }elseif($wechatObj->array['CONTENT'] == 'ID'){
            $wechatObj->text($wechatObj->array['FROMUSERNAME']);
        }else{
            $wechatObj->text('亲，很抱歉，小益刚开始学习哦。不过用不了多久，小益就能明白您的意思啦！');
        }
        $wechatObj->save($mysql);
        break;

    case 'image':   // 图片信息
    
    	if($storeId > 0) {
	    	$wechatObj->text('亲，此功能可以即使更新照片到您的相册，如果您有店面的话，还可以直接在店面相册内显示哦！如需要使用该功能，请在新益［xinyinet］微信公众账号内才可以使用哦！');
	    	break;
    	}

        switch($userType)
        {
            case 0:
                $wechatObj->text('亲，绑定账号后可以通过这里上传照片更新到你的主页上哦！');
                break;
            case 1:
                $img = getImage("http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=" . ACCESS_TOKEN . "&media_id=" . $wechatObj->array['MEDIAID'], $uid, $sid, $mysql, 0);
                if($img['error'] == 0) {
                    //$wechatObj->text('照片上传成功！');

                    $list[] = array(
                        'title' => '上传成功',
                        'description' => '亲，这张照片已经保存到你的个人相册。',
                        'picurl' => 'http://ireoo.com/' . $img['file_name'],
                        'url' => "http://ireoo.com/3G{$sid}?i=photo&openid=" . $wechatObj->array['FROMUSERNAME'] . '&wid=' . $wechatObj->array['TOUSERNAME']
                    );
                    $wechatObj->news($list);
                    //$wechatObj->text($uid . json_encode($list));
                }else{
                    $wechatObj->text('上传失败！');
                }
                //$wechatObj->text('亲，此功能只对商家开放，方便管理者快捷上传企业照片！');
                break;
            case 2:
                $img = getImage("http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=" . ACCESS_TOKEN . "&media_id=" . $wechatObj->array['MEDIAID'], $uid, $sid, $mysql, 1);
                //$wechatObj->text($img['file_name']);
                if($img['error'] == 0) {
                    //$wechatObj->text('照片上传成功！');

                    $list[] = array(
                        'title' => '上传成功',
                        'description' => '亲，这张照片已经保存到你的个人相册，并在企业相册里展示。',
                        'picurl' => 'http://ireoo.com/' . $img['file_name'],
                        'url' => "http://ireoo.com/3G{$sid}?i=photo&openid=" . $wechatObj->array['FROMUSERNAME'] . '&wid=' . $wechatObj->array['TOUSERNAME']
                    );
                    //'http://www.ireoo.com/3G' . $storeId . 'index?openid=' . $wechatObj->array['FROMUSERNAME'] . '&wid=' . $wechatObj->array['TOUSERNAME']
                    $wechatObj->news($list);
                    //$wechatObj->text($uid . json_encode($list));
                }else{
                    $wechatObj->text('照片上传失败！');
                }
                //$wechatObj->text("http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=" . ACCESS_TOKEN . "&media_id={$wechatObj->array['MEDIAID']}");
                break;
            default:
                $wechatObj->text('亲，我还不知道你的身份哦！');
                break;
        }
        //$wechatObj->image($wechatObj->array['MEDIAID']);
        $wechatObj->save($mysql);
        break;

    case 'voice':   // 声音信息

        if(isset($wechatObj->array['RECOGNITION']) and $wechatObj->array['RECOGNITION'] != '') {
            $wechatObj->text('你是否说了“' . $wechatObj->array['RECOGNITION'] . '”');
        }
        $wechatObj->save($mysql);
        //$wechatObj->voice($wechatObj->mediaid);
        break;

    case 'video':   // 视频信息

        $wechatObj->text();
        $wechatObj->save($mysql);
        //$wechatObj->video($wechatObj->mediaid, 'video', 'return video');
        break;

    case 'location':// 地址信息

        $wechatObj->text('亲，您的个人信息已经更到当前位置了哦！');
        $wechatObj->save($mysql);
        break;

    case 'link':    // 短链接

        $wechatObj->text();
        $wechatObj->save($mysql);
        break;

    case 'event':   // 事件

        switch($wechatObj->array['EVENT'])
        {

            case '':       //当用户打开界面时信息

                $wechatObj->news(news($mysql, $wechatObj->array, $storeId));
                $wechatObj->save($mysql);
                break;

            case 'subscribe':       //未关注时，扫描二维码   eventkey   前缀  qrscene_

                $sql = array(
                    'table' => 'wechat',
                    'condition' => 'wid = "' . $r['wechatId'] . '" and openid = "' . $wechatObj->array['FROMUSERNAME'] . '"'
                );
                $result = $mysql->row($sql);

                if(is_array($result)) {
                    $mysql->update('wechat', array('subscribe' => 1), "openid = '" . $wechatObj->array['FROMUSERNAME'] . "' and wid = '" . $wechatObj->array['TOUSERNAME'] . "'");
                }else{
                    $sql = array(
                        'wid' => $wechatObj->array['TOUSERNAME'],
                        'openid' => $wechatObj->array['FROMUSERNAME'],
                        'subscribe' => 1,
                        'subscribe_time' => time()
                    );
                    $mysql->insert('wechat', $sql);
                }

                $wechatObj->news(news($mysql, $wechatObj->array, $storeId));
                $wechatObj->save($mysql);
                break;

            case 'unsubscribe':     //取消关注

                $mysql->update('wechat', array('subscribe' => 0), "openid = '" . $wechatObj->array['FROMUSERNAME'] . "' and wid = '" . $wechatObj->array['TOUSERNAME'] . "'");
                $wechatObj->text('亲，你就这么走了，多可惜啊！');
                $wechatObj->save($mysql);
                break;

            case 'scan':            //当用户关注时，再扫描二维码

                $wechatObj->text('用户已经扫描带二维码参数，参数为：' . json_encode($wechatObj->array));
                $wechatObj->save($mysql);
                break;

            case 'LOCATION':        //上报地理位置

                $wechatObj->text('亲，我们已经记录了您的详细位置了！');
                $wechatObj->save($mysql);
                break;

            case 'ENTER':           //用户进入对话

                $wechatObj->news(news($mysql, $wechatObj->array, $storeId));
                $wechatObj->save($mysql);
                break;

            case 'CLICK':           //自定义菜单事件

                //$wechatObj->text();
                switch ($wechatObj->array['EVENTKEY'])
                {
                    case 'home':
                        $wechatObj->news(news($mysql, $wechatObj->array, $storeId));
                        break;

                    case 'card':
                        if($uid == 0) {
                            $wechatObj->text('亲，您还没有绑定琦益帐号哦，绑定帐号以后可以在微信上直接查看您的账号信息哦！');
                        }else{

                            $s = array(
                                'table' => 'user',
                                'condition' => 'id = ' . $uid
                            );
                            $u = $mysql->row($s);

                            $neirong = '尊敬的琦益用户 ' . $u['username'] . '，您好！
余额：' . $u['money'] . '
积分：' . $u['integral'] . '

<a href="http://help.ireoo.com">更多功能，请点击这里。</a>';

                            $wechatObj->text($neirong);
                        }
                        break;

                    case 'like':

                        if($storeId > 0) {
                            $mysql->execute("UPDATE `store` SET `like` = `like` + 1 WHERE id = " . $storeId);
                        }else{
                            $mysql->execute("UPDATE `store` SET `like` = `like` + 1 WHERE id = 1");
                            $sql = array(
                                'table' => 'store',
                                'condition' => 'id = 1'
                            );
                            $r = $mysql->row($sql);
                        }
                        //$wechatObj->text("UPDATE `store` SET `like` = `like` + 1 WHERE id = " . $storeId . ' | ' . mysql_error());
                        $wechatObj->text('琦益感谢您的支持，您是第 ' . ($r['like'] + 1) . ' 个支持我们的人！');
                        break;

                    default:
                        $wechatObj->text();
                        break;
                }
                $wechatObj->save($mysql);
                break;

            default:                //事件信息未知

                $wechatObj->text('亲，小益无法识别您发送的事件信息类型哦，您是不是哪里输错了呢！？');
                $wechatObj->save($mysql);
                break;

        }

        break;

    default:                        //未知类型消息

        $wechatObj->text('亲，小益无法识别您发送的信息类型哦，您是不是哪里输错了呢！？');
        $wechatObj->save($mysql);
        break;
}
?>
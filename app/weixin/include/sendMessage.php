<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 13-12-8
 * Time: 下午10:14
 */

include_once('getAccessToken.php');
include_once('../lib/curl.class.php');

$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . ACCESS_TOKEN;
$curl = new cURL($url);

switch($_GET['type'])
{
    case 'text':

        $data = '{"touser":"' . $_GET['id'] . '","msgtype":"text","text":{"content":"' . $_GET['txt'] . '"}}';
        echo json_encode($curl->post($data));
        break;

    case 'image':

        $data = '{"touser":"OPENID","msgtype":"image","image":{"media_id":"MEDIA_ID"}}';
        echo json_encode($curl->post($data));
        break;

    case 'voice':

        $data = '{"touser":"OPENID","msgtype":"voice","voice":{"media_id":"MEDIA_ID"}}';
        echo json_encode($curl->post($data));
        break;

    case 'video':

        $data = '{"touser":"OPENID","msgtype":"video","video":{"media_id":"MEDIA_ID","thumb_media_id":"THUMB_MEDIA_ID"}}';
        echo json_encode($curl->post($data));
        break;

    case 'music':

        $data = '{"touser":"OPENID","msgtype":"music","music":{"title":"MUSIC_TITLE","description":"MUSIC_DESCRIPTION","musicurl":"MUSIC_URL","hqmusicurl":"HQ_MUSIC_URL","thumb_media_id":"THUMB_MEDIA_ID"}}';
        echo json_encode($curl->post($data));
        break;

    case 'news':

        $data = '{"touser":"OPENID","msgtype":"news","news":{"articles": [{"title":"Happy Day","description":"Is Really A Happy Day","url":"URL","picurl":"PIC_URL"},{"title":"Happy Day","description":"Is Really A Happy Day","url":"URL","picurl":"PIC_URL"}]}}';
        echo json_encode($curl->post($data));
        break;

    default:

        echo '{"error":"无法识别的模式", "success":false}';
        break;
}



?>
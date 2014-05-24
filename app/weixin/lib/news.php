<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 13-12-13
 * Time: 下午9:28
 */


function news($mysql, $array, $sid = 0)
{

    if($sid == 0) {

        $list[] = array(
            'title' => '琦益',
            'description' => '让您的生活更美好！',
            'picurl' => 'http://ireoo.com/uploads/u/s1bg.jpg',
            'url' => 'http://ireoo.com/3G1index?openid=' . $array['FROMUSERNAME'] . '&wid=' . $array['TOUSERNAME']
        );

        $s = array(
            'table' => 'store',
            'condition' => 'id != 1',
            'order' => 'id desc',
            'limit' => 'LIMIT 0, 9'
        );

        $re = $mysql->select($s);

        foreach($re as $k => $v) {
            $list[] = array(
                'title' => $v['store']['sname'],
                'description' => $v['store']['synopsis'],
                'picurl' => 'http://ireoo.com/' . $v['store']['avatar_large'],
                'url' => 'http://ireoo.com/3G' . $v['store']['id'] . 'index?openid=' . $array['FROMUSERNAME'] . '&wid=' . $array['TOUSERNAME']
            );
        }

        $list[] = array(
            'title' => '更多商家',
            'description' => '点击这里获取更多商家',
            'picurl' => 'http://ireoo.com/uploads/more.jpg',
            'url' => 'http://ireoo.com/store?openid=' . $array['FROMUSERNAME'] . '&wid=' . $array['TOUSERNAME']
        );

        return $list;
    }else{
        $s = array(
            'table' => 'store',
            'condition' => 'id = ' . $sid,
            'order' => 'id desc',
            'limit' => 'LIMIT 0, 9'
        );
        $re = $mysql->row($s);
        $list[] = array(
            'title' => $re['sname'],
            'description' => $re['synopsis'],
            'picurl' => 'http://ireoo.com/' . $re['avatar_large'],
            'url' => 'http://ireoo.com/3G' . $re['id'] . 'index?openid=' . $array['FROMUSERNAME'] . '&wid=' . $array['TOUSERNAME']
        );
        return $list;
    }

}

function card($mysql, $array, $uid = 0)
{

    if($uid == 0) {
        return false;
    }else{
        $list[] = array(
            'title' => '点击获取更多会员卡',
            'description' => '点击获取更多会员卡',
            'picurl' => 'http://ireoo.com/uploads/u/s1bg.jpg',
            'url' => 'http://ireoo.com/3Gstore?openid=' . $array['FROMUSERNAME'] . '&wid=' . $array['TOUSERNAME']
        );
        $s = array(
            'table' => 'card',
            'condition' => 'uid = ' . $uid,
            'limit' => 'LIMIT 0, 8'
        );
        $re = $mysql->select($s);
        foreach($re as $k => $v) {
            $sql = array(
                'table' => 'store',
                'condition' => 'id = ' . $v['card']['sid']
            );
            $s = $mysql->row($sql);
            $list[] = array(
                'title' => '[' . $s['sname'] . '会员卡]' . " 余额:" . $v['card']['money'] . "元 积分:" . $v['card']['integral'],
                'description' => $v['card']['money'],
                'picurl' => 'http://ireoo.com/' . $s['avatar_large'],
                'url' => 'http://ireoo.com/3G' . $v['card']['sid'] . '?i=card&openid=' . $array['FROMUSERNAME'] . '&wid=' . $array['TOUSERNAME']
            );
        }
        $list[] = array(
            'title' => '查看您领取的更多卡片，请点击这里',
            'description' => '查看您领取的更多卡片，请点击这里',
            'picurl' => 'http://ireoo.com/uploads/u/s1.jpg',
            'url' => 'http://ireoo.com/card?openid=' . $array['FROMUSERNAME'] . '&wid=' . $array['TOUSERNAME']
        );
        return $list;
    }

}

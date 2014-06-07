<?php
class store
{
    public $store = array();

    function __construct($s = array()) {
        $d = array(
            '`id`'                => NULL,
            '`show`'           => 0,
            '`uid`'              => 0,
            '`avatar`'          => 'uploads/u/storeAvatar.jpg',
            '`avatar_large`' => 'uploads/u/storeAvatar.jpg',
            '`sname`'         => '-',
            '`synopsis`'      => '-',
            '`province`'      => '江苏省',
            '`city`'           => '淮安市',
            '`qu`'           => '清河区',
            '`time`'            => date('Y'),
            '`form`'            => '未知',
            '`address`'       => '未知',
            '`GPS`'            => '0,0',
            '`ZOOM`'            => '0',
            '`area`'            => '未知',
            '`persons`'       => 0,
            '`follower`'       => 0,
            'TOKEN' => '',
            '`ip`'               => $this->getIP(),
            '`timer`'           => time()
        );
        $this->store = array_merge($d, $s);
    }

    function __destruct() {
    }

    function ad(mysql $mysql) {
        $s = array(
            'table'       => 'store',
            'condition' => "sname = '{$this->store['sname']}'"
        );
        $r = $mysql->row($s);
        if($r) return -2; //该实体店名已经被注册
        $r = $mysql->insert('store', $this->store);
        if(!$r) return -1;
        return $r;
    }

    function update(mysql $mysql, $s = array()) {
        $r = $mysql->update('store', $s, "id = {$this->store['id']}");
        if($r) {
            return true;
        }else{
            return mysql_error();
        }
    }

    function show(mysql $mysql, $s = array()) {
        $d = array(
            'table'       => 'store',
            'condition' => '1',
            'order'       => '`show` desc'
        );
        $s = array_merge($d, $s);
        $r = $mysql->select($s);
        if(!is_array($r)) return '2004'.$r.':'.mysql_error(); //查询失败
        $out = array();
        foreach($r as $k => $v) {
            $out[$k] = $v['store'];
        }
        //$this->more = $out;
        return $out;
    }

    function olist(mysql $mysql, $form = '1', $y = 1, $show = 20) {
        $now = ($y-1)*$show;
        $d = array(
            'table' => 'store',
            'condition' => $form,
            'order' => 'show desc',
            'limit' => "LIMIT $now, $show"
        );
        $r = $mysql->select($d);
        if(!is_array($r)) return 2008; //没有数据
        $out = array();
        foreach($r as $k => $v) {
            $out[$k] = $v['store'];
        }
        $o = array();
        //$o['list'] = $out;
        //$o['now'] = $now;
        $d = array(
            'table' => 'store',
            'condition' => $form,
            'order' => 'show desc'
        );
        $r = $mysql->select($d);
        if(!is_array($r)) return 2008; //没有数据
        $o['t'] = count($r);
        return $o;
    }

    function show_one(mysql $mysql) {
        //if($id == NULL) return 2005;
        $s = array(
            'table'       => 'store',
            'condition' => "id = {$this->store['id']}"
        );
        $r = $mysql->row($s);
        if(!is_array($r)) return 2006; //数据获取失败
        //$this->one = $r;
        return $r;
    }

    function show3G(mysql $mysql) {
        //if($id == NULL) return 2005;
        $s = array(
            'table'       => 'store3G',
            'condition' => "sid = {$this->store['id']}"
        );
        $r = $mysql->row($s);
        if(!is_array($r)) return 2006; //数据获取失败
        //$this->one = $r;
        return $r;
    }

    function getSay(mysql $mysql) {
        $s = array(
            'table' => 'say',
            'condition' => "sid = '{$this->store['id']}'",
            'order' => 'id desc'
        );
        $r = $mysql->select($s);
        if($r) {
            $out = array();
            foreach($r as $k => $v) {
                $out[$k] = $v['say'];
            }
            return $out;
        }else{
            return false;
        }
    }

    function getPhoto(mysql $mysql) {
        $s = array(
            'table' => 'image',
            'condition' => "sid = '{$this->store['id']}' and showStore = 1",
           'order' => 'id desc'
        );
        $r = $mysql->select($s);
        if($r) {
            $out = array();
            foreach($r as $k => $v) {
                $out[$k] = $v['image'];
            }
            foreach($out as $k => $v) {
                $size = $v['size'];
                if($size > 1024*1000*1000*1000) $out[$k]['size'] = floor($size/1024/1000/1000/1000)/100 . ' TB';
                elseif($size > 1024*1000*1000) $out[$k]['size'] = floor($size/1024/1000/1000)/100 . ' GB';
                elseif($size > 1024*1000) $out[$k]['size'] = floor($size/1024/1000*100)/100 . ' MB';
                elseif($size > 1024) $out[$k]['size'] = floor($size/1024*100)/100 . ' KB';
                else $out[$k]['size'] = $size . ' Byte';
            }
            return $out;
        }else{
            return false;
        }
    }

    function getGoods(mysql $mysql) {
        $s = array(
            'table' => 'goods',
            'condition' => "sid = '{$this->store['id']}'",
            'order' => 'id desc'
        );
        $r = $mysql->select($s);
        if($r) {
            $out = array();
            foreach($r as $k => $v) {
                $out[$k] = $v['goods'];
            }
            return $out;
        }else{
            return false;
        }
    }
    
    function getfollow(mysql $mysql) {
        $s = array(
            'table' => 'store_follow',
            'condition' => "sid = '{$this->store['id']}'",
            'order' => 'id desc'
        );
        $r = $mysql->select($s);
        if($r) {
            $out = array();
            foreach($r as $k => $v) {
                $out[$k] = $v['store_follow'];
                $uid = $v['store_follow']['uid'];
                $s = array(
                    'table' => 'user',
                    'condition' => "id = $uid"
                );
                $out[$k]['user'] = $mysql->row($s);
            }
            return $out;
        }else{
            return false;
        }
    }
    
    function addfollow(mysql $mysql, $id = NULL) {
        $s = array(
            'sid' => $this->store['id'],
            'uid' => $id,
            'timer' => time(),
            'ip' => getIP()
        );
        $r = $mysql->insert('store_follow', $s);
        if($r) return $r;
        return false;
    }

    function count($mysql) {
        $r = $mysql->update('store', array("count" => "count + 1"), "id = {$this->store['id']}");
        if($r) {
            return true;
        }else{
            return mysql_error();
        }
    }

    function timer($timer) {
        $t = time() - $timer;
        if($t < 60) return $t.'秒内';
        if($t < 60*60) return ceil($t/60).'分钟内';
        if($t < 60*60*24) return ceil($t/60/24).'小时内';
        if($t < 60*60*24*7) return ceil($t/60/60/24).'天内';
        if($t < 60*60*24*30) return date('d H:i', $timer);
        if($t < 60*60*24*365) return date('m-d', $timer);
        return date('Y-m-d', $timer);
    }

    function getIP() {
        if (@$_SERVER["HTTP_X_FORWARDED_FOR"])
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if (@$_SERVER["HTTP_CLIENT_IP"])
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        else if (@$_SERVER["REMOTE_ADDR"])
            $ip = $_SERVER["REMOTE_ADDR"];
        else if (@getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (@getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (@getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "unknown";
        return $ip;
    }
}
?>
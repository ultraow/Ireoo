<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ultra
 * Date: 13-2-5
 * Time: 下午7:22
 * To change this template use File | Settings | File Templates.
 */
class say
{
    function __construct() {
    }

    function __destruct() {
    }

    function get(mysql $mysql, $condition) {
        $s = array(
            'table' => 'say',
            'condition' => $condition,
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

    function say(mysql $mysql, $uid, $sid, $tid, $txt) {
        $d = array(
            'id'    => NULL,
            'uid'   => $uid,
            'sid'   => $sid,
            'tid'   => $tid,
            'txt'   => $txt,
            'ip'    => $this->getIP(),
            'timer' => time()
        );
        $sql = array(
            'table' => 'say',
            'condition' => "uid = '{$d['uid']}'",
            'order'     => "id desc"
        );
        $re = $mysql->row($sql);
        if($re){
            //print_r($re);
            //print_r(":{$re[0]['id']}");
            if($d['timer']-$re['timer']<=10) return 1015;
        }
        $re = $mysql->insert('say',$d);
        if($re){
            return 1013;
        }else{
            return '1014'.mysql_error();
        }
    }

    function del(mysql $mysql, $id) {
        return $mysql->delete('say', "id = '$id'");
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

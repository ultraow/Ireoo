<?php

/**
 * @author Ultra
 * @copyright 2012
 */


class goods {
    public $goods;
    
    function __construct($s = array()) {
        $d = array(
            'id' => null,
            'uid' => 0,
            'sid' => 0,
            'timer' => time(),
            'ip' => $this->getIP()
        );
        $this->goods = array_merge($d, $s);
    }
    
    function reg(mysql $mysql) {
        $s = array(
			'table' => 'goods',
			'condition' => "title = '{$this->goods['title']}'"
		);
        
        $r = $mysql->row($s);
        if($r) return 3003; //�ñ������title�Ѿ���ʹ��
        
        $r = $mysql->insert('store', $this->store);
		if(!$r) return '3002'.mysql_error(); //�����Ǽ�ʧ�ܣ����ش������
        
        return 3001;
    }
    
    function get(mysql $mysql, $uid = 0, $start = 0, $over = 10) {
        if($uid == 0) return array(); //��ȡ����������idû���ύ
        $s = array(
            'table' => 'goods',
            'condition' => "uid = $uid",
            'limit' => "LIMIT $start, $over"
        );
        $r = $mysql->select($s);
        if(!$r) return array(); //��ȡ��������ʧ��
        $l = array();
        foreach($r as $k => $v) {
	        $l[$k] = $v['goods'];
        }
        return $l;
    }
    
    function getAll(mysql $mysql, $id = 0) {
        if($id == 0) return array(); //��ȡ����������idû���ύ
        $s = array(
            'table' => 'goods',
            'condition' => "uid = $id and del != 1"
        );
        $r = $mysql->select($s);
        if(!$r) return array(); //��ȡ��������ʧ��
        $l = array();
        foreach($r as $v) {
            $l[] = $v['goods'];
        }
        return $l;
    }

    function getOne(mysql $mysql, $id) {
        $s = array(
            'table' => 'goods',
            'condition' => "id = $id"
        );
        $r = $mysql->row($s);
        if(!$r) return 3004; //��ȡָ��������Ϣʧ��
        return $r;
    }

    function getList(mysql $mysql, $id, $fid = 0) {
        $s = array(
            'table' => 'goodsList',
            'condition' => "sid = {$id} and gid = {$fid}"
        );
        $r = $mysql->select($s);
        if(!$r) return 3004; //��ȡָ��������Ϣʧ��
        $l = array();
        foreach($r as $v) {
            $l[] = $v['goodsList'];
        }
        return $l;
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
<?php

/**
 * @author Ultra
 * @copyright 2012
 */


class movie {
    public $movie;
    
    function __construct($s = array()) {
        $d = array(
            'id' => null,
            'uid' => 0,
            'sid' => 0,
            'timer' => time(),
            'ip' => $this->getIP()
        );
        $this->movie = array_merge($d, $s);
    }
    
    function reg(mysql $mysql) {
        $s = array(
			'table' => 'movie',
			'condition' => "title = '{$this->movie['title']}'"
		);
        
        $r = $mysql->row($s);
        if($r) return 3003; //该宝贝名称title已经被使用
        
        $r = $mysql->insert('store', $this->store);
		if(!$r) return '3002'.mysql_error(); //宝贝登记失败，返回错误代码
        
        return 3001;
    }
    
    function get(mysql $mysql, $uid = 0, $start = 0, $over = 10) {
        if($uid == 0) return array(); //获取宝贝数量的id没有提交
        $s = array(
            'table' => 'movie',
            'condition' => "uid = $uid",
            'limit' => "LIMIT $start, $over"
        );
        $r = $mysql->select($s);
        if(!$r) return array(); //获取宝贝数量失败
        $l = array();
        foreach($r as $k => $v) {
	        $l[$k] = $v['movie'];
        }
        return $l;
    }
    
    function getAll(mysql $mysql, $uid = 0) {
        if($uid == 0) return array(); //获取宝贝数量的id没有提交
        $s = array(
            'table' => 'movie',
            'condition' => "uid = $uid"
        );
        $r = $mysql->select($s);
        if(!$r) return array(); //获取宝贝数量失败
        return $r;
    }
	
	function show(mysql $mysql, $s = array()) {
        $d = array(
            'table' => 'movie'
        );
		$s = array_merge($d, $s);
        $r = $mysql->select($s);
        if(!$r) return array(); //获取宝贝数量失败
		$l = array();
		foreach($r as $k => $v) {
			$l[$k] = $v['movie'];
		}
        return $l;
    }
    
    function getOne(mysql $mysql, $id) {
        $s = array(
            'table' => 'movie',
            'condition' => "sid = $id"
        );
        $r = $mysql->row($s);
        if(!$r) return 3004; //获取指定宝贝信息失败
        return $r;
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
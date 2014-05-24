<?php
class keyword
{
	function __construct($kw = NULL) {
		$this->kw = $kw;
	}
	
	function __destruct() {
	}
	
	function ad(mysql $mysql) {
		if($this->kw == NULL) return false;
		$s = array(
			'table' 	=> 'keyword',
			'condition' => "`keyword` = '{$this->kw}'"
		);
		$r = $mysql->row($s);
		if($r) {
			$r = $mysql->execute("UPDATE `keyword` SET `bout` = `bout` + 1 WHERE `keyword` = '{$this->kw}';");
		}else{
			$r = $mysql->execute("INSERT INTO `keyword` (`id`, `uid`, `hot`, `keyword`, `bout`, `timer`, `ip`) VALUES (NULL, '0', '0', '{$this->kw}', '1', '".time()."', '".$this->getIP()."');");
		}
		if(!$r) return -1;
		return $r;
	}
	
	function show(mysql $mysql) {
		$d = array(
			'table' 	=> 'keyword',
			'condition' => "`keyword` like '%{$this->kw}%'",
			'order' 	=> '`bout` desc',
			'limit' 	=> 'LIMIT 0, 10'
		);
		$r = $mysql->select($d);
		if(!is_array($r)) return '2004'.$r.':'.mysql_error(); //查询失败
		$out = array();
		foreach($r as $k => $v) {
			$out[$k] = $v['keyword'];
		}
		//$this->more = $out;
		return $out;
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
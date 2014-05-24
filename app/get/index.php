<?php

	if(!isset($_POST['title'])) die('no title.');
	if(!isset($_POST['con'])) die('no con.');
	if(!isset($_POST['url'])) die('no url.');
	
	include_once('../../lib/mysql.class.php');
	$mysql = new mysql;
	
	$url = $_POST['url'];
	
	$s = array(
		'table' => 'news',
		'condition' => "url = '{$url}'"
	);
	$r = $mysql->row($s);
	if(is_array($r)) {

        die('数据已经存在！');
	
//		$s = array(
//			'title' => $_POST['title'],
//			'con' => $_POST['con'],
//			'url' => $_POST['url']
//		);
//		if($mysql->update('news', $s, "url = '{$url}'")){
//			echo '数据更新完毕！';
//		}else{
//			echo '数据更新失败！';
//		}
		
		
		
	}else{
	
		$s = array(
			'title' => $_POST['title'],
			'con' => $_POST['con'],
			'url' => $_POST['url'],
			'timer' => time()
		);
		
		if($mysql->insert('news', $s)) {
			echo 'success';
		}else{
			echo 'error';
		}
	
	}
	
?>
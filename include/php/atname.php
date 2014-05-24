<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
$get_start_time = time();
include_once("../../lib/mysql.class.php");
include_once("../../lib/user.class.php");
include_once("../../app/oauth/oauth2.php");

$own = new mysql();
	
$a = array(
	'username'=>$_POST['u']
);
$user = new user($a);
$result = $user->atname($own);

//die($result);
//$_SESSION['person'] = $user;
if($result == 1018) {
	die('可以注册');
	//print_r($_SESSION['user']);
	//$_SESSION['person'] = $user->person;
	//echo 'ok';
}else{
	die('已被注册');
	//echo $result;
}

?>
<?php

//error_reporting(0); //去除所有错误显示

if(isset($_GET['loginout'])) {
	if($_GET['loginout'] == 'yes') {
		unset($_SESSION['user']);
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/');
	}
}
$own = new mysql;
if(isset($_SESSION['user'])) {
	$user = new user();
	$o = $user->getID($own, $_SESSION['user']['id']);
    $s = array(
        'table' => 'store',
        'condition' => 'uid = ' . $_SESSION['user']['id']
    );
    $os = $own->row($s);
}else{
	$o = '';
}
defined('ROOT') or define('ROOT', dirname(__FILE__) . '/../../');

defined('HOST_NAME') or define('HOST_NAME','琦益网 - 企业产品直销平台');
defined('SNAME') or define('SNAME','琦益');
defined('HOST_URL') or define('HOST_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
defined('KEYWORDS') or define('KEYWORDS','琦益，琦益网，实体店，企业，琦益平台，琦益商城');
defined('DESCRIPTION') or define('DESCRIPTION','琦益，由淮安万达信息科技有限公司开发，专注于现实网络开发，是一款结合企业的宣传营销平台。通过琦益平台，可以快速销售您的产品！');
defined('GPS') or define('GPS','淮安');

$nature = array('网络', '实体');
//$form = array('种植林木养殖业', '农产品加工', '石油煤炭矿业开采', '采掘服务', '基础化学', '化学制品', '化工合成材料', '化工新材料', '钢铁有色冶炼加工', '建筑材料', '通用机械专用设备', '金属制品', '电气设备', '半导体及元件', '光学光电子', '其他电子', '汽车整车', '汽车零部件', '非汽车交运', '交运设备服务', '通讯设备', '计算机设备', '白色家电', '家用轻工', '试听器材', '饮料酒类制造', '食品加工制造', '纺织制造', '服装家纺', '造纸包装印刷', '中药化学制药', '生物制品', '医药医疗器械服务', '电力燃气水务', '公路铁路港口机场运输', '房地产开发', '建筑装饰', '景点及旅游', '酒店及餐饮', '银行保险证券', '零售、贸易、传媒', '通信服务', '计算机应用', '综合', '其他');
$s = array(
    'table' => 'form',
    'order' => 'xian asc'
);
$mysql = new mysql;
$f = $mysql->select($s);
$form = array();
foreach($f as $k => $v) {
    $form[$v['form']['id']] = $v['form']['value'];
}
//print_r($form);


$area = array('未知','微型','小型','中型','大型','集团');

$love = array('', '单身', '求交往', '暗恋中', '暧昧中', '恋爱中', '订婚', '已婚', '分居', '离异', '丧偶');
$blood = array('', 'A型血', 'B型血', 'AB型血', 'O型血');

$province = array('北京', '上海', '江苏', '浙江', '广东', '山西', '陕西', '广西', '湖南', '河南', '河北');
$city = array();
$city[0] = array('不限', '北京');
/*
$re = $own->select(array(
	'table' => 'log'
));
*/
//print_r($re);
//print_r($_SESSION['user']);
//$a = array('username'=>'ccalaop','password'=>'hanwei','email'=>'19980108@qq.com');
//$user = new user($a);
//$result = $user->login($own);
//$_SESSION['u'] = $user;
//$person = $_SESSION['person'];
//print_r($_SESSION['person']);
//print_r($person);
/*
$user = new user();
$txt = array(
	'uid' => $_SESSION['user']['id'],
	'txt' => 'this is test'
);
*/
//echo $user->say($own,$txt);
//$store = new store();
//echo $store->ad($own);
//print_r($store->show($own));
//print_r($store->more);
//print_r($user->m);
//print_r($store->show_one($own, 1));
//print_r($store->show_position($own, 1));
//$a = array('username'=>'ccalaop3','email'=>'19980109@qq.com','password'=>'hanwei','password_once'=>'hanwei');
//$u = new user($a);
//echo $u->reg($own);
//print_r($u->m);
//$user->name();
//echo $user->m[3];
//print_r($user->m);
/*
$a = array(
			'table'=>'user',
			'condition' => "username = 'ccalaop'"
		);
		$re = $own->row($a);
		if($re) {
			print_r($re);
		}else{
			print_r($a);
		}
*/
function thisIP() {
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
function utf_substr($str,$len){
for($i=0;$i<$len;$i++){
   $temp_str=substr($str,0,1);
   if(ord($temp_str) > 127){
    $i++;
    if($i<$len){
     $new_str[]=substr($str,0,3);
     $str=substr($str,3);
    }
   }
   else{
    $new_str[]=substr($str,0,1);
    $str=substr($str,1);
   }
}
return join($new_str);
}

function echoGet($no = '') {
    $n = explode(',', $no);
    $i = 0;
    $g = $_GET;
    foreach($_GET as $k => $v) {
        foreach($n as $kn => $vn) {
            if($vn == $k) {
                unset($g[$k]);
            }
        }
    }
    foreach($g as $k => $v) {
        echo $k . '=' . $v . '&';
        $i++;
    }
}

?>

<?php
/**
 * Note:for octet-stream upload
 * �������ʽ�ϴ�PHP�ļ�
 * Please be amended accordingly based on the actual situation
 */

session_start();
include_once("../../lib/mysql.class.php");
include_once("../../lib/user.class.php");
include_once("../../include/php/php.php");
include_once("../oauth/oauth2.php");

$photo = md5(time() . rand(10000,99999));

$post_input = 'php://input';
$save_path = dirname( __FILE__ ) . '/../../uploads/';
$postdata = file_get_contents( $post_input );

$id = $_GET['sid'];
//print_r($_GET);
$mysql = new mysql();
$s = array(
    'sid' => $_GET['id'],
    'uid' => $o['id'],
    'uri' => 'uploads/' . $o['id'] . '/'. $photo . '.jpg',
    'data' => $postdata,
    'showStore' => '0',
    'showUser' => '1',
    'size' => strlen($postdata),
    'timer' => time()
);

if(isset($_GET['text'])) $s['text'] = $_GET['text'];

//echo $os['id'];
//echo $save_path;
//echo $photo;

if (!file_exists($save_path)) mkdir($save_path);
if (!file_exists($save_path . $o['id'])) mkdir($save_path . $o['id']);

if (isset($postdata) && strlen($postdata) > 0) {
    $filename = $save_path . $o['id'] . '/'. $photo . '.jpg';
    $handle = fopen($filename, 'w+');
    fwrite($handle, $postdata);
    fclose($handle);
    if ( is_file($filename)) {
        $r = $mysql->insert('image', $s);
        //echo mysql_error();
        //echo 'uploads/' . $o['id'] . '/'. $photo . '.jpg';
        echo $r;
        exit ();
    }else {
        //echo $filename;
        die ( '0');
    }
}else {
    die ( '-1');
}

?>
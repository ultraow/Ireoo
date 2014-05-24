<?php

// The file
include_once("../../lib/mysql.class.php");
include_once("../../include/php/php.php");
$mysql = new mysql;
$id = intval($_GET['t']);
$len = intval($_GET['l']);
$s = array(
          'table' => 'image',
          'condition' => 'id = ' . $id
);
$r = $mysql->row($s);
if($len == 0) header('Location: ' . HOST_URL);
if(!isset($r['uri'])) header('Location: ' . HOST_URL);
$filename = '../' . $r['uri'];
$x = intval($_GET['x']);
$y = intval($_GET['y']);
// Content type
header('Content-type: image/jpeg charset=utf-8');
//print_r($x.':'.$y."<br />");


list($width, $height) = getimagesize($filename);
//print_r($width.':'.$height."<br />");
if($width < $height) {
    $w = 180;
    $h = round(($height/$width)*$w);
}else{
    $h = 180;
    $w = round(($width/$height)*$h);
}
//print_r($w.':'.$h."<br />");
$nx = round(($w/$width)*$x);
$ny = round(($h/$height)*$y);
//print_r($nx.':'.$ny."<br />");

// Resample
$image = imagecreatetruecolor($w, $h);
$image_p = imagecreatefromjpeg($filename);
imagecopyresampled($image, $image_p, 0, 0, 0, 0, $w, $h, $width, $height);
$t = imagecreatetruecolor(180, 180);
imagecopyresampled($t, $image, 0, 0, -$x, -$y, 180, 180, 180, 180);
$t1 = imagecreatetruecolor($len, $len);
imagecopyresampled($t1, $t, 0, 0, 0, 0, $len, $len, 180, 180);
//$textcolor = imagecolorallocate($image, 255, 255, 255);
////imagestring($image,2,5,5,"Vjentaino.com",$textcolor);
//imagedestroy($image_p);
/*
$image = imagecreatefrompng("images/watermark.png");
list($width, $height) = getimagesize("images/watermark.png");
imagecopy($image_p,$image,$out_w-$width,$out_h-$height,0,0,$width,$height);
imagedestroy($image); 
*/
// Output

imagejpeg($t1, null, 100);
imagedestroy($t1);


?>
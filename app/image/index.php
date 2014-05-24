<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ultra
 * Date: 13-10-14
 * Time: 下午8:52
 * To change this template use File | Settings | File Templates.
 */

// Content type
header('Content-type: image/jpeg charset=UTF-8');
include_once('../../lib/mysql.class.php');
$mysql = new mysql();

$id = $_GET['id'];
$width = $_GET['width'];
$height = $_GET['height'];
$type = $_GET['type'];

$s = array(
    'table' => 'image',
    'condition' => 'id = ' . $id
);
$img = $mysql->row($s);
$sourceImage = '../../' . $img['uri']; //获取图片地址

list($sourceWidth, $sourceHeight) = getimagesize($sourceImage); //获取原图大小

if($type == 0) {
    if($sourceWidth / $sourceHeight > $width / $height) {
        $newHeight = $height;
        $newWidth = $newHeight / $sourceHeight * $sourceWidth;
        $newX = 0;
        $newY = 0;
        $sourceX = ($newWidth - $width) / 2 * $sourceHeight / $newHeight;
        $sourceY = 0;
    }else{
        $newWidth = $width;
        $newHeight = $newWidth / $sourceWidth * $sourceHeight;
        $newX = 0;
        $newY = 0;
        $sourceX = 0;
        $sourceY = ($newHeight - $height) / 2 * $sourceWidth / $newWidth;
    }

}else{
    if($sourceWidth / $sourceHeight > $width / $height) {
        $newWidth = $width;
        $newHeight = $newWidth / $sourceWidth * $sourceHeight;
        $newX = 0;
        $newY = -($newHeight - $height) / 2;
        $sourceX = 0;
        $sourceY = 0;
    }else{
        $newHeight = $height;
        $newWidth = $newHeight / $sourceHeight * $sourceWidth;
        $newX = -($newWidth - $width) / 2;
        $newY = 0;
        $sourceX = 0;
        $sourceY = 0;
    }

}

$image = imagecreatetruecolor($width, $height); //创建一个新的图片
$source = imagecreatefromjpeg($sourceImage); //获取原图数据

$background = imagecolorallocate($image, 0, 0, 0);
imagefilledrectangle($image, 0, 0, $width, $height, $background);

imagecopyresampled($image, $source, $newX, $newY, $sourceX, $sourceY, $newWidth, $newHeight, $sourceWidth, $sourceHeight); //将原图数据放到新的图片中

$text_color = imagecolorallocate($image, 255, 255, 255);
$word = "newWidth:{$newWidth}, newHeight:{$newHeight}, newX:{$newX}, newY:{$newY}";
//imagestring($image, 2, 2, 2,  $word, $text_color);

/**
 * $text_color = imagecolorallocate($image, 255, 255, 255);
 * $word = "iR";
 * imagestring($image, 2, 2, 2,  $word, $text_color);
 *
 * 添加水印
 *
 */


imagejpeg($image, null, 100);
imagedestroy($image);

?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px;}
    div.mian ol.showAll li{font-size: 12px; padding-top: 5px; padding-bottom: 10px;}

    div.mian ol.showAll li div{position: relative; display: inline-block; float: left;}
    div.mian ol.showAll li div a{display: inline-block;}
    div.mian ol.showAll li div a.close{position: absolute; right: 3px; top: 3px; width: 20px; height: 20px; text-align: center; line-height: 20px; color: red; background: #FFF; font-weight: bolder;}
    div.mian ol.showAll li div a.close:hover{background: red; color: #FFF;}
    div.mian ol.showAll li div a img{width: 100px; height: 100px; border: 1px #EBEBEB solid; margin: 2px;}
    div.mian ol.showAll li h1{height: 30px; line-height: 30px; margin-bottom: 2px;}

</style>
<?php

if(isset($_GET['del']) and $_GET['del'] == 'yes') {

    $s = array(
        'table' => 'image',
        'condition' => 'id = ' . $_GET['id']
    );
    //if(isset($_GET['id'])) $s['limit'] = 'LIMIT 0,10';
    $p = $mysql->row($s);
    unlink($p['uri']);
    $mysql->delete('image', 'id = ' . $_GET['id']);

    header("Location: /i?s=person&i=photo");
}

$userID = $o['id'];

$s = array(
    'table' => 'image',
    'condition' => 'uid = ' . $userID,
    'order' => 'id desc'
);
//if(isset($_GET['id'])) $s['limit'] = 'LIMIT 0,10';
$photo = $mysql->select($s);
?>


<ol class="showAll">
    <li>
        <?php
        if(is_array($photo)){ foreach($photo as $k => $v) {
            $l = $v['image'];
        ?>
        <div>
            <a class="close" href="?s=person&i=photo&id=<?php echo $l['id']; ?>&del=yes">X</a>
            <a href="/photo.<?php echo $l['id']; ?>">
                <img id="photo" rel="<?php echo $l['size']; ?>" src="<?php echo '/image.'.$l['id'].'.100.100.0'; ?>" />
            </a>
        </div>
        <?php }}else{echo '<li style="text-align: center; font-size: 12px; border: none;">管理员很懒，还没有上传照片！</li>';} ?>
    </li>
</ol>

<div class="clear"></div>
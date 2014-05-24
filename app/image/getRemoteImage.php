<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-1-9
 * Time: 上午9:34
 */

function getImage($url, $uid = 0, $sid = 0, $mysql, $storeShow = 0) {
    $save_dir = dirname( __FILE__ ) . '/../../uploads/' . $uid . '/';
    $filename = md5(time() . rand(10000,99999)) . '.jpg';
    $type = 0;
    $error = 0;
    if(trim($url)=='') {
        return array('file_name'=>'','save_path'=>'','error'=>1);
    }
    if(trim($save_dir)=='') {
        $save_dir='./';
    }
    if(trim($filename)=='') {//保存文件名
        $ext=strrchr($url,'.');
        if($ext!='.gif'&&$ext!='.jpg') {
            return array('file_name'=>'','save_path'=>'','error'=>3);
        }
        $filename=time().$ext;
    }
    if(0!==strrpos($save_dir,'/')) {
        $save_dir.='/';
    }
    //创建保存目录
    if(!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {
        return array('file_name'=>'','save_path'=>'','error'=>5);
    }
    //获取远程文件所采用的方法
    if($type) {
        $ch=curl_init();
        $timeout=5;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $img=curl_exec($ch);
        curl_close($ch);
    }else{
        ob_start();
        readfile($url);
        $img=ob_get_contents();
        ob_end_clean();
    }
    //$size=strlen($img);
    //文件大小
    $fp2=@fopen($save_dir.$filename, 'a');
    if(!fwrite($fp2, $img)){
	    $error = '文件无法写入';
    }
    fclose($fp2);
    $s = array(
        'sid' => $sid,
        'uid' => $uid,
        'uri' => 'uploads/' . $uid . '/'. $filename,
        'data' => '',
        'showStore' => $storeShow,
        'showUser' => '1',
        'size' => strlen($img),
        'timer' => time()
    );
    $mysql->insert('image', $s);
    unset($img, $url);
    return array('file_name'=>'uploads/' . $uid . '/'. $filename,'save_path'=>$save_dir.$filename,'error'=>$error);
}

?>
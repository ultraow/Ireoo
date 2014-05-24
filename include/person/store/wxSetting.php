<?php
if(!isset($os) or $os['id'] == '') header("Location: /i?s=store&i=storeAdd");
$id = $os['id'];

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        $r1 = $mysql->update('store', $_POST, "id = $id");
        //print_r($_POST);
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=store&i=wxSetting");
    }
}

$store = new store;

$s = $store->show($mysql, array('condition'=>"id = $id"));
if($s['TOKEN'] == '') {$mysql->update('store', array('TOKEN'=>md5($os['id'])), "id = $id");}
$s = $s[0];

?>
<style type="text/css">
    div.mian ol{}

    div.mian ol h2{margin-bottom: 0;}
    
    div.mian ol li{font-size: 12px; padding-top: 30px; padding-bottom: 0;}
    div.mian ol li a{font-size: 12px; cursor: pointer;}
    div.mian ol li a:hover{text-decoration: underline;}

    div.mian ol li label{display: inline-block; text-align: left; font-size: 12px; color: #000; padding: 5px; vertical-align: top;}
    div.mian ol li input.radio{margin-top: 8px;}
    div.mian ol li input.text{padding: 5px;}


    div.mian ol div{background: #EBEBEB; padding: 10px;}
    div.mian ol div li{padding-top: 5px; padding-bottom: 5px;}

    div.mian ol li button{padding: 5px 20px;}
    button{padding: 5px 20px;}
</style>

<ol>
    <h1>微信连接配置</h1>
    <h2>按照步骤，简单几步就可以配置微信</h2>
    
    <form action="?s=store&i=wxSetting&mode=1&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">

        <li>
            <h3>一、开启或关闭微信公众平台</h3>
            <input class="radio" id="open1" name="wechat" type="radio" value="1"<?php if($s['wechat'] == 1) {echo ' checked="checked"';} ?> /><label for="open1">开启微信公众平台(默认)</label>
            <input class="radio" id="open2" name="wechat" type="radio" value="2"<?php if($s['wechat'] == 2) {echo ' checked="checked"';} ?> /><label for="open2">关闭微信公众平台</label>
        </li>

        <li>
            <h3>二、绑定微信账号</h3>
            <label>微信ID:</label><input class="text" name="wechatId" type="text" value="<?php echo  $s['wechatId']; ?>" />
        </li>

	    <li>
	    	<h3>二、选择官方公用平台或自己申请微信公众平台并填入参数</h3>
	    	<input class="radio" id="mode1" name="wc_mode" type="radio" value="1"<?php if($s['wc_mode'] == 1) {echo ' checked="checked"';} ?> /><label for="mode1" onclick="$('#url').hide()">圈网公众账号，可以快速获得更多用户(默认)</label>
                <input class="radio"<?php if($s['show'] != 2) {echo ' disabled';} ?> id="mode2" name="wc_mode" type="radio" value="2"<?php if($s['wc_mode'] == 2) {echo ' checked="checked"';} ?> /><label for="mode2"<?php if($s['show'] == 2) { ?> onclick="$('#url').show()"<?php } ?>>自行申请微信公众账号<?php if($s['show'] != 2) { ?>(充值1000元即可开通，还可以发布产品。)<?php } ?></label>
	    </li>
	    
	    <div id="url"<?php if($s['wc_mode'] == 1) {echo ' style="display: none;"';} ?>>
		    <li>微信API接口： http://www.ireoo.com/wx<?php echo $s['id']; ?></li>
		    <li>微信token： <?php echo md5($s['id']); ?></li>
	    </div>
	    
	    <li><button>保存</button></li>
        
    </form>

</ol>
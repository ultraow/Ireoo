<?php
if(!isset($os)) header("Location: /");
$id = $os['id'];

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        if($mysql->update('user', $_POST, "id = {$o['id']}")) {
            $o = $user->getID($own, $o['id']);
        }else{
            echo mysql_error();
        }
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=person&i=account");
    }
}
?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px;}
    div.mian ol li{font-size: 12px; padding-top: 5px; padding-bottom: 10px;}
    div.mian ol li a{font-size: 14px; cursor: pointer;}
    div.mian ol li a:hover{text-decoration: underline;}

    div.mian ol li label{display: inline-block; width: 100px; font-size: 12px; font-weight: bold; color: #000; padding: 5px; vertical-align: top;}
    div.mian ol li input{padding: 5px; font-size: 12px; width: 272px;}
    div.mian ol li input.check, div.mian ol li label.auto{width: auto;}
    div.mian ol li select.max{width: 212px;}
    div.mian ol li select{padding: 5px;}

    div.mian ol li ul.city{display: inline-block; width: 680px; margin-left: -4px; border: 1px solid #ffd88a; background: #FFE69F; padding: 10px;}
    div.mian ol li ul li{position: relative; display: inline-block; font-size: 14px; padding: 5px; cursor: pointer;}
    div.mian ol li ul li ul{position: absolute; display: none; left: 36px; top: 0; z-index: 3; width: 40px; border: 1px solid #4898F8; background: #FFF;}
    div.mian ol li ul li.hover{background: #4898F8; color: #FFF;}
    div.mian ol li ul li.hover ul{display: inline-block;}
    div.mian ol li ul li ul li{display: block; font-size: 12px;}
    div.mian ol li ul li ul li a{font-size: 12px;}
    div.mian ol li ul li ul li a:hover, div.mian ol li ul li ul li:hover a, div.mian ol li ul li ul li:hover{background: #4898F8; color: #FFF; text-decoration: none;}
    div.mian ol li ul h1{display: inline-block; border: none; font-size: 12px; font-weight: normal; color: #333; background: RGB(201, 201, 201); cursor: pointer;}

    textarea{width: 272px; padding: 5px; height: 80px;}
    button{padding: 5px 20px;}
</style>

<ol class="account">

    <form action="?s=person&i=account&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">
        <h1>基本资料<span>( <b>*</b>必须填写项 )</span></h1>
        <span class="h2">以下信息将显示在个人资料页，方便大家了解你。</span>
        <li>
            <label>昵称：</label>
            <input name="username" value="<?php echo $o['username']; ?>" />
        </li>
        <li>
            <label>性别：</label>
            <select class="max" name="sex">
                <option<?php if($o['sex'] == '男') {echo ' selected';} ?> value="男">男</option>
                <option<?php if($o['sex'] == '女') {echo ' selected';} ?> value="女">女</option>
            </select>
        </li>
        <li>
            <label>情感：</label>
            <select name="love">
                <?php foreach($love as $k => $v) { ?>
                    <option<?php if($v == $o['love']) {echo ' selected';} ?> value="<?php echo $v; ?>"><?php echo $v; ?></option>
                <?php } ?>
            </select>
        </li>
        <li>
            <label>生日：</label>
            <select name="year">
                <?php for($i = 1970; $i<=date('Y'); $i++) { ?>
                <option<?php if($i == $o['year']) {echo ' selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
            年
            <select name="mouth">
                <?php for($i = 1; $i<=12; $i++) { ?>
                    <option<?php if($i == $o['mouth']) {echo ' selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
            月
            <select name="day">
                <?php for($i = 1; $i<=31; $i++) { ?>
                    <option<?php if($i == $o['day']) {echo ' selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
            日
        </li>

        <li>
            <label>城市：</label>
            <input type="text" readonly name="city" value="<?php echo $o['city']; ?>" />
        </li>

        <li>
            <label>详细地址：</label>
            <input name="address" value="<?php echo $o['address']; ?>" />
        </li>

        <li>
            <label>联系邮箱：</label>
            <input name="email" value="<?php echo $o['email']; ?>" />
        </li>
        <li>
            <label>联系电话：</label>
            <input name="phone" value="<?php echo $o['phone']; ?>" />
        </li>
        <li>
            <label>qq：</label>
            <input name="qq" value="<?php echo $o['qq']; ?>" />
        </li>
        <li>
            <label>微信号：</label>
            <input name="wechat" value="<?php echo $o['wechat']; ?>" />
        </li>
        <li>
            <label>SKYPE：</label>
            <input name="Skype" value="<?php echo $o['Skype']; ?>" />
        </li>

        <li class="textarea">
            <label>一句话介绍：</label>
            <textarea name="synopsis"><?php echo $o['synopsis']; ?></textarea>
        </li>

        <h1>名片资料<span>( <b>*</b>必须填写项 )</span></h1>
        <span class="h2">以下信息将显示在个人资料页，方便大家了解你。</span>
        <li>
            <label>真实姓名：</label>
            <input name="realname" value="<?php echo $o['realname']; ?>" />
        </li>
        <li>
            <label>工作电话：</label>
            <input name="workphone" value="<?php echo $o['workphone']; ?>" />
        </li>
        <li>
            <label>家庭电话：</label>
            <input name="homephone" value="<?php echo $o['homephone']; ?>" />
        </li>

        <li>
            <label>所在公司：</label>
            <input name="company" value="<?php echo $o['company']; ?>" />
        </li>
        <li>
            <label>当前职位：</label>
            <input name="office" value="<?php echo $o['office']; ?>" />
        </li>

        <li class="bu">
            <button>保存</button>
            <span class="result"></span>
        </li>
    </form>
</ol>
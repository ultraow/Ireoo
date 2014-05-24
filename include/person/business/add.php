<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-1-22
 * Time: 下午8:56
 */

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        $user = new user($_POST);
        $user->reg($mysql);
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

    div.mian ol li .radio{display: inline-block; width: auto; font-size: 12px; font-weight: bold; color: #000; padding: 5px; vertical-align: top; text-align: left;}

    textarea{width: 272px; padding: 5px; height: 80px;}
    button{padding: 5px 20px;}
</style>

<ol class="account">

    <form action="?s=person&i=account&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">
        <h1>添加代理<span>( <b>*</b>必须填写项 )</span></h1>
        <span class="h2">添加顶级代理</span>
        <li>
            <label>手机：</label>
            <input type="text" name="phone" value="" />
        </li>
        <li>
            <label>邮箱：</label>
            <input type="text" name="email" value="" />
        </li>

        <li>
            <label>城市：</label>
            <input type="text" readonly name="city" value="<?php echo $o['city']; ?>" />
        </li>

        <?php
        $sql = array(
            'table' => 'location',
            'condition' => "title = '{$o['city']}'"
        );
        $city = $mysql->row($sql);
        $sql = array(
            'table' => 'location',
            'condition' => "lid = {$city['id']}"
        );
        $area = $mysql->select($sql);
        ?>

        <li>
            <label>区域：</label>
            <select name="area">
                <?php foreach($area as $key => $value) {$v = $value['location']; ?>
                <option value="<?php echo $v['title']; ?>"><?php echo $v['title']; ?></option>
                <?php } ?>
            </select>
        </li>

        <li>
            <label>商城功能：</label>
            <input id="open" class="radio" name="goods" type="radio" value="2" /><label class="radio" for="open">开启</label>
            <input id="close" class="radio" checked name="goods" type="radio" value="1" /><label class="radio" for="close">关闭</label>
        </li>

        <li>
            <label>密码：</label>
            <input type="password" name="password" value="" />
        </li>
        <li>
            <label>确认密码：</label>
            <input type="password" name="password_once" value="" />
        </li>

        <li class="bu">
            <button>保存</button>
            <span class="result"></span>
        </li>
    </form>
</ol>
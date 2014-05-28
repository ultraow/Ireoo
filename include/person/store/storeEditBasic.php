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
        header("Location: /i?s=store&i=storeEditBasic");
    }
}

$store = new store;
$s = $store->show($mysql, array('condition'=>"id = $id"));
$s = $s[0];

?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px;}
    div.mian ol li{font-size: 12px; padding-top: 5px; padding-bottom: 10px;}
    div.mian ol li a{font-size: 14px; cursor: pointer;}
    div.mian ol li a:hover{text-decoration: underline;}

    div.mian ol li label{display: inline-block; width: 100px; font-size: 12px; font-weight: bold; color: #000; padding: 5px; vertical-align: top;}
    div.mian ol li input{padding: 5px; font-size: 12px; width: 272px;}
    div.mian ol li input.check, div.mian ol li label.auto{width: auto;}
    div.mian ol li select.max{width: 284px;}
    div.mian ol li select{padding: 5px;}
    div.mian ol li button{padding: 5px 20px;}

    div.mian ol li ul.city{display: inline-block; width: 680px; margin-left: -4px; border: 1px solid #ffd88a; background: #FFE69F; padding: 10px;}
    div.mian ol li ul li{position: relative; display: inline-block; font-size: 14px; padding: 5px; cursor: pointer;}
    div.mian ol li ul li ul{position: absolute; display: none; left: 36px; top: 0; z-index: 3; width: 40px; border: 1px solid #4898F8; background: #FFF;}
    div.mian ol li ul li.hover{background: #4898F8; color: #FFF;}
    div.mian ol li ul li.hover ul{display: inline-block;}
    div.mian ol li ul li ul li{display: block; font-size: 12px;}
    div.mian ol li ul li ul li a{font-size: 12px;}
    div.mian ol li ul li ul li a:hover, div.mian ol li ul li ul li:hover a, div.mian ol li ul li ul li:hover{background: #4898F8; color: #FFF; text-decoration: none;}
    div.mian ol li ul h1{display: inline-block; border: none; font-size: 12px; font-weight: normal; color: #333; background: RGB(201, 201, 201); cursor: pointer;}

    input.state, input.city{cursor: pointer;}
    button{padding: 5px 20px;}
</style>

<ol>
    <h1>基本资料</h1>
    <h2>我们会记录你的每一次编辑/修改，见证你的圈圈成长！</h2>
    <form action="?s=store&i=storeEditBasic&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">
        <li>
            <label>名称：</label>
            <input type="text" class="max" name="sname" value="<?php echo $s['sname']; ?>" />
        </li>

        <li>
            <label>简介：</label>
            <input type="text" class="max" name="synopsis" value="<?php echo $s['synopsis']; ?>" />
        </li>

        <?php
        $sql = array(
            'table' => 'location',
            'condition' => "lid = 0"
        );
        $a = $mysql->select($sql);
        ?>
        <li>
            <label>城市：</label>
            <select name="city">
                <?php foreach($a as $key => $value) {$v = $value['location']; ?>
                    <option<?php if($v['title'] == $o['city']) {echo ' selected';} ?> value="<?php echo $v['id']; ?>"><?php echo $v['title']; ?></option>
                <?php } ?>
            </select>
        </li>
        
        <li>
            <label>详细地址：</label>
            <input type="text" name="address" class="max" value="<?php echo $s['address']; ?>" />
        </li>
        
        <li>
            <label>类型：</label>
            <select class="max" name="nature">
			<?php foreach($nature as $k => $v) { ?>
				<option<?php if($s['nature'] == $v) {echo ' selected="selected"';} ?> value="<?php echo $v; ?>"><?php echo $v; ?></option>
			<?php } ?>
            </select>
        </li>
        
        <li>
            <label>性质：</label>
            <select class="max" name="form">
                <?php foreach($form as $k => $v) { ?>
                    <option<?php if($s['form'] == $k) {echo ' selected="selected"';} ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
                <?php } ?>
            </select>
        </li>
        
        <li>
            <label>规模：</label>
            <select class="max" name="area">
                <?php foreach($area as $k => $v) { ?>
                    <option<?php if($s['area'] == $v) {echo ' selected="selected"';} ?> value="<?php echo $v; ?>"><?php echo $v; ?></option>
                <?php } ?>
            </select>
        </li>
        
        <li>
            <label>员工人数：</label>
            <input type="text" class="max" name="persons" value="<?php echo $s['persons']; ?>" />
        </li>

        <li>
            <label>成立时间：</label>
            <input type="text" class="max" name="time" value="<?php echo $s['time']; ?>" />
        </li>

        <li><button>保存</button></li>
    </form>
</ol>
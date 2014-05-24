<?php
$id = $os['id'];

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        $r1 = $mysql->update('store', $_POST, "id = $id");
        //print_r($_POST);
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=store&i=storeBid");
    }
}

$store = new store;
$s = $store->show($mysql, array('condition'=>"id = $id"));
$s = $s[0];

?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px;}
    div.mian ol li{font-size: 12px; padding-top: 5px; padding-bottom: 10px;}
    div.mian ol li a{font-size: 12px; cursor: pointer;}
    div.mian ol li a:hover{text-decoration: underline;}

    div.mian ol li label.title{display: inline-block; width: 100px; font-size: 12px; font-weight: bold; color: #000; padding: 5px; vertical-align: top;}
    div.mian ol li label.for{padding-left: 5px; padding-right: 20px;}
    div.mian ol li input{padding: 5px; font-size: 12px;}
    div.mian ol li input.check, div.mian ol li label.auto{width: auto;}
    div.mian ol li select.max{width: 284px;}
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

    div.mian ol li span{color: #CCC;}

    div.waring{background: #fff2b9; border: 1px solid #ffe381; padding: 10px; font-size: 12px; margin-bottom: 40px;}

    input.state, input.city{cursor: pointer;}
    button{padding: 5px 20px;}
</style>

<ol>
    <h1>竞价排名</h1>
    <h2>如果您需要您的实体店或企业信息在首页显示，需开启竞价排名功能，并且每点击一次，需要提供您设置的相应费用。</h2>

    <div class="waring">当前为使用官方微信公众平台，由于微信的限制，我们无法在首页完全显示圈网内的所有商家，为了各位商家提供更优质的服务，我们决定显示在官方微信公众平台的商家提供竞价排名服务。请按照您的实际需求进行竞价！</div>

    <form action="?s=store&i=storeBid&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">

        <li>
            <input type="radio" id="wc_bidopen1" name="wc_bidOpen" value="0"<?php if($s['wc_bidOpen'] == 0) {echo ' checked="checked"';} ?> /><label class="for" for="wc_bidopen1">关闭竞价排名</label>
            <input type="radio" id="wc_bidopen2" name="wc_bidOpen" value="1"<?php if($s['wc_bidOpen'] == 1) {echo ' checked="checked"';} ?> /><label class="for" for="wc_bidopen2">开启竞价排名</label>
            <span>默认关闭竞价排名</span>
        </li>

        <li>
            <label>竞价金额：</label>
            <input type="text" class="max" name="wc_bid" value="<?php echo $s['wc_bid']; ?>" />
            <span>价格越高，排名越靠前。当前排名竞价依次为 ：10元，9元，8元，7元，6元，5元，4元，3元，2元。</span>
        </li>

        <li>
            <label>当前余额：</label>
            <input type="text" readonly="readonly" class="max" value="<?php echo $o['money']; ?>" />
            <span><a href="#">充值</a>余额，兑换比例 1：1</span>
        </li>

        <li><button>保存</button></li>
    </form>
</ol>
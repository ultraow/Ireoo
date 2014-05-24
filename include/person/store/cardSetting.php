<?php
$id = $os['id'];

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        //print_r($_POST);
        $_POST['startTime'] = strtotime($_POST['startTime']);
        $_POST['overTime'] = strtotime($_POST['overTime']);
        $mysql->insert('cardList', $_POST);
        print_r(mysql_error());
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=store&i=cardSetting");
    }
}


//print_r($s);

?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px;}
    div.mian ol li{font-size: 12px; padding-top: 5px; padding-bottom: 10px;}
    div.mian ol li a{font-size: 14px; cursor: pointer;}
    div.mian ol li a:hover{text-decoration: underline;}

    div.mian ol li label{display: inline-block; width: 150px; font-size: 12px; font-weight: bold; color: #000; padding: 5px; vertical-align: top;}
    div.mian ol li input{padding: 5px; font-size: 12px;}
    div.mian ol li textarea{padding: 5px; font-size: 12px; width: 272px; height: 100px;}
    div.mian ol li input.max{width: 272px;}
    div.mian ol li input.check, div.mian ol li label.auto{width: auto;}
    div.mian ol li select.max{width: 284px;}
    div.mian ol li select{padding: 5px;}

    div.mian ol li div{display: inline-block;}
    div.mian ol li div img{width: 270px; height: 152px; margin-bottom: 5px; border-radius: 5px; box-shadow: 0 0 3px RGBA(0, 0, 0, 0.4);}
    div.mian ol li div a.zidingyi{}

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
    <h1>会员卡设置</h1>
    <h2>自定义会员卡一些相关参数</h2>
    <form action="?s=store&i=cardSetting&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">

        <li>
            <label>卡片名称：</label>
            <input type="text" class="max" name="title" value="<?php echo $os['sname']; ?>" />
        </li>

        <li>
            <label>卡片介绍：</label>
            <textarea name="`desc`">获取会员卡后，不仅可以优惠打折，还可以获取商家即时信息！</textarea>
        </li>

        <li>
            <label>卡片数量：</label>
            <input type="text" class="max" name="member" value="100" />
        </li>

        <li>
            <label>背景图片：</label>
            <input type="hidden" name="bg" value="/uploads/card/default.jpg" />
            <div>
                <img src="/uploads/card/default.jpg" />
                <a class="zidingyi">更换</a>
            </div>
        </li>

        <li>
            <label>消费得积分比例：</label>
            消费1元兑换<input type="text" name="integral" value="1" />积分
        </li>

        <li>
            <label>领取卡片开始时间：</label>
            <input type="text" name="startTime" value="" />
        </li>

        <li>
            <label>领取卡片结束时间：</label>
            <input type="text" name="overTime" value="" />
        </li>

        <li>
            <label>会员升级需要条件：</label>
            (N<sup>2</sup> * N + 1) * N * 100
        </li>
        <input type="hidden" name="sid" value="<?php echo $id; ?>" />
        <input type="hidden" name="timer" value="<?php echo time(); ?>" />
        <li><button>创建</button></li>
    </form>
</ol>

<script src="http://open.web.meitu.com/sources/xiuxiu.js" type="text/javascript"></script>
<script type="text/javascript">

    xiuxiu.embedSWF("avatar", 5, 800, 400);

    xiuxiu.onInit = function ()
    {
        // your code here

        xiuxiu.loadPhoto("<?php echo $o['avatar_large']; ?>");
    };

    xiuxiu.setUploadURL("http://ireoo.com/app/xiuxiu/avatar.php?uid=<?php echo $o['id']; ?>");
    //xiuxiu.setUploadArgs({'uid' : '<?php echo $o['id']; ?>'});
    xiuxiu.setUploadType (1);

    xiuxiu.onBeforeUpload = function(data, id) {

        //alert("上传响应" + data);

    };

    xiuxiu.onUploadResponse= function(data,id) {

        alert("上传响应" + data);

    };

    xiuxiu.onDebug = function (data)
    {
        alert("错误响应" + data);
    }
</script>
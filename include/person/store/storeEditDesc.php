<script type="text/javascript" charset="utf-8" src="app/ueditor/config.js"></script>
<script type="text/javascript" charset="utf-8" src="app/ueditor/editor_all.js"></script>
<?php
if(!isset($os) or $os['id'] == '') header("Location: /i?s=store&i=storeAdd");
$id = $os['id'];

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        $_POST['desc'] = strtr($_POST['desc'], array("\\" => ''));
        $r1 = $mysql->update('store', $_POST, "id = $id");
        //print_r($_POST);
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=store&i=storeEdit");
    }
}

$store = new store;
$s = $store->show($mysql, array('condition'=>"id = $id"));
$s = $s[0];

?>
<style type="text/css">
    div.mian ol{margin-bottom: 100px;}
    div.mian ol li{font-size: 12px; padding-top: 5px; padding-bottom: 10px;}
    div.mian ol li a{font-size: 14px; cursor: pointer;}
    div.mian ol li a:hover{text-decoration: underline;}

    div.mian ol li label{display: inline-block; width: 80px; text-align: right; font-size: 12px; color: #666; padding-right: 5px;}
    div.mian ol li input{padding: 3px; font-size: 14px; width: 150px;}
    div.mian ol li input.max{width: 300px;}
    div.mian ol li select{padding: 3px;}
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
<script type="text/javascript">
    $(
        function() {
            var ue = UE.getEditor('editor');

            //显示选择位置
            $('ul.city li').click(function(e) {
                $(this).addClass('hover');
            }).hover(
                function() {},
                function() {
                    $(this).removeClass('hover');
                }
            );

        }
    );
</script>
<ol>
    <h1>详细介绍</h1>
    <h2>全方位的介绍，更容易让别人了解您的企业！</h2>
    <form action="?s=store&i=storeEditDesc&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">

        <textarea id="editor" style="width: 100%;" name="desc"><?php echo $s['desc']; ?></textarea>

        <li><button>保存</button></li>
    </form>
</ol>
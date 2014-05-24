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
        header("Location: /i?s=store&i=storeEditBg");
    }
}

$store = new store;
$s = $store->show($mysql, array('condition'=>"id = $id"));
$s = $s[0];

?>
<style type="text/css">
    /*     ol.account       */
    div.mian ol{padding-bottom: 100px;}

    div.mian ol h1{font-size: 14px; color: #000; border-bottom: 1px #EBEBEB solid; margin-left: 20px; margin-right: 20px; height: 40px; line-height: 40px;}
    div.mian ol h1 span{color: #AAA; font-weight: normal; margin-left: 10px; font-size: 12px;}
    div.mian ol h1 span b{color: #F00;}

    div.mian ol span.h2{margin-bottom: 30px; color: #CCC; font-size: 12px; display: inline-block; margin-left: 20px; margin-right: 20px; height: 40px; line-height: 40px;}

    div.mian ol li{margin-bottom: 15px; padding: 20px;}
    div.mian ol li label{display: inline-block; font-size: 12px; color: #999;}

    div.mian ol li button{padding: 5px 20px;}

    button.upload{background: #090; color: #FFF;}
    button.baocun{background: #EBEBEB;}

    button.upload:hover, button.upload.hover{background: #060;}
    button.baocun:hover, button.baocun.hover{background: #CCC;}

    div.mian ol li div{float:right; width: 350px; height: 350px; position: relative;}

    div.mian ol li span{font-size: 12px; margin-bottom: 20px; display: block;}

    div.mian ol li span.xiangce{padding:5px; padding-left: 0px;}
    div.mian ol li span.xiangce input{float: left; margin-right: 5px; margin-top: 2px;}



    img.avatar{width: 350px;}
    img.avatar_max{width: 180px; height: 180px;}
    img.avatar_min{width: 50px; height: 50px;}
    img.avatar_mmin{width: 30px; height: 30px;}

    ol ul li img{width: 800px; height: 300px;}

    a#cedit{font-size: 12px; color: #999; cursor: pointer; padding-bottom: 3px;}
    a#cedit:hover{border-bottom: 1px #999 dotted;}

    div.windows{position: absolute; top: 150px; left: -1px; display: none; z-index: 9999;}
    div.windows object{border: 1px #CCC solid;}

    button{padding: 5px 20px;}
</style>
<!-- load js -->
<script src="http://open.web.meitu.com/sources/xiuxiu.js" type="text/javascript"></script>
<script type="text/javascript">
    window.onload = function(){

        xiuxiu.setCropPresets("800x300");
        xiuxiu.setLaunchVars ("uploadBtnLabel", "上传到圈网");

        $('#edit').click(function() {
            $('img#show').hide();
            xiuxiu.embedSWF("avatar", 1, 1000, 400);
            xiuxiu.onInit = function ()
            {
                xiuxiu.loadPhoto("http://ireoo.com/<?php echo $s['bg']; ?>");
            };
            $('div.windows').show();
        });

        $('#cedit').click(function() {
            $('img#show').hide();
            xiuxiu.embedSWF("avatar", 1, 1000, 400);
            xiuxiu.onInit = function ()
            {
                xiuxiu.loadPhoto("");
            };
            $('div.windows').show();
        });

        xiuxiu.onClose = function()
        {
            $('#xiuxiuEditor').after('<div id="avatar"></div>').remove();
            $('div.windows').hide();
        };
        xiuxiu.setUploadURL("http://ireoo.com/app/xiuxiu/storeBg.php?sid=<?php echo $id; ?>");
        //xiuxiu.setUploadArgs({'sid' : '<?php echo $id; ?>'});
        xiuxiu.setUploadType (1);
        xiuxiu.onBeforeUpload = function(data, id) {
            //alert("上传响应" + data);
        };
        xiuxiu.onUploadResponse= function(data,id) {
            //alert(data);
            location.reload();
        };
        xiuxiu.onDebug = function (data)
        {
            alert(data);
        };
    }
</script>


<ol class="account">
    <h1>修改背景图片</h1>
    <span class="h2">可以上传自己喜欢的图片,然后对其进行操作.</span>

    <ul>
        <li>
            <img id="show" src="<?php echo $s['bg']; ?>" />
            <div id="avatar"></div>
        </li>
        <li>
            <button id="edit">编辑</button>
            <a id="cedit">重新上传背景图片</a>
        </li>
    </ul>
</ol>
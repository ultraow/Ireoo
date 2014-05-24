<style type="text/css">
	div.mian{height: 600px;}
        /*     ol.account       */
    div.mian ol{padding-bottom: 100px;}

    div.mian ol h1{font-size: 14px; color: #000; border-bottom: 1px #EBEBEB solid; height: 40px; line-height: 40px;}
    div.mian ol h1 span{color: #AAA; font-weight: normal; margin-left: 10px; font-size: 12px;}
    div.mian ol h1 span b{color: #F00;}

    div.mian ol span.h2{margin-bottom: 30px; color: #CCC; font-size: 12px; height: 40px; line-height: 40px; display: block;}

    div.mian ol li{margin-bottom: 15px; padding: 20px;}
    div.mian ol li label{display: inline-block; font-size: 12px; color: #999;}

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
    button{padding: 5px 20px;}

</style>
<!-- load js -->
<script src="http://open.web.meitu.com/sources/xiuxiu.js" type="text/javascript"></script>
<script type="text/javascript">

    xiuxiu.embedSWF("avatar", 5, 800, 400);

    xiuxiu.onInit = function ()
    {
        // your code here
        xiuxiu.loadPhoto("http://ireoo.com/<?php echo $o['avatar']; ?>?<?php echo rand(0, 9999999999999999999); ?>");
    };

    xiuxiu.setUploadURL("http://ireoo.com/app/xiuxiu/avatar.php?uid=<?php echo $o['id']; ?>");
    //xiuxiu.setUploadArgs({'uid' : '<?php echo $o['id']; ?>'});
    xiuxiu.setUploadType (1);

    xiuxiu.onBeforeUpload = function(data, id) {
        //alert("上传响应" + data);
    };

    xiuxiu.onUploadResponse= function(data, id) {
        alert(data);
    };

    xiuxiu.onDebug = function (data)
    {
        alert(data);
    }
</script>


<ol class="account">
    <h1>上传修改头像<!--<span>( <b>*</b>必须填写项 )</span>--></h1>
    <span class="h2">可以上传自己喜欢的图片,然后用鼠标在图片上选择合适的大小.</span>
    <div id="avatar"></div>
</ol>

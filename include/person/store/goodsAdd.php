<?php
//if(!isset($os)) header("Location: /");
//$id = $os['id'];

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        if($mysql->insert('goods', $_POST)) {
            header("Location: /i?s=store&i=goodsAdd");
        }else{
            echo mysql_error();
        }
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=store&i=goodsAdd");
    }
}
?>

<style type="text/css">
    div.mian ol{padding-bottom: 100px;}
    div.mian ol li{padding-top: 5px; padding-bottom: 10px;}

    div.mian ol li label.t{display: inline-block; width: 100px; font-size: 12px; font-weight: bold; color: #000; padding: 5px; vertical-align: top;}
    div.mian ol li input{padding: 5px; font-size: 12px; width: 272px;}
    div.mian ol li label.title{font-size: 12px; margin-right: 10px;}
    div.mian ol li span{color: #999; font-size: 12px;}

    div.mian ol li.imgs button{padding: 5px; font-size: 12px; font-weight: normal; background: #CCC; color: #FFF; margin-right: 1px; margin-bottom: 1px;}
    div.mian ol li.imgs button img{width: 100px; height: 100px;}

    div.mian ol li button.choose{width: 100px; height: 100px;}

    button{padding: 5px 20px;}


</style>

<script type="text/javascript">

    $(
        function() {
            $('button.choose').css({background: '#333'});
            $('button.choose.m').css({background: 'green'});
            $('button.choose').click(
                function() {
                    var txt = $(this);
                    if(txt.text() == '个人') {
                        $('#store').val(0);
                    }
                    if(txt.text() == '商家') {
                        $('#store').val(1);
                    }
                    $('button.choose').css({background: '#333'});
                    txt.css({background: 'green'});
                }
            );

            var sid = <?php echo $os['id']; ?>;
            $('button.upload').click(function() {
                var t = $(this).text('加载中...');
                $.getScript('http://open.web.meitu.com/sources/xiuxiu.js', function() {
                    t.text('选择');
                    var divID = $('<div id="showedit"><div id="photo"></div></div>').appendTo('body').css({position: "fixed", background: "#CCC", padding: '3px'});
                    xiuxiu.setLaunchVars ("nav", "edit");
                    xiuxiu.embedSWF("photo", 1, 800, 400);
                    xiuxiu.onInit = function () {xiuxiu.loadPhoto("");};
                    xiuxiu.setUploadURL("http://ireoo.com/app/xiuxiu/photo.php?id=" + sid + "&text=宝贝图片");
                    var winHeight = $(window).height();
                    var winWidth = $(window).width();
                    var divHeight = divID.height();
                    var divWidth = divID.width();
                    var top = (winHeight - divHeight) / 2;
                    var left = (winWidth - divWidth) / 2;
                    divID.css({ top: top + "px", left: left + "px"});
                    xiuxiu.onClose = function() {divID.remove();};
                    xiuxiu.onBeforeUpload = function(data, id) {};
                    xiuxiu.onUploadResponse= function(data,id) {
                        if(data == -1) {
                            alert('文件不存在，请重新选择');
                            divID.remove();
                        }else if(data == 0) {
                            alert('上传失败，请稍后再试');
                        }else{
                            divID.remove();
                            var imgArea = $('li.imgs');
                            var imgInput = '';
                            //alert(data);
                            var showImg = $('<img />').attr('id', data).attr('src', '/image.' + data + '.100.100.0');
                            var showButton = $('<button />').attr('title', '单击去除，但图片任在我的相册中保存').append(showImg).hover(
                                function() {
                                    $(this).css({background: '#4898F8'});
                                },
                                function() {
                                    $(this).css({background: '#CCC'});
                                }
                            ).click(function() {
                                    $(this).remove();
                                    var imgArea = $('li.imgs');
                                    var imgInput = '';
                                    $.each(imgArea.find('img'), function(i, img) {
                                        if(i>0) {
                                            imgInput += ',' + $(this).attr('id');
                                        }else{
                                            imgInput += $(this).attr('id');
                                        }
                                    });
                                    $('input#imgs').val(imgInput);
                                });
                            imgArea.append(showButton);
                            $.each(imgArea.find('img'), function(i, img) {
                                if(i>0) {
                                    imgInput += ',' + $(this).attr('id');
                                }else{
                                    imgInput += $(this).attr('id');
                                }
                            });
                            $('input#imgs').val(imgInput);
                        }
                    };
                    xiuxiu.onDebug = function (data) {};
                });
                return false;
            });

        }
    );

</script>

<ol class="account">

    <form action="?s=store&i=goodsAdd&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">
        <h1>分类选择</h1>
        <span class="h2">为了您的产品更好的销售，请选择合适的产品分类。</span>

        <li>
            <label class="t">产品分类：</label>
            <select name="type">
                <?php foreach($goodsList as $k => $v) { ?>
                <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                <?php } ?>
            </select>
        </li>

        <h1>基本资料</h1>
        <span class="h2">以下信息将显示在宝贝页面，方便大家了解你。</span>

        <li>
            <label class="t">标题：</label>
            <input type="text" name="title" value="" />
        </li>

        <li>
            <label class="t">原价：</label>
            <input type="text" name="money" value="" />
            <span>市场价</span>
        </li>

        <li>
            <label class="t">现价：</label>
            <input type="text" name="rebate" value="" />
            <span>必须低于市场价格，否则无法显示</span>
        </li>

        <li>
            <label class="t">佣金：</label>
            <input type="text" name="brokerage" value="1.00" />
            <span>用户宣传获得的佣金，默认1元。</span>
        </li>

        <li>
            <label class="t">数量：</label>
            <input type="text" name="top" value="0" />
        </li>

        <h1>宝贝图片</h1>
        <span class="h2">添加宝贝图片，至少添加一张照片！</span>

        <li>
            <input type="hidden" name="img" id="imgs" />
            <button class="upload">选择</button>
        </li>

        <li class="imgs">

        </li>

        <h1>详细信息</h1>
        <span class="h2">以下信息将显示在宝贝页面，方便大家了解你。</span>
        <li>
            <textarea id="editor" style="width: 100%;" name="synopsis"></textarea>
        </li>

        <input type="hidden" name="uid" value="<?php echo $o['id']; ?>" />
        <input type="hidden" name="sid" value="<?php echo $os['id']; ?>" />

        <li class="bu">
            <button>保存</button>
            <span class="result"></span>
        </li>
    </form>
</ol>
<script type="text/javascript" charset="utf-8" src="app/ueditor/config.js"></script>
<script type="text/javascript" charset="utf-8" src="app/ueditor/editor_all.js"></script>
<script type="text/javascript" src="/app/timepicker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="/app/timepicker/datepicker.css" />
<script type="text/javascript">
    var ue = UE.getEditor('editor');
    $(
        function() {
            $('.timer').datepicker();
        }
    );
</script>
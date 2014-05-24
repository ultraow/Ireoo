<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 13-12-18
 * Time: 下午12:03
 */
if(!isset($os) or $os['id'] == '') header("Location: /i?s=store&i=storeAdd");
$id = $os['id'];

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        $mysql->update('store3G', $_POST, "sid = $id");
        //print_r($_POST);
        //print_r(mysql_error());
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=store&i=storeEdit3GTem");
    }
}

$store = new store(array('id'=>$os['id']));
$s = $store->show3G($mysql);

if(!is_array($s)) {
    $s = array(
        'sid' => $os['id'],
        'imgt' => 0,
        'imgs' => implode(",", array('/uploads/background/default.jpg','/uploads/background/default1.jpg','/uploads/background/default2.jpg','/uploads/background/default3.jpg','/uploads/background/default4.jpg','/uploads/background/default5.jpg','/uploads/background/default6.jpg'))
    );
    $mysql->insert('store3G', $s);
    //print_r($s . mysql_error());
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
    div.mian ol li select.max{width: 284px;}
    div.mian ol li select{padding: 5px;}
    div.mian ol li.imgs button{padding: 5px; font-size: 12px; font-weight: normal; background: #CCC; color: #FFF; margin-right: 1px; margin-bottom: 1px;}
    div.mian ol li.imgs button img{width: 100px;}
    div.mian ol li.sub button{padding: 5px 20px;}

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
    $(function() {

        $('li.imgs button').hover(
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
                        imgInput += ',' + $(this).attr('src');
                    }else{
                        imgInput += $(this).attr('src');
                    }
                });
                $('input#imgs').val(imgInput);
            });

        var sid = <?php echo $os['id']; ?>;
        $('button.upload').click(function() {
            var t = $(this).text('加载中...');
            $.getScript('http://open.web.meitu.com/sources/xiuxiu.js', function() {
                t.text('上传背景');
                var divID = $('<div id="showedit"><div id="photo"></div></div>').appendTo('body').css({position: "fixed", background: "#CCC", padding: '3px'});
                xiuxiu.setLaunchVars ("nav", "edit");
                xiuxiu.embedSWF("photo", 1, 800, 400);
                xiuxiu.onInit = function ()
                {
                    xiuxiu.loadPhoto("");
                };
                xiuxiu.setUploadURL("http://ireoo.com/app/xiuxiu/photo.php?id=" + sid + "&text=企业首页浏览背景设置");
                var winHeight = $(window).height();
                var winWidth = $(window).width();
                var divHeight = divID.height();
                var divWidth = divID.width();
                var top = (winHeight - divHeight) / 2;
                var left = (winWidth - divWidth) / 2;
                divID.css({ top: top + "px", left: left + "px"});
                xiuxiu.onClose = function()
                {
                    divID.remove();
                };
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
                        var showImg = $('<img />').attr('src', data);
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
                                        imgInput += ',' + $(this).attr('src');
                                    }else{
                                        imgInput += $(this).attr('src');
                                    }
                                });
                                $('input#imgs').val(imgInput);
                            });
                        imgArea.append(showButton);
                        $.each(imgArea.find('img'), function(i, img) {
                            if(i>0) {
                                imgInput += ',' + $(this).attr('src');
                            }else{
                                imgInput += $(this).attr('src');
                            }
                        });
                        $('input#imgs').val(imgInput);
                    }
                };
                xiuxiu.onDebug = function (data)
                {
                    //alert(data);
                };
            });
            return false;
        });
    });
</script>

<ol>
    <h1>3G网站开场页面</h1>
    <h2>我们会记录你的每一次编辑/修改，见证你的圈圈成长！</h2>
    <form action="?s=store&i=storeEdit3GTem&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">
        <li>
            <label>幻灯片样式：</label>
            <input type="text" class="max" name="imgt" value="<?php echo $s['imgt']; ?>" />
        </li>

        <li>
            <label>图片：</label>
            <input id="imgs" type="hidden" class="max" name="imgs" value='<?php echo $s['imgs']; ?>' />
            <button type="button" class="upload">上传背景</button>
        </li>

        <li class="imgs">
            <?php
            $imgs = explode(',', $s['imgs']);
            //print_r($imgs);
            if(count($imgs) == 1 and $imgs[0] == '') {}else{
                foreach($imgs as $k => $v) {
                    echo "<button><img src='{$v}' /></button>";
                }
            }
            ?>
        </li>

        <li>
            <label>背景音乐地址：</label>
            <input type="text" class="max" name="music" value='<?php echo $s['music']; ?>' />
        </li>

        <li><button>保存</button></li>
    </form>
</ol>
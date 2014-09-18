<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("PRC");
session_start();
include_once("lib/mysql.class.php");
include_once("lib/user.class.php");
include_once("lib/store.class.php");
include_once("lib/goods.class.php");
include_once("include/php/php.php");

include_once("lib/runtime.class.php");

$mysql = new mysql;
$store = new store();
?>
<?php //if(!is_array($o)) { ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo HOST_NAME; ?></title>
    <meta name="keywords" content="<?php echo KEYWORDS; ?>" />
    <meta name="description" content="<?php echo DESCRIPTION; ?>" />
    <link href="include/css/head.css" rel="stylesheet" type="text/css">
    <link href="include/css/index.css" rel="stylesheet" type="text/css">
    <link href="include/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="include/css/foot.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include_once("include/php/head.php"); ?>

<div class="indextop">

    <h1>琦益<span>企业产品直销平台</span></h1>

</div>

<ul class="m">
    <li><a class="b" href="#">购物指南</a></li>
    <li><a class="b" href="#">企业服务</a></li>
</ul>

<div class="show">

    <div class="mian">

        <div class="right">

            <ul>
                <li class="login">

                    <h1>欢迎来琦益</h1>
                    <span>您还没有登录呦</span>
                    <a style="margin-right: 10px;" href="/login">登录</a>
                    <a href="/reg">注册</a>
                    <br class="clear" />
                </li>

                <li class="qr">
                    <img src="include/images/qrcode.png" />
                    扫描二维码关注微信公众帐号<br />
                    <span>动动手指，就可赚钱</span>
                </li>

                <li class="join">
                    <h1>琦益网状况</h1>
                    <span>收入企业总量：<b><?php echo $system['store']; ?></b></span>
                    <span>收入产品总量：<b><?php echo $system['goods']; ?></b></span>
                    <span>数据还在持续增加中...</span>
                    <span>每天凌晨更新数据</span>
                </li>

                <li class="tk">
                    <script type="text/javascript"> (function(win,doc){ var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0]; if (!win.alimamatk_show) { s.charset = "gbk"; s.async = true; s.src = "http://a.alimama.cn/tkapi.js"; h.insertBefore(s, h.firstChild); }; var o = { pid: "mm_27201356_3489904_23078787",/*推广单元ID，用于区分不同的推广渠道*/ appkey: "",/*通过TOP平台申请的appkey，设置后引导成交会关联appkey*/ unid: ""/*自定义统计字段*/ }; win.alimamatk_onload = win.alimamatk_onload || []; win.alimamatk_onload.push(o); })(window,document);</script>
                    <a data-type="5" data-tmpl="198x200" data-tmplid="135" data-style="2" data-border="1" href="#">淘宝充值</a>
                </li>

                <li class="tk">
                    <script> var dsaid=40076; var dwidth=200; var dheight=200; </script> <script type="text/javascript" src="http://unionjs.dianxin.com/showPic.js" name="showpic" charset="utf-8" ></script>
                </li>

                <li>
                    <script type="text/javascript" >BAIDU_CLB_SLOT_ID = "930970";</script>
                    <script type="text/javascript" src="http://cbjs.baidu.com/js/o.js"></script>
                </li>
            </ul>

        </div>

        <div class="left">

            <div class="index">
                <ul class="caidan">
                    <h1>企业及产品行业分类</h1>
                    <?php
                    $s = array(
                        'table' => 'form',
                        'order' => 'xian asc'
                    );
                    $f = $mysql->select($s);
                    //print_r($f);
                    foreach($f as $key => $value) {
                        $v = $value['form'];
                        ?>
                        <li>
                            <a target="_blank" href="/store?span=<?php echo $v['id']; ?>"><?php echo $v['value']; ?><span><?php echo $v['count']; ?></span></a>
                        </li>
                    <?php }?>
                </ul>
                <div class="fox">
                    <ul class="img">
                        <li><a target="_blank" href="http://ai.taobao.com?pid=mm_27201356_3489904_23068843"><img src="uploads/index/g1.jpg" /></a></li>
                        <li><a target="_blank" href="http://ai.taobao.com?pid=mm_27201356_3489904_23068843"><img src="uploads/index/g2.jpg" /></a></li>
                        <li><a target="_blank" href="http://ai.taobao.com?pid=mm_27201356_3489904_23068843"><img src="uploads/index/g3.jpg" /></a></li>
                        <li><a target="_blank" href="http://ai.taobao.com?pid=mm_27201356_3489904_23068843"><img src="uploads/index/g4.jpg" /></a></li>
                        <li><a target="_blank" href="http://ai.taobao.com?pid=mm_27201356_3489904_23068843"><img src="uploads/index/g5.jpg" /></a></li>
                    </ul>

                    <div class="top">
                        <ul>
                            <li>
                                <a target="_blank" href="/search.html?k=女装">
                                    <img src="/include/images/index/type/1.jpg" />
                                    <div>女装</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=女内">
                                    <img src="/include/images/index/type/2.jpg" />
                                    <div>女内</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=男装">
                                    <img src="/include/images/index/type/3.jpg" />
                                    <div>男装</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=男内">
                                    <img src="/include/images/index/type/4.jpg" />
                                    <div>男内</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=男鞋">
                                    <img src="/include/images/index/type/5.jpg" />
                                    <div>男鞋</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=女鞋">
                                    <img src="/include/images/index/type/6.jpg" />
                                    <div>女鞋</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=箱包">
                                    <img src="/include/images/index/type/7.jpg" />
                                    <div>箱包</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=手机">
                                    <img src="/include/images/index/type/8.jpg" />
                                    <div>手机</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=电脑">
                                    <img src="/include/images/index/type/9.jpg" />
                                    <div>电脑</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=数码">
                                    <img src="/include/images/index/type/10.jpg" />
                                    <div>数码</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=护肤">
                                    <img src="/include/images/index/type/11.jpg" />
                                    <div>护肤</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=洁净">
                                    <img src="/include/images/index/type/12.jpg" />
                                    <div>洁净</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=户外">
                                    <img src="/include/images/index/type/13.jpg" />
                                    <div>户外</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=家装">
                                    <img src="/include/images/index/type/14.jpg" />
                                    <div>家装</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=母婴">
                                    <img src="/include/images/index/type/15.jpg" />
                                    <div>母婴</div>
                                </a>

                            </li>
                            <li>
                                <a target="_blank" href="/search.html?k=美食">
                                    <img src="/include/images/index/type/16.jpg" />
                                    <div>美食</div>
                                </a>

                            </li>

                            <br class="clear" />
                        </ul>
                    </div>

                    <div class="update">
                        <h1>最新更新的企业</h1>
                        <ul>
                            <li>
                                <a target="_blank" href="/100314156">
                                    <img src="uploads/u/storeAvatar.jpg" />
                                </a>
                                <h1>伊宁市飞机场路孙梅汽车租赁店</h1>
                                <span>伊宁市飞机场路二巷66号</span>


                            </li>
                            <li>
                                <a target="_blank" href="/100314155">
                                    <img src="uploads/u/storeAvatar.jpg" />
                                </a>
                                <h1>新源那拉提机场</h1>
                                <span>近郊伊犁哈萨克自治区新源县</span>


                            </li>
                            <li>
                                <a target="_blank" href="/100314154">
                                    <img src="uploads/u/storeAvatar.jpg" />
                                </a>
                                <h1>伊宁机场1号候机楼</h1>
                                <span>飞机场路273</span>


                            </li>
                            <li>
                                <a target="_blank" href="/100314153">
                                    <img src="uploads/u/storeAvatar.jpg" />
                                </a>
                                <h1>飞机场路/G218(路口)</h1>
                                <span>新疆维吾尔自治区伊犁哈萨克自治州伊宁市</span>


                            </li>
                            <br class="clear" />
                        </ul>
                    </div>

                    <div class="hezuo">
                        <h1>合作伙伴</h1>
                        <ul>
                            <li><img src="" /></li>
                            <li><img src="" /></li>
                            <li><img src="" /></li>
                            <li><img src="" /></li>
                        </ul>
                    </div>


                </div>
                <br class="clear" />
            </div>





        </div>

        <br class="clear" />

    </div>




</div>


<?php include_once("include/php/foot.php"); ?>
</body>
</html>


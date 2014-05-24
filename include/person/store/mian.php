<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 13-12-18
 * Time: 下午12:03
 */

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        $_POST['desc'] = strtr($_POST['desc'], array("\\" => ''));
        $r1 = $mysql->update('store', $_POST, "id = $id");
        //print_r($_POST);
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?i=storeEdit&id=$id");
    }
}

$store = new store(array('id'=>$os['id']));
$this3G = $store->show3G($mysql);
?>
<style type="text/css">
    div.mian{background: url("/include/images/3gTemBackground.png");}
    div.mian ol{padding-bottom: 100px; background: url("/include/images/3gTemBackground.png");}
    div.mian ol div.one{float: left; padding: 10px 0; width: 50%; min-width: 350px;}
    div.mian ol div.one.phoneBackground div.phone{width: 320px; height: 589px; margin: auto; border: 1px #000 solid; box-shadow: 0 0 5px RGBA(0, 0, 0, 0.8); overflow: hidden;}
    div.mian ol div.one.phoneBackground div.phone h1{font-size: 12px; height: 20px; line-height: 20px; padding: 0; margin: 0; background: #CCC; padding-left: 5px;}
    div.mian ol div.one.phoneBackground div.phone div.phoneMian{width: 320px; height: 569px; padding: 0; margin: 0; background: #FFF;}
    div.mian ol div.one.phoneBackground div.phone div.phoneMian div.top{position: relative; padding: 0;}
    div.mian ol div.one.phoneBackground div.phone div.phoneMian div.top img{width: 100%;}
    div.mian ol div.one.phoneBackground div.phone div.phoneMian div.top h2{font-size: 16px; text-align: center; padding: 0; margin: 0; background: none; position: absolute; top: 22px; left: 0; width: 100%; color: #FFF;}

    div.mian ol div.one div.choose{width: 300px; border: 1px #000 solid; box-shadow: 0 0 5px RGBA(0, 0, 0, 0.8); overflow: hidden; margin-bottom: 20px; margin-left: 20px; float: right;}
    div.mian ol div.one div.choose h1{font-size: 12px; height: 20px; line-height: 20px; padding: 0; margin: 0; background: #CCC; padding-left: 5px;}
    div.mian ol div.one div.choose div.chooseMian{width: 300px; background: #FFF;}


    div.chooseMian a.button{padding: 10px; border: none; display: block; border-top: 1px #CCC dotted; width: 100%; color: #333;}
    div.chooseMian a.button.first{border: none;}
    div.chooseMian a.button:hover{background: #EBEBEB;}

    div.mian ol div.one div.choose.caidan{width: 100px;}

</style>

<ol>
    <div class="one phoneBackground">
        <div class="phone">
            <h1>手机模拟器</h1>
            <div class="phoneMian">
                <div class="top">
                    <img src="/include/images/phoneTopBackground.png" />
                    <h2>手机模拟器</h2>
                </div>
                <iframe style="width: 320px; height: 505px; border: none;" src="/3G<?php echo $os['id']; ?>index"></iframe>
            </div>
        </div>
    </div>

    <div class="one">

        <div class="choose caidan">
            <h1>菜单</h1>
            <div class="chooseMian">
                <a class="button first" rel="1">幻灯片</a>
                <a class="button" rel="2">分类菜单</a>
                <a class="button" rel="5">背景音乐</a>
                <a class="button" rel="7">漂浮效果</a>
            </div>
        </div>

        <div class="choose">
            <h1>幻灯片</h1>
            <div class="chooseMian">
                <form action="?s=store&i=storeEdit3GTem&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">
                    <select name="imageType">
                        <option selected value="0">全屏</option>
                    </select>
                    <input name="images" type="text" value="" />
                    <button>保存</button>
                </form>
            </div>
        </div>

    </div>
</ol>
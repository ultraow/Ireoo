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
        header("Location: /i?s=store&i=wcMember");
    }
}

$store = new store;
$s = $store->show($mysql, array('condition'=>"id = $id"));
$s = $s[0];

define("TOKEN", $s['TOKEN']);

?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px; min-width: 900px;}
    div.mian ol table{border-collapse: collapse; width: 100%;}
    div.mian ol table tr{margin-bottom: 10px;}
    div.mian ol table tr td{border: 1px #CCC solid; padding: 5px; font-size: 12px;}
    div.mian ol table thead tr td{background: #4898F8; color: #FFF; border-color: #4898F8;}
    div.mian ol table tr td.first{background: none; border: none; width: 40px; padding: 0;}
    div.mian ol table tr td.foot{background: none; border: none; width: 215px;}
    div.mian ol table tbody tr td a{padding: 3px; background: #4898F8; color: #FFF; cursor: pointer;}
    div.mian ol table tbody tr td img.headimg{width: 30px; height: 30px;}

    button{padding: 5px 20px;}
</style>

<ol>
    <h1>会员管理</h1>
    <h2>查看管理关注我们的用户，在此页面，你可以查看到用户的很多相关资料，方便你们管理你的企业或实体店！</h2>

    <table>
        <thead>
        <tr>
            <td class="first"></td>
            <td>OPENID</td>
            <td>绑定用户</td>
            <td>昵称</td>
            <td>性别</td>
            <td>地址</td>
            <td>语言</td>
            <td>状态</td>
            <td>关注时间</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = array(
            'table' => 'wechat',
            'condition' => "wid = '" . $os['wechatId'] . "'"
        );
        $re = $mysql->select($sql);
        //print_r($re);
        foreach($re as $key => $value) {
            ?>
            <tr>
                <td class="first"><img class="headimg" src="<?php echo $value['wechat']['headimgurl']; ?>" /></td>
                <td><?php echo $value['wechat']['openid']; ?></td>
                <td><?php if($value['wechat']['uid'] == 0) {echo '还未绑定本站用户';}else{echo $value['wechat']['uid'];} ?></td>
                <td class="nickname"><?php echo $value['wechat']['nickname']; ?></td>
                <td class="sex"><?php if($value['wechat']['sex'] == 1) {echo '男';}else{ echo '女';} ?></td>
                <td class="city"><?php echo $value['wechat']['country']; ?> - <?php echo $value['wechat']['province']; ?> - <?php echo $value['wechat']['city']; ?></td>
                <td class="language"><?php echo $value['wechat']['language']; ?></td>
                <td class="follow"><?php if($value['wechat']['subscribe'] == 1) {echo '已关注';}else{ echo '未关注';} ?></td>
                <td class="time"><?php echo DATE('Y/m/d', $value['wechat']['subscribe_time']); ?></td>
                <td>
                    <a class="sendMessage" openId="<?php echo $value['wechat']['openid']; ?>" wechatId="<?php echo $s['wechatId']; ?>">信息</a>
                    <a class="getUsername" openId="<?php echo $value['wechat']['openid']; ?>">获取</a>
                    <a class="getHistory" openId="<?php echo $value['wechat']['openid']; ?>">历史信息</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

</ol>
<script type="text/javascript" src="/app/weixin/js/sendMessage.js"></script>
<script type="text/javascript">
    $(function() {
        $('.getUsername').click(function() {
            var id = $(this).attr('openId');
            var div = $(this).parent().parent();
            $.getJSON('app/weixin/include/getUsername.php?id=' + id, function(re) {
                //alert(re);
                div.find('img').attr('src', re.headimgurl);
                div.find('.nickname').text(re.nickname);
                if(re.sex == 1) {
                    div.find('.sex').text('男');
                }else{
                    div.find('.sex').text('女');
                }
                div.find('.city').text(re.country + ' - ' + re.province + ' - ' + re.city);
                div.find('.language').text(re.language);
                if(re.subscribe == 1) {
                    div.find('.follow').text('已关注');
                }else{
                    div.find('.follow').text('未关注');
                }

                div.find('.time').text(timetodate(re.subscribe_time, "yyyy/MM/dd"));
            });
        });

        $('.sendMessage').click(function() {
            sendMessage($(this).attr('openId'));
        });

        $('.getCard').click(function() {
            var id = $(this).attr('openId');
            var token = $(this).attr('TOKEN');
            var div = $(this).parent().parent();
            $.getJSON('include/php/getCard.php?id=' + id + '&token=' + token, function(re) {
                if(re.success) {
                    alert('发卡成功!');
                    div.find('.card').text(re.card);
                }else{
                    alert(re.error);
                }

            });
        });

        $('.getHistory').click(function() {
            var id = $(this).attr('openId');
            var div = $(this).parent().parent();
            $.getJSON('app/weixin/include/getCard.php?id=' + id, function(re) {

            });
        });
    });

    /**
     *
     *    给date函数追加自定义属性
     *
     */

    Date.prototype.pattern = function(fmt) {
        var o = {
            "M+" : this.getMonth()+1, //月份
            "d+" : this.getDate(), //日
            "h+" : this.getHours() == 0 ? 12 : this.getHours(), //小时
            "H+" : this.getHours(), //小时
            "m+" : this.getMinutes(), //分
            "s+" : this.getSeconds(), //秒
            "q+" : Math.floor((this.getMonth()+3)/3), //季度
            "S" : this.getMilliseconds() //毫秒
        };

        var week = {
            "0" : "\u65e5",
            "1" : "\u4e00",
            "2" : "\u4e8c",
            "3" : "\u4e09",
            "4" : "\u56db",
            "5" : "\u4e94",
            "6" : "\u516d"
        };

        if(/(y+)/.test(fmt)){
            fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
        }

        if(/(E+)/.test(fmt)){
            fmt=fmt.replace(RegExp.$1, ((RegExp.$1.length>1) ? (RegExp.$1.length>2 ? "\u661f\u671f" : "\u5468") : "")+week[this.getDay()+""]);
        }

        for(var k in o){
            if(new RegExp("("+ k +")").test(fmt)){
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
            }
        }
        return fmt;
    };
    function  timetodate(tim,dat){
        return  new Date(parseInt(tim)*1000).pattern(dat);   //"yyyy/MM/dd,hh,mm,ss"
    }
</script>
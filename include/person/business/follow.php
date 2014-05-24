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
        header("Location: /i?s=store&i=storeFollow");
    }
}

$store = new store;
$s = $store->show($mysql, array('condition'=>"id = $id"));
$s = $s[0];

?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px;}
    div.mian ol table{border-collapse: collapse; width: 100%;}
    div.mian ol table tr{margin-bottom: 10px;}
    div.mian ol table tr td{border: 1px #CCC solid; padding: 5px; font-size: 12px;}
    div.mian ol table thead tr td{background: #4898F8; color: #FFF; border-color: #4898F8;}
    div.mian ol table tr td.first{background: none; border: none; width: 40px; padding: 0;}
    div.mian ol table tr td.foot{background: none; border: none; width: 215px;}
    div.mian ol table tbody tr td a{padding: 3px; background: #4898F8; color: #FFF; cursor: pointer;}
    div.mian ol table tbody tr td img.headimg{width: 30px; height: 30px;}

    div.mian ol table tbody tr td span.red{color: red;}

    button{padding: 5px 20px;}
</style>

<ol>
    <h1>用户管理</h1>
    <h2>查看管理关注我们的用户，在此页面，你可以查看到用户的很多相关资料，方便你们管理你的企业或实体店！</h2>

    <table>
        <thead>
        <tr>
            <td>用户</td>
            <td>余额</td>
            <td>等级(积分)</td>
            <td>联系电话</td>
            <td>生日</td>
            <td>地址</td>
            <td>微信</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
        <?php
        include_once(ROOT . "/lib/card.class.php");
        $sql = array(
            'table' => 'follow',
            'condition' => "sid = '" . $id . "'"
        );
        $re = $mysql->select($sql);
        //print_r($s);
        foreach($re as $key => $value) {
            $user = new user();
            $u = $user->getID($mysql, $value['follow']['uid']);

            $ws = array(
                'table' => 'userToWechat',
                'condition' => "wid = '" . $s['wechatId'] . "' and uid = " . $u['id']
            );
            $wechat = $mysql->row($ws);
            //print_r($u);
            $level = level($u['integral']);
            ?>
            <tr>
                <td><?php echo $u['username']; ?></td>
                <td><?php echo $u['money']; ?></td>
                <td><?php echo $level; ?>(<?php echo $u['integral']; ?>/<?php echo (($level + 1) * ($level + 1) + 1) * ($level + 1) * 100; ?>)</td>
                <td><?php echo $u['phone']; ?></td>
                <td><?php echo $u['year']; ?> - <?php echo $u['mouth']; ?> - <?php echo $u['day']; ?></td>
                <td><?php echo $u['city']; ?></td>
                <td><?php if(!is_array($wechat)) {echo '<span class="red">未绑定</span>';}else{echo $wechat['openid'];} ?></td>
                <td>
                    <a class="stopCard" cardId="<?php echo $value['card']['card']; ?>">禁止使用</a>
                    <a class="pay" cardId="<?php echo $value['card']['card']; ?>">充值</a>
                    <a class="getHistory" cardId="<?php echo $value['card']['card']; ?>">消费记录</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

</ol>

<script type="text/javascript">
    $(function() {

        $('.pay').click(function() {
            var card = $(this).attr('cardId');
            var div = $(this).parent().parent();

            var show = $('<div />').css({position: 'absolute', top: '200px', left: '300px', border: '5px #CCC solid', width: '200px', padding: '0 0 3px 0'}).appendTo($('body'));
            var title = $('<h1 />').text('充值金额').css({fontSize: '12px', background: '#CCC', padding: '0 0 5px 0'}).appendTo(show);
            var input = $('<input />').css({margin: '3px', width: '184px', padding: '5px', fontSize: '30'}).appendTo(show);
            var button = $('<button />').text('充值').css({fontSize: '12px', marginLeft: '3px'}).appendTo(show);
            var rebt = $('<button />').text('取消').css({fontSize: '12px', marginLeft: '3px'}).appendTo(show);


        });

        $('.startCard').click(function() {
            var card = $(this).attr('cardId');
            var div = $(this).parent().parent();
            $.getJSON('include/php/startCard.php?card=' + card, function(re) {
                if(re.success) {
                    alert('发卡成功!');
                    div.find('.foot').find('.startCard').removeClass('startCard').addClass('stopCard').text('禁止使用');
                }else{
                    alert(re.error);
                }

            });
        });

        $('.stopCard').click(function() {
            var card = $(this).attr('cardId');
            var div = $(this).parent().parent();
            $.getJSON('include/php/stopCard.php?card=' + card, function(re) {
                if(re.success) {
                    alert('卡片已被禁止使用!');
                    div.find('.foot').find('.stopCard').removeClass('stopCard').addClass('startCard').text('允许使用');
                }else{
                    alert(re.error);
                }
            });
        });

        $('.getHistory').click(function() {
            var uid = $(this).attr('userId');
            var sid = $(this).attr('storeId');
            var div = $(this).parent().parent();
        });
    });

</script>
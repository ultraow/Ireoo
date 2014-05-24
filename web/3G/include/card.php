<style type="text/css">
    /*    index    */
    div.index{background: #FFF; margin-bottom: 30px;}/*float: left; width: 560px; */

    ul.card{margin-top: 30px; border-top: 1px #EBEBEB solid;}
    ul.card h1{padding-top: 30px; font-size: 1.2em; border-bottom: 1px #EBEBEB solid; padding-left: 20px; padding-bottom: 10px;}
    ul.card li{font-size: 1em; border-bottom: 1px #EBEBEB solid; padding: 10px 20px;}
    ul.card li em{font-style: normal; color: #CCC;}
    ul.card li span.red{color: red;}

    button.getCard, button.pay{width: 90%; border-radius: 20px; padding-top: 10px; padding-bottom: 10px; background: green; margin-top: 30px; margin-left: 5%; font-size: 1em; border: none; color: #FFF;}
    button.getCard:hover, button.pay:hover{background: #00c000;}

</style>
<?php require_once('../../lib/timer.class.php'); ?>

<div class="index">

    <link href="/include/css/card.css" rel="stylesheet" type="text/css">

    <?php
    $s = array(
        'table' => 'card',
        'condition' => 'sid = ' . $this_store['id'] . ' and uid = ' . $o['id']
    );
    $c = $mysql->row($s);
    if(!isset($c['card'])) {
        $gs = array(
            'table' => 'cardList',
            'condition' => 'sid = ' . $this_store['id']
        );
        $gr = $mysql->select($gs);
        foreach($gr as $key => $value) {
            $v = $value['cardList'];
            ?>
            <div class="card">
                <img src="<?php echo $v['bg']; ?>" />
                <span class="title"><?php echo $gr['title']; ?></span>
                <h1>No.20140101*******1</h1>
                <em>Ireoo.com</em>
            </div>
            <ul class="card">
                <li>已被领取：<span><?php echo $v['used']; ?></span> 张</li>
                <li>剩余卡片：<span><?php echo $v['member'] - $v['used']; ?></span> 张</li>

                <h1>卡片说明：</h1>
                <li><?php echo $v['desc']; ?></li>

                <button class="getCard" userId="<?php if(isset($o)) {echo $o['id'];} ?>" storeId="<?php echo $this_store['id']; ?>" listId="<?php echo $v['id']; ?>">领取卡片</button>
            </ul>
        <?php
        }
    }else{
        include_once("../../lib/card.class.php");
        $level = level($c['integral']);
        $lid = $c['lid'];

        $gs = array(
            'table' => 'cardList',
            'condition' => 'id = ' . $lid
        );
        $gr = $mysql->row($gs);
        ?>
        <div class="card">
            <img src="<?php echo $gr['bg']; ?>" />
            <span class="title"><?php echo $gr['title']; ?></span>
            <h1>No.<?php echo $c['card']; ?></h1>
            <em>Ireoo.com</em>
        </div>
        <ul class="card">
            <li>当前余额：<span class="red"><?php echo $c['money']; ?></span> 元</li>
            <li>当前积分：<span class="red"><?php echo $c['integral']; ?></span></li>
            <li>会员等级：<span class="red"><?php echo $level; ?></span></li>

            <h1>升级说明：</h1>
            <li>升级还需 <span class="red"><?php echo (($level + 1) * ($level + 1) + 1) * ($level + 1) * 100 - $c['integral']; ?></span> 积分</li>

            <h1>卡片说明：</h1>
            <li><?php echo $gr['desc']; ?></li>

            <button class="pay">充值</button>
        </ul>
    <?php
    }
    ?>

</div>

<script type="text/javascript">
    $(function() {
        $('button.getCard').click(function() {


            var uid = $(this).attr('userId');
            var sid = $(this).attr('storeId');
            var lid = $(this).attr('listId');

            if(uid == '') {
                alert('请登录后再领取！');
                location.href = '/3Glogin?url=/3G' + sid + '?i=card';
            }else{
                $.getJSON('include/php/getCard.php?uid=' + uid + '&sid=' + sid + '&lid=' + lid, function(re) {
                    if(re.success) {
                        alert('发卡成功!');
                        location.reload();
                    }else{
                        alert(re.error);
                    }

                });
            }
        });
    });

</script>
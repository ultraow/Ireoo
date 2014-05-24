<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-2-17
 * Time: 上午10:20
 */
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
    <h1>微信信息</h1>
    <h2>全部微信信息管理！</h2>

    <table>
        <thead>
        <tr>
            <td>用户名</td>
            <td>商家</td>
            <td>信息类型</td>
            <td style="word-break: break-all; word-wrap: break-word;">信息标识</td>
            <td>信息</td>
            <td>发送时间</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = array(
            'table' => 'wechatTalk',
            'condition' => "wid != '' and openid != ''",
            'order' => 'timer desc',
            'limit' => 'LIMIT 0, 30'
        );
        $re = $mysql->select($sql);
        //print_r($s);
        foreach($re as $key => $value) {
            $v = $value['wechatTalk'];
            ?>
            <tr>
                <td><?php echo $v['wid']; ?></td>
                <td><?php echo $v['openid']; ?></td>
                <td><?php echo $v['msgtype']; ?></td>
                <td><?php echo $v['event']; ?></td>
                <td style="word-break: break-all; word-wrap: break-word;"><?php echo $v['array']; ?></td>
                <td><?php echo DATE('Y/m/d H:i:s', $v['timer']); ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

</ol>
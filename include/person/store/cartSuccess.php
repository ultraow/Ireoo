<?php
/**
 * Created by PhpStorm.
 * User: Ultra
 * Date: 14-5-16
 * Time: 下午1:05
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-5-15
 * Time: 下午8:35
 */

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        $id = $_GET['id'];
        $mysql->update('cart', $_POST, "id = $id");
        //print_r($_POST);
        //print_r(mysql_error());
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=store&i=cart");
    }
}
?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px; min-width: 900px;}
    div.mian ol table{border-collapse: collapse; width: 100%; background: #FFF;}
    div.mian ol table tr.on{background: #b3d2ff;}
    div.mian ol table tr{margin-bottom: 10px;}
    div.mian ol table tr td{border: 1px #CCC solid; padding: 5px; font-size: 12px;}
    div.mian ol table thead tr td{background: #4898F8; color: #FFF; border-color: #4898F8;}
    div.mian ol table tr td.first{background: none; border: none; width: 40px; padding: 0;}
    div.mian ol table tr td.foot{background: none; border: none; width: 215px;}
    div.mian ol table tbody tr td a{padding: 3px; background: #4898F8; color: #FFF; cursor: pointer;}
    div.mian ol table tbody tr td a:hover{background: #61b2f8;}

    div.mian ol table tbody tr td img.headimg{width: 30px; height: 30px;}
    div.mian ol table tbody tr td button{font-size: 12px; margin-left: 10px; padding: 3px 5px;}

    div.mian ol li{font-size: 12px; padding-top: 5px; padding-bottom: 10px;}
    div.mian ol li label{display: inline-block; width: 100px; font-size: 12px; font-weight: bold; color: #000; padding: 5px; vertical-align: top;}
    div.mian ol li input{padding: 5px; font-size: 12px; width: 272px;}
    div.mian ol li input.readonly, div.mian ol li textarea.readonly{background: none;}

    div.mian ol h1 form{display: inline-block; float: right;}
    div.mian ol h1 form label{font-weight: normal;}
    div.mian ol h1 form input{padding: 5px;}

    button{padding: 5px 20px;}

    div.tableFoot{padding-top: 10px; line-height: 30px;}
    div.tableFoot button{font-size: 12px; padding: 3px 5px;}
</style>

<ol>

    <?php if(isset($_GET['id']) and $_GET['id'] > 0) { ?>
        <h1>订单详细</h1>
        <h2>查看订单详细内容！</h2>

        <?php
        $s = array(
            'table' => 'cart',
            'condition' => 'id = ' . $_GET['id']
        );
        $r = $mysql->row($s);
        //print_r($r);

        if(!is_array($r)) echo '<script>alert("对不起，产品不存在！请核实！"); location.href="/i?s=store&i=cart";</script>';
        if($r['sid'] != $os['id']) echo '<script>alert("非法操作！请核实！"); location.href="/i?s=store&i=cart";</script>';

        $sg = array(
            'table' => 'goods',
            'condition' => 'id = ' . $r['gid']
        );
        $rg = $mysql->row($sg);



        $su = array(
            'table' => 'user',
            'condition' => 'id = ' . $r['uid']
        );
        $ru = $mysql->row($su);
        ?>
        <form action="?s=store&i=cart&id=<?php echo $_GET['id']; ?>&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">
            <li>
                <label>订单编号：</label>
                <input class="readonly" readonly type="text" value="<?php echo $r['bar']; ?>" />
            </li>

            <li>
                <label>支付宝订单编号：</label>
                <input class="readonly" readonly type="text" value="<?php echo $r['trade_no']; ?>" />
            </li>

            <li>
                <label>产品：</label>
                <input class="readonly" readonly type="text" value="<?php echo $rg['title']; ?>" />
                <span><a target="_blank" href="http://ireoo.com/goods.<?php echo $r['gid']; ?>.html">产品链接</a></span>
            </li>

            <li>
                <label>用户：</label>
                <input class="readonly" readonly type="text" value="<?php echo $ru['username']; ?>" />
                <span>用户ID：<?php echo $r['uid']; ?></span>
            </li>

            <li>
                <label>产品数量：</label>
                <input class="readonly" readonly type="text" value="<?php echo $r['member']; ?>" />
            </li>

            <li>
                <label>产品总价：</label>
                <input<?php if($r['pay'] > 1) {echo ' class="readonly" readonly';} ?> type="text" name="money" value="<?php echo $r['money']; ?>" />
            </li>

            <li>
                <label>邮寄地址：</label>
                <textarea<?php if($r['pay'] > 1) {echo ' class="readonly" readonly';} ?> name="address" style="width: 272px; height: 60px; padding: 5px; resize: none;"><?php echo $r['address']; ?></textarea>
            </li>
            <?php if($r['pay'] == 1) { ?>
                <li>
                    <label> </label>
                    <button>修改</button>
                </li>
            <?php } ?>
        </form>
    <?php } ?>
    <h1>订单管理
        <form action="" method="get">
            <label>订单号:</label>
            <input type="hidden" name="s" value="<?php echo $_GET['s']; ?>" />
            <input type="hidden" name="i" value="<?php echo $_GET['i']; ?>" />
            <input type="text" name="bar" value="<?php echo $_GET['bar']; ?>" />
            <button>查询</button>
        </form>
    </h1>
    <h2>修改订单价格，查看详细信息！</h2>

    <table>
        <thead>
        <tr>
            <td style="width: 100px;">订单号</td>
            <td style="width: 20%;">标题</td>
            <td style="width: 10%;">用户</td>
            <td style="width: 40px; text-align: center;">数量</td>
            <td style="width: 80px; text-align: center;">总价</td>
            <td style="width: 30%;">邮寄地址</td>
            <td style="width: 60px; text-align: center;">状态</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php
        $s = array(
            'table' => 'cart',
            'condition' => 'pay > 1 and sid = ' . $os['id']
        );

        if(isset($_GET['bar'])) $s['condition'] .= " and bar like '%{$_GET['bar']}%'";

        $r = $mysql->select($s);
        //print_r($baobei);
        foreach($r as $key => $value) {
            $v = $value['cart'];
            $sg = array(
                'table' => 'goods',
                'condition' => 'id = ' . $v['gid']
            );
            $rg = $mysql->row($sg);

            $su = array(
                'table' => 'user',
                'condition' => 'id = ' . $v['uid']
            );
            $ru = $mysql->row($su);

            ?>
            <tr<?php if($_GET['id'] == $v['id']) {echo ' class="on"';} ?>>
                <td><span><?php echo $v['bar']; ?></span></td>
                <td><span><?php echo $rg['title']; ?></span></td>
                <td><span><?php echo $ru['username']; ?></span></td>
                <td style="text-align: center;"><span><?php echo $v['member']; ?></span></td>
                <td style="text-align: center;"><span><?php echo $v['money']; ?></span></td>
                <td><span><?php echo $v['address']; ?></span></td>
                <td style="text-align: center;">
                    <span>
                        <?php
                        switch($v['pay']) {
                            case 1:
                                if($v['address'] == '') {
                                    echo '<span style="color: #00ef00;">确认购买</span>';
                                }else{
                                    echo '<span style="color: red;">等待付款</span>';
                                }
                                break;
                            case 2:
                                echo '<span style="color: blue;">支付完成</span>';
                                break;
                            case 3:
                                echo '<span style="color: #c934d1;">已收货</span>';
                                break;
                            default:
                                echo '<span style="color: red;">错误代码！</span>';
                                break;
                        }
                        ?>
                    </span>
                </td>
                <td><a href="?s=store&i=cartSuccess&id=<?php echo $v['id']; ?>">查看详细</a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

</ol>
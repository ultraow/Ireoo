<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-1-22
 * Time: 下午8:12
 */

?>

<?php

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        $r1 = $mysql->update('user', $_POST, "id = $id");
        //print_r($_POST);
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=company&i=business");
    }
}

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
    <h1>商家管理</h1>
    <h2>可以管理该店旗下的所有商家！</h2>

    <table>
        <thead>
        <tr>
            <td>用户名</td>
            <td>代理</td>
            <td>手机</td>
            <td>邮箱</td>
            <td>商城</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = array(
            'table' => 'user',
            'condition' => "`show` = 1 or `show` = 2"
        );
        $re = $mysql->select($sql);
        //print_r($s);
        foreach($re as $key => $value) {
            $v = $value['user'];
            ?>
            <tr>
                <td><?php echo $v['username']; ?></td>
                <td><?php echo $v['uid']; ?></td>
                <td><?php echo $v['phone']; ?></td>
                <td><?php echo $v['email']; ?></td>
                <td><?php if($v['show'] == 2) {echo '已启用' . '<a class="charge" Id="' . $v['id'] . '" rel="1">关闭</a>';}else{echo '未启用' . '<a class="charge" Id="' . $v['id'] . '" rel="2">开启</a>';} ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

</ol>
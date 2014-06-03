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
        if($_GET['m'] == 'set') {
            $r1 = $mysql->update('store', array('show' => 1), "id = {$_GET['id']}");
        }elseif($_GET['m'] == 'unset') {
            $r1 = $mysql->update('store', array('show' => 0), "id = {$_GET['id']}");
        }
        //print_r($_POST);
        $_SESSION['token'] = $_GET['token'];
    }
    header("Location: /i?s=business");
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
            <td>简介</td>
            <td>类型</td>
            <td>操作员</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = array(
            'table' => 'store'
        );
        $re = $mysql->select($sql);
        //print_r($s);
        foreach($re as $key => $value) {
            $v = $value['store'];
            ?>
            <tr>
                <td><?php echo $v['sname']; ?></td>
                <td><div style="width: 500px; height: 60px; text-overflow: ellipsis; overflow: hidden;"><?php echo $v['desc']; ?></div></td>
                <td>
                <?php
                    if($v['show'] == 0) {echo '普通用户';}
                    elseif($v['show'] == 1) {echo '认证用户';}
                ?>
                </td>
                <td>admin</td>
                <td>
                    <a href="?<?php echoGet('m,id,token'); ?>m=set&id=<?php echo $v['id']; ?>&token=<?php echo md5(rand(0, 10000000000000)); ?>">认证</a>
                    <a href="?<?php echoGet('m,id,token'); ?>m=unset&id=<?php echo $v['id']; ?>&token=<?php echo md5(rand(0, 10000000000000)); ?>">取消认证</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

</ol>
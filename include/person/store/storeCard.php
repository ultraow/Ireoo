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
        header("Location: /i?s=store&i=storeCard");
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
    <h1>卡片管理</h1>
    <h2>查看管理关注我们的用户，在此页面，你可以查看到用户的很多相关资料，方便你们管理你的企业或实体店！</h2>

    <table>
        <thead>
        <tr>
            <td>标题</td>
            <td>介绍</td>
            <td>背景</td>
            <td>数量</td>
            <td>使用量</td>
            <td>开始时间</td>
            <td>结束时间</td>
            <td>创建时间</td>
            <td>积分兑换比</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = array(
            'table' => 'cardList',
            'condition' => "sid = '" . $id . "'"
        );
        $re = $mysql->select($sql);
        //print_r($s);
        foreach($re as $key => $value) {
            $v = $value['cardList'];
            ?>
            <tr>
                <td><?php echo $v['title']; //echo DATE('Y md') . ' ' .rand(1000, 9999) . ' ' . rand(1000, 9999); ?></td>
                <td><?php echo $v['desc']; //echo DATE('Y md') . ' ' .rand(1000, 9999) . ' ' . rand(1000, 9999); ?></td>
                <td><?php echo $v['bg']; //echo DATE('Y md') . ' ' .rand(1000, 9999) . ' ' . rand(1000, 9999); ?></td>
                <td><?php echo $v['member']; ?></td>
                <td><?php echo $v['used']; ?></td>
                <td><?php echo $v['startTime']; ?></td>
                <td><?php echo $v['overTime']; ?></td>
                <td><?php echo $v['timer']; ?></td>
                <td><?php echo $v['integral']; ?></td>
                <td>
                    <a class="recharge" Id="<?php echo $value['cardList']['id']; ?>">修改</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

</ol>
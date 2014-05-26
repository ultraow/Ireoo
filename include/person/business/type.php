<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 14-5-24
 * Time: 下午9:06
 */

?>

<?php

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        $_SESSION['token'] = $_GET['token'];
        if(isset($_GET['m']) and $_GET['m'] == 'edit') {
        $r1 = $mysql->update('form', $_POST, "id = {$_POST['id']}");
        //print_r($_POST);
        }


        if(isset($_GET['m']) and $_GET['m'] == 'del') {
            $id = $_GET['id'];
            $mysql->delete('form',  "id = $id");
        }
    }else{
        header("Location: /i?s=business&i=type");
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

    input{padding: 5px; font-size: 14px;}
    button{padding: 5px 20px;}
</style>

<ol>
    <h1>分类管理</h1>
    <h2> </h2>

    <table>
        <thead>
        <tr>
            <td>位置</td>
            <td>名称</td>
            <td>首页显示</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = array(
            'table' => 'form',
            'order' => 'xian asc'
        );
        $re = $mysql->select($sql);
        //print_r($s);
        foreach($re as $key => $value) {
            $v = $value['form'];
            $mysql->update('form', array('xian' => $key + 1), "id = {$v['id']}");
            ?>
            <tr>
                <form action="?s=business&i=type&m=edit&token=<?php echo md5(rand(0, 10000000000000)); ?>" method="post">
                <td><input type="text" name="xian" value="<?php echo $key + 1; ?>" /></td>
                <td><input type="text" name="value" value="<?php echo $v['value']; ?>" /></td>
                <td><input type="text" name="i" value="<?php echo $v['i']; ?>" /></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $v['id']; ?>" />
                    <button>修改</button>
                    <a href="?s=business&i=type&m=del&id=<?php echo $v['id']; ?>&token=<?php echo md5(rand(0, 10000000000000)); ?>">删除</a>
                </td>
                </form>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

</ol>
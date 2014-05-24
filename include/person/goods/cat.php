<?php
$id = $os['id'];

$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];

if($token != '') {
    if($token != $_SESSION['token']) {
        if(isset($_GET['id'])) {
            $mysql->update('goodsList', $_POST, "id = {$_GET['id']}");
        }else{
            $_POST['timer'] = time();
            $_POST['sid'] = $id;
            $_POST['gid'] = 0;
            $mysql->insert('goodsList', $_POST);
        }
        //print_r($_POST);
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=goods&i=cat");
    }
}

$goods = new goods;
?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px; min-width: 900px;}
    div.mian ol ul{ list-style: disc; padding-left: 30px;}
    div.mian ol ul li{padding: 5px 0;}
    div.mian ol ul li input{width: 200px; padding: 5px;}

    button{padding: 3px 5px; font-size: 12px; font-weight: normal;}
    button.green{background: green;}
    button.green:hover{background: #00e200;}
</style>

<ol>
    <h1>分类管理</h1>
    <h2> </h2>
    <ul>
        <li>
            <form action="?s=goods&i=cat&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">
                <input type="text" name="value" value="" />
                <button class="green">添加</button></form>
        </li>
        <?php
        $list = $goods->getList($mysql, $id);
        //print_r($list);
        foreach($list as $k => $v) {
            ?>
            <li>
                <form action="?s=goods&i=cat&id=<?php echo $v['id']; ?>&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">
                    <input type="text" name="value" value="<?php echo $v['value']; ?>" />
                    <button>修改</button>
                </form>
            </li>
        <?php
        }
        ?>
    </ul>
</ol>
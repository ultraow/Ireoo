<?php
$id = $os['id'];
if(isset($_GET['m']) and $_GET['m'] == 'del') {

    $mysql->update('goods',array('del' => 1), 'id = ' . $_GET['id']);
    header("Location: /i?s=store&i=goodsList");

}
?>
<style type="text/css">
    div.mian ol{padding-bottom: 100px; min-width: 900px;}
    div.mian ol table{border-collapse: collapse; width: 100%; background: #FFF;}
    div.mian ol table tr{margin-bottom: 10px;}
    div.mian ol table tr td{border: 1px #CCC solid; padding: 5px; font-size: 12px;}
    div.mian ol table tr td img{width: 100px; height: 100px;}
    div.mian ol table thead tr td{background: #4898F8; color: #FFF; border-color: #4898F8;}
    div.mian ol table tr td.first{background: none; border: none; width: 40px; padding: 0;}
    div.mian ol table tr td.foot{background: none; border: none; width: 215px;}
    div.mian ol table tbody tr td a{padding: 3px; background: #4898F8; color: #FFF; cursor: pointer;}
    div.mian ol table tbody tr td img.headimg{width: 30px; height: 30px;}
    div.mian ol table tbody tr td button{font-size: 12px; margin-left: 10px; padding: 3px 5px;}

    button{padding: 5px 20px;}

    div.tableFoot{padding-top: 10px; line-height: 30px;}
    div.tableFoot button{font-size: 12px; padding: 3px 5px;}
</style>

<ol>
    <h1>宝贝管理</h1>
    <h2>查看管理关注我们的用户，在此页面，你可以查看到用户的很多相关资料，方便你们管理你的企业或实体店！</h2>

    <table>
        <thead>
        <tr>
            <td style="width: 100px;">标题</td>
            <td></td>
            <td>分类</td>
            <td>价格</td>
            <td>售出/总</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php
        $goods = new goods;
        $baobei = $goods->getAll($mysql, $o['id']);
        //print_r($baobei);
        foreach($baobei as $key => $value) {

            $img = explode(',', $value['img']);
            if(is_numeric($img[0])) {
                $url = "/image.{$img[0]}.100.100.1";
            }else{
                $url = $img[0];
            }

            ?>
            <tr>
                <td><img src="<?php echo $url; ?>" /></td>
                <td><span><a target="_blank" href="goods.<?php echo $value['id']; ?>"><?php echo $value['title']; ?></a></span></td>
                <td><span><?php echo $value['type']; ?></span></td>
                <td><span><?php echo $value['rebate'] . '[现价]/' . $value['money'] . '[原价]/' . $value['price']; ?></span></td>
                <td><span><?php echo $value['sell'].'/'.$value['top']; ?></span></td>
                <td>
                    <a href="?s=store&i=goodsList&m=edit&id=<?php echo $value['id']; ?>">修改</a>
                    <a href="?s=store&i=goodsList&m=del&id=<?php echo $value['id']; ?>">删除</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

</ol>
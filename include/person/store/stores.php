<style type="text/css">
    div.mian div.say ol{float: left; width: 490px; background: #FFF; padding: 5px; padding-top: 30px;}

    div.mian div.say ol li{border-top: 1px #EBEBEB solid; font-size: 14px; overflow: auto; position: relative; padding-top: 5px; padding-bottom: 5px;}
    div.mian div.say ol li.first{border-top: none;}
    div.mian div.say ol li img{float: left;}
    div.mian div.say ol li div{padding-left: 100px; font-weight: normal; color: #000; font-size: 12px;}
    div.mian div.say ol li div h2{margin-bottom: 5px; font-size: 14px; padding: 0;}
    div.mian div.say ol li div h2 a{font-size: 14px; color: #4898F8; font-weight: bold;}
    div.mian div.say ol li div h2 a:hover{text-decoration: underline;}
    div.mian div.say ol li div span{display: block; line-height: 20px; color: #999;}
    div.mian div.say ol li div span a.user{color: #666; margin-left: 5px;}
    div.mian div.say ol li div span a.user:hover{text-decoration: underline;}
    div.mian div.say ol li em{font-style: normal; display: inline-block; font-size: 12px; color: #999; margin-left: 10px; padding-top: 10px;}
    div.mian div.say ol li em a{color: #333;}
    div.mian div.say ol li em a:hover{text-decoration: underline; color: #666;}

    div.mian div.say ol li.last{border-bottom: none; text-align: right;}
    div.mian div.say ol li.last a{font-weight: bold; font-size: 12px; padding: 10px; display: inline-block;}
    div.mian div.say ol li.last a.pre{background: #CCC; color: #FFF;}
    div.mian div.say ol li.last a.pre:hover{background: #999;}
    div.mian div.say ol li.last a.next{background: #4898F8; color: #FFF;}
    div.mian div.say ol li.last a.next span{color: #D2EEFB;}
    div.mian div.say ol li.last a.next:hover{background: #4e8fd2;}

    div.mian div.say ol li.foot div{padding: 10px; margin: 5px; font-size: 12px; border: 1px #CCC solid; background: #EBEBEB; text-align: center;}

    button{padding: 5px 20px;}
</style>
<ol>
    <h1>琦益管理</h1>
    <h2>你还可以在右边栏点击添加琦益。</h2>
    <?
    if(isset($_GET['y'])) {
        $now = $_GET['y'];
    }else{
        $now = 1;
    }
    $show = 10;
    $start = $show * ($now - 1);

    $store = new store;
    $s = array(
        'condition' => 'uid = ' . $o['id'],
        'limit' => "LIMIT $start, $show"
    );
    //print_r($s);
    $r = $store->show($mysql, $s);
    foreach($r as $k => $v) {
        ?>
        <li<?php if($k == 0) echo ' class="first"'; ?>>
            <img src="<?php echo HOST_URL . 'include/img.php?l=90&x=' . $v['x'] . '&y=' . $v['y'] . '&t=' . $v['avatar']; ?>" /> <!-- . 'include/img.php?l=50&x=' . $user['x'] . '&y=' . $user['y'] . '&t='  -->
            <div>
                <h2><a href="<?php echo HOST_URL . $v['id']; ?>"><?php echo $v['sname']; ?></a></h2>
                <?php
                $u = new user;
                $user = $u->getID($mysql, $v['uid']);
                ?>
                <span>创始人<a class="user" href="#" id="user" rel="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></span>
                <span>管理<a class="user" href="#" id="user" rel="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></span>
            </div>
            <em>
                <a href="<?php echo HOST_URL . $v['id']; ?>">详细</a>
                |
                <a href="?i=storeEdit&id=<?php echo $v['id']; ?>">修改</a>
                |
                <a href="?i=store&delId=<?php echo $v['id']; ?>">删除</a>
            </em>
        </li>
    <?php } ?>
    <?php
    $store = new store;
    $s = array(
        'condition' => 'uid = ' . $o['id']
    );
    //print_r($s);
    $quanquan = $store->show($mysql, $s);
    //echo count($quanquan);
    $ye = ceil(count($quanquan)/10);
    ?>
    <!--
    <li class="foot">
        <div>努力加载数据中...</div>
    </li>

    -->
    <li class="last">
        <?php if($now > 1) {?><a href="?i=store&y=<?php echo $now - 1; ?>" class="pre">＜</a><?php } ?>
        <?php if($now < $ye) {?><a href="?i=store&y=<?php echo $now + 1; ?>" class="next"><span>下一页</span> ＞</a><?php } ?>
    </li>
</ol>
<div class="g">
    <ul class="fast">
        <li><a class="add" href="?i=storeAdd"><b><i class="add"></i>创建圈圈</b></a></li>
    </ul>
    <?php include_once('g.php'); ?>
</div>
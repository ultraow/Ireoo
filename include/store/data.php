<style type="text/css">
/*   data   */
div.data{float: right;}
div.data ul{width: 600px; padding: 0px; margin: 0px;}
div.data ul li ul{clear: both; margin-bottom: 10px; background: #FFF; padding: 20px;}
div.data ul li ul fieldset button{background: #EBEBEB; cursor: pointer; font-size: 14px; color: #333; position: absolute; top: -3px; right: 0px; border: 1px #CCC solid; padding-left: 10px; padding-right: 10px; border-radius: 10px;}
div.data ul li ul fieldset button:hover, div.data ul li ul fieldset button.hover{background: #CCC;}
div.data ul li ul li{font-size: 12px; line-height: 30px; color: #000;}
div.data ul li ul li label{display: inline-block; width: 62px; text-align: right; color: gray; margin-right: 20px;}
div.data ul li ul li span{margin-right: 5px;}
div.data ul li ul li em{position: relative; color: #4e8fd2; text-decoration: none; padding: 2px; padding-left: 10px; padding-right: 10px; font-style: normal; cursor: pointer;}
div.data ul li ul li em div{display: none; position: absolute; top: 21px; left: -30px; padding: 10px; width: 300px; cursor: auto;}
div.data ul li ul li em div a{color: #FFF; display: inline-block; padding: 3px; cursor: pointer;}
div.data ul li ul li em div a:hover{color: #FC0;}
div.data ul li ul li em.hover{text-decoration: underline;}
div.data ul li ul li em.on{background: #333; color: #FFF;}
div.data ul li ul li em.on div{display: block; background: #333;}

ul.phone li span, ul.full li span{width: 236px; display: inline-block;}
ul.phone div, ul.full div{margin: 10px; border: 1px #FF8409 solid; background: #FBEAD9; padding: 10px;}
ul.phone div a, ul.full div a{font-size: 12px; color: #333; text-decoration: none;}
ul.phone div a:hover, ul.full div a:hover{color: #000; text-decoration: underline;}

form input{padding: 3px; border: 1px #CCC solid; background: #FFF;}
form select{padding: 3px; border: 1px #CCC solid; background: #FFF; margin: 0px; margin-right: 5px;}
form textarea{border: 1px #CCC solid; background: #FFF; padding: 3px; outline: none;}
.mmax{width: 90%;}
.max{width: 70%; max-width: 70%;}
.min{width: 50%; max-width: 50%;}
.mini{width: 20%; max-width: 20%; margin-right: 10px;}
.no{display: inline-block; border: none; background: none; width: auto;}

fieldset.tagf{padding-bottom: 20px;}
a.tagc{display: inline-block; padding: 5px; padding-left: 10px; padding-right: 10px; color: #333; background: #CCC; font-size: 12px; text-decoration: none; margin-right: 10px; margin-bottom: 10px;}
a.tagc:hover{background: #666;}

li.tagg form{border: 1px #CCC solid; background: #F7F7F7; padding: 10px; margin-bottom: 20px;}
li.tagg form label{display: inline-block; font-size: 12px;}
li.tagg form input{font-size: 12px; padding: 3px;}
li.tagg form button{padding: 3px; font-size: 12px; padding-left: 15px; padding-right: 15px; background: #4e8fd2; border: 1px #06F solid; cursor: pointer; color: #FFF;}

li.form, li.nature{padding-left: 82px; display: none;}
li.form div, li.nature div{padding: 10px; border: 1px #CCC solid; background: #F7F7F7; margin-bottom: 20px;}
a.choose{display: inline-block; padding: 3px; color: #FFF; font-size: 12px; padding-left: 10px; padding-right: 10px; background: #4e8fd2; height: auto; line-height: normal; cursor: pointer;}
a.choose:hover{background: #09F;}
a.chooses{margin-left: 20px; color: #4e8fd2; font-size: 12px; cursor: pointer;}
a.chooses:hover{text-decoration: underline;}
</style>
<div class="data">
    <ul>
        <li>
            <?php if(isset($_GET['e']) and $_GET['e'] == 'yes' and $edit) { ?>
            <form action="" method="post">
                <ul>
                    <fieldset><legend>基本信息</legend><a class="edit" onclick="$(this).parent().parent().parent().submit();">保存</a></fieldset>
                    <li><label>名称</label><input class="max" type="text" name="sname" value="<?php echo $this_store['sname']; ?>" /></li>
                    <li><label>城市</label><input class="mini" type="text" name="province" value="<?php echo $this_store['province']; ?>" /><input class="mini" type="text" name="city" value="<?php echo $this_store['city']; ?>" /></li>
                    <li><label>性质</label><input class="mini" type="hidden" name="nature" value="<?php echo $this_store['nature']; ?>" /><span><?php echo $nature[$this_store['nature']]; ?></span><a class="chooses">选择</a></li>
                    <li class="form"><div>
                        <?php foreach($nature as $k => $v) { ?>
                        <a class="choose" id="<?php echo $k; ?>"><?php echo $v; ?></a>
                        <?php } ?>
                    </div></li>
                    <li><label>类型</label><input class="mini" type="hidden" name="form" value="<?php echo $this_store['form']; ?>" /><span><?php echo $form[$this_store['form']]; ?></span><a class="chooses">选择</a></li>
                    <li class="form"><div>
                        <?php foreach($form as $k => $v) { ?>
                        <a class="choose" id="<?php echo $k; ?>"><?php echo $v; ?></a>
                        <?php } ?>
                    </div></li>
                    <li><label>规模</label><input class="mini" type="hidden" name="area" value="<?php echo $this_store['area']; ?>" /><span><?php echo $area[$this_store['area']]; ?></span><a class="chooses">选择</a></li>
                    <li class="form"><div>
                        <?php foreach($area as $k => $v) { ?>
                        <a class="choose" id="<?php echo $k; ?>"><?php echo $v; ?></a>
                        <?php } ?>
                    </div></li>
                    <li><label>员工人数</label><input class="mini" type="text" name="persons"  value="<?php echo $this_store['persons']; ?>" /></li>
                    <li><label>成立时间</label><input class="mini" type="text" name="time" value="<?php echo $this_store['time']; ?>" />年</li>
                    <li><label>具体位置</label><input class="max" type="text" name="address" value="<?php echo $this_store['address']; ?>" /></li>
                    <li><label>简介</label><textarea class="max" name="synopsis"><?php echo $this_store['synopsis']; ?></textarea></li>
                </ul>
            </form>
            <?php }else{ ?>
            <ul>
                <fieldset><legend>基本信息</legend><?php if($edit) { ?><a class="edit" href="?e=yes">编辑</a><?php } ?></fieldset>
                <li><label>名称</label><span><?php echo $this_store['sname']; ?></span></li>
                <li><label>城市</label><span class="city"><?php echo $this_store['province'].' '.$this_store['city']; ?></span></li>
                <li><label>性质</label><span><?php echo $nature[$this_store['nature']]; ?></span></li>
                <li><label>类型</label><span><?php echo $form[$this_store['form']]; ?></span></li>
                <li><label>规模</label><span><?php echo $area[$this_store['area']]; ?></span></li>
                <li><label>员工人数</label><span><?php echo $this_store['persons']; ?></span></li>
                <li><label>成立时间</label><span><?php echo $this_store['time']; ?>年</span></li>
                <li><label>具体位置</label><span><?php echo $this_store['address']; ?></span></li>
                <li><label>简介</label><span><?php echo $this_store['synopsis']; ?></span></li>
            </ul>
            <?php } ?>
        </li>
        <li>
            <ul class="phone">
                <fieldset><legend>联系信息</legend></fieldset>
                <?php if($edit) { ?>
                <?php if(isset($_GET['e']) and $_GET['e'] == 'addphone') { ?>
                    <form class="add" action="" method="post">
                        <li><label>联系人：</label>
                            <select name="type">
                                <option value="座机">座机</option>
                                <option value="手机">手机</option>
                                <option value="E-mail">E-mail</option>
                            </select>
                        </li>
                        <li><label>联系人：</label><input type="text" name="title" /></li>
                        <li><label>电话号码：</label><input type="text" name="member" /></li>
                        <li>
                            <label>接待时间：</label>
                            <select name="days">
                                <?php for($i = 1; $i < 8; $i++) { ?>
                                <option<?php if($i == 7) { ?> selected="selected"<?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>天 ×
                            <select name="times">
                                <?php for($i = 1; $i < 25; $i++) { ?>
                                <option<?php if($i == 24) { ?> selected="selected"<?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>小时
                        </li>
                        <li><button>添加</button><a class="link1" href="<?php echo HOST_URL; ?>s/<?php echo $this_store['id']; ?>/data">取消</a></li>
                    </form>
                    <?php }else{ ?>
                    <div class="add"><a href="">添加一条联系信息</a></div>
                    <?php }} ?>
                <?php foreach($store->phone($mysql) as $k => $v) { ?>
                <li><label><?php echo $v['type']; ?></label><span><?php echo $v['member']; ?> 「<?php echo $v['title']; ?>」</span><span><?php echo $v['days']; ?>天 * <?php echo $v['times']; ?>小时 服务</span><?php if($edit) { ?><a class="edit" href="">×</a><?php } ?></li>
                <?php } ?>
            </ul>
        </li>
        <li>
            <ul class="full">
                <fieldset><legend>详细信息</legend></fieldset>
                <?php if($edit) { ?>
                <?php if(isset($_GET['e']) and $_GET['e'] == 'addfull') { ?>
                    <form class="add" action="" method="post">
                        <li><label>联系人：</label><input type="text" name="title" /></li>
                        <li><label>电话号码：</label><input type="text" name="value" /></li>
                        <li><button>添加</button><a class="link1" href="<?php echo HOST_URL; ?><?php echo $this_store['id']; ?>/data">取消</a></li>
                    </form>
                    <?php }else{ ?>
                    <div class="add"><a href="">添加一条详细信息</a></div>
                    <?php }} ?>
                <?php foreach($store->basic($mysql) as $k => $v) { ?>
                <li><label><?php echo $v['title']; ?></label><span><?php echo $v['value']; ?></span><span></span><?php if($edit) { ?><a class="edit" href="">×</a><?php } ?></li>
                <?php } ?>
            </ul>
        </li>
    </ul>
</div>
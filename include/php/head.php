<div class="meun">
    <ul class="meun">
        <div<?php if(is_array($o)) {echo ' class="login"';} ?>>

            <?php
            if(is_array($o)) {
                ?>
                <a href="<?php echo HOST_URL; ?>i"><img src="<?php echo $o['avatar_large']; ?>" /><span><?php echo $o['username']; ?></span></a><a href="<?php echo HOST_URL; ?>/"><span>收藏夹</span></a><a href="<?php echo HOST_URL; ?>/cart"><span>购物车</span></a><a href="#"><span>联系客服</span></a><a href="<?php echo HOST_URL; ?>?loginout=yes"><span>退出</span></a>
            <?php
            }else{
                ?>
                您好！欢迎登录琦益网，<a href="<?php echo HOST_URL; ?>reg"><span>免费注册</span></a>|<a href="<?php echo HOST_URL; ?>login?url=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>"><span>登陆</span></a>
            <?php
            }
            ?>
        </div>

        <li><a href="<?php echo HOST_URL; ?>"><span><?php echo SNAME; ?></span></a></li>
        <li><a href="<?php echo HOST_URL; ?>store"><span>所有企业</span></a></li>
    </ul>

</div>
<div class="meunbackground"></div>
<style type="text/css">
        /*    index    */
    div.index{border: 1px #CCC solid; margin-bottom: 15px; background: #FFF;}/*float: left; width: 560px; */
    div.index h1.t{font-family: "microsoft yahei"; font-size: 20px; line-height: 50px; height: 80px; border-bottom: 1px #CCC solid; padding-left: 10px;}
    div.index ul.about{padding: 10px;}
    div.index ul h1{font-size: 16px; margin-bottom: 10px;}
    div.index ul div.com{border-bottom: 1px #CCC double; padding-bottom: 10px;}
        /*     div.isider      */
    div.isider{} /*float: right; width: 210px; */

    div.isider ul.left{float: left; width: 349px;}
    div.isider ul.right{float: right; width: 349px;}
    div.isider ul li{border: 0;}
    div.isider ul li ul{padding: 10px; border: 0;}
    div.isider ul li ul h1{font-size: 16px; color: #333; margin-bottom: 10px;}
    div.isider ul li ul li{font-size: 12px; color: #000; padding: 10px 0 !important;}

    div.isider ul li ul li.phone a{color: #999;}
    div.isider ul li ul li.phone a:hover{color: #333; text-decoration: underline;}
    div.isider ul li ul li.phone{display: block; padding: 10px; border-top: 1px #EBEBEB dashed;}
    div.isider ul li ul li.first{border-top: none;}
    div.isider ul li ul li.phone span.type{display: inline-block; width: 100px; color: #999; font-weight: bold;}

    div.isider ul li ul li.other a{color: #999;}
    div.isider ul li ul li.other a:hover{color: #333; text-decoration: underline;}
    div.isider ul li ul li.other{display: block; padding: 10px; border-top: 1px #EBEBEB dashed;}
    div.isider ul li ul li.first{border-top: none;}
    div.isider ul li ul li.other span{display: inline-block; color: #999; font-weight: bold;}

    div.index div.gps{height: 400px;}
    div.index h1.t span{font-size: 12px; font-weight: normal; margin-left: 20px; color: #666;}
    div.index h1.t span b{color: #CCC; font-weight: normal;}

    /* photo */
    div.photo{padding-top: 3px;}
    div.photo a{margin-left: 3px; margin-bottom: 3px; width: 194px; height: 194px; border: 1px #EBEBEB solid; display: inline-block; overflow: hidden;}


</style>

<div class="index">
    <h1 class="t">简介<span><b>[</b> <?php echo $this_store['synopsis']; ?> <b>]</b></span></h1>
    <ul class="about">
        <h1>概况</h1>
        <div class="com" id="<?php echo $this_store['id']; ?>">
            <?php echo $this_store['desc']; ?>
        </div>
    </ul>
    <div class="isider">
        <ul class="left">
            <li>
                <ul>
                    <h1>联系方式</h1>
                    <li class="phone first"><span class="type">管理者</span><span class="member"><?php echo $admin['username']; ?></span></li>
                    <li class="phone"><span class="type">联系QQ</span><span class="member"><?php echo $admin['qq']; ?></span></li>
                    <li class="phone"><span class="type">联系电话</span><span class="member"><?php echo $admin['phone']; ?></span></li>
                    <li class="phone"><span class="type">SKYPE</span><span class="member"><?php echo $admin['skype']; ?></span></li>
                    <li class="phone"><span class="type">E-mail</span><span class="member"><?php echo $admin['email']; ?></span></li>
                </ul>
            </li>

            <!--
                        <h1>位置</h1>
                        <li id="GPS"></li>
            -->

        </ul>

        <ul class="right">
            <li>
                <ul>
                    <h1>其他信息</h1>
                    <li class="other first"><span><?php echo $this_store['sname']; ?></span> 成立于 <span><?php echo $this_store['time']; ?></span></li>
                    <li class="other">是一个 <span><?php echo $this_store['form']; ?></span> 公司</li>
                    <li class="other">目前规模 <span><?php echo $this_store['area']; ?></span></li>
                    <li class="other">目前已经拥有员工 <span><?php echo $this_store['persons']; ?></span> 人</li>
                    <li class="other"><?php if($this_store['nature'] == '实体' or $this_store['nature'] == '现实') {echo '拥有实体，可以在下面查看具体位置';} ?></li>
                </ul>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<?php if($this_store['nature'] == '实体' or $this_store['nature'] == '现实') {?>
<div class="index">
    <h1 class="t">位置<span><b>[</b> <?php echo $this_store['address']; ?> <b>]</b></span></h1>
    <div class="gps" id="gps"></div>
</div>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyACxm41BecCMxLEDgKIhPA-Yo0yJRgp4Lo&sensor=true"></script>
<script type="text/javascript">
    var map;
    function initialize() {
        var mapOptions = {
            zoom: <?php echo $this_store['ZOOM']; ?>,
            center: new google.maps.LatLng(<?php echo $this_store['GPS']!='0, 0'?$this_store['GPS']:"33.595577, 119.034311"; ?>),
            panControl: false,
            scaleControl: false,
            mapTypeControl: false,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('gps'),
            mapOptions);
        marker = new google.maps.Marker({
            map:map,
            draggable: false,
            animation: google.maps.Animation.DROP,
            position: new google.maps.LatLng(<?php echo $this_store['GPS']!='0, 0'?$this_store['GPS']:"33.595577, 119.034311"; ?>)
        });
        marker.setAnimation(google.maps.Animation.BOUNCE);
        //map.controls[google.maps.ControlPosition.CENTER].push(homeControlDiv);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php } ?>


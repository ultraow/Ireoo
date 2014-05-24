<?php
if(!isset($os) or $os['id'] == '') header("Location: /i?s=store&i=storeAdd");
$id = $os['id'];
$token = '';
if(isset($_GET['token'])) $token = $_GET['token'];
if($token != '') {
    if($token != $_SESSION['token']) {
        $_POST['GPS'] = substr($_POST['GPS'], 1, strlen($_POST['GPS'])-2);
        $r1 = $mysql->update('store', $_POST, "id = $id");
        //print_r($_POST);
        $_SESSION['token'] = $_GET['token'];
    }else{
        header("Location: /i?s=store&i=storeEditGPS");
    }
}
$store = new store;
$s = $store->show($mysql, array('condition'=>"id = $id"));
$s = $s[0];
?>
<style type="text/css">
    div.mian ol{position: relative; padding: 0;}
    div.mian ol li{font-size: 12px; padding-top: 5px; padding-bottom: 10px;}
    div.mian ol li a{font-size: 14px; cursor: pointer;}
    div.mian ol li a:hover{text-decoration: underline;}
    div.mian ol li label{display: inline-block; width: 80px; text-align: right; font-size: 12px; color: #666; padding-right: 5px;}
    div.mian ol li input{padding: 3px; font-size: 14px; width: 150px;}
    div.mian ol li input.max{width: 300px;}
    div.mian ol li select{padding: 3px;}
    div.mian ol button{width: 200px; height: 40px; position: absolute; left: 5px; bottom: 5px;}
    div.mian ol li ul.city{display: inline-block; width: 680px; margin-left: -4px; border: 1px solid #ffd88a; background: #FFE69F; padding: 10px;}
    div.mian ol li ul li{position: relative; display: inline-block; font-size: 14px; padding: 5px; cursor: pointer;}
    div.mian ol li ul li ul{position: absolute; display: none; left: 36px; top: 0; z-index: 3; width: 40px; border: 1px solid #4898F8; background: #FFF;}
    div.mian ol li ul li.hover{background: #4898F8; color: #FFF;}
    div.mian ol li ul li.hover ul{display: inline-block;}
    div.mian ol li ul li ul li{display: block; font-size: 12px;}
    div.mian ol li ul li ul li a{font-size: 12px;}
    div.mian ol li ul li ul li a:hover, div.mian ol li ul li ul li:hover a, div.mian ol li ul li ul li:hover{background: #4898F8; color: #FFF; text-decoration: none;}
    div.mian ol li ul h1{display: inline-block; border: none; font-size: 12px; font-weight: normal; color: #333; background: RGB(201, 201, 201); cursor: pointer;}
    input.state, input.city{cursor: pointer;}
    div#allmap, div#gps{height: 600px;}
</style>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyACxm41BecCMxLEDgKIhPA-Yo0yJRgp4Lo&sensor=true"></script>
<script type="text/javascript">
    var map;
    function zhongxin(controlDiv, map) {
        controlDiv.style.borderStyle = 'solid';
        controlDiv.style.borderWidth = '1px';
        controlDiv.style.borderColor = '#CCC';
        controlDiv.style.borderRadius = '14px';
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#4898F8';
        controlUI.style.borderStyle = 'solid';
        controlUI.style.borderWidth = '2px';
        controlUI.style.borderColor = '#FFF';
        controlUI.style.cursor = 'pointer';
        controlUI.style.textAlign = 'center';
        controlUI.title = '将你实体店的位置移动到这里!';
        controlUI.style.borderRadius = '10px';
        controlUI.style.width = '10px';
        controlUI.style.height = '10px';
        controlDiv.appendChild(controlUI);
        google.maps.event.addDomListener(controlUI, 'click', function() {
            map.setCenter(chicago)
        });
    }
    function initialize() {
        var mapOptions = {
            zoom: <?php echo $s['ZOOM']; ?>,
            center: new google.maps.LatLng(<?php echo $s['GPS']!='0, 0'?$s['GPS']:"33.595577, 119.034311"; ?>),
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
            draggable:true,
            animation: google.maps.Animation.DROP,
            position: new google.maps.LatLng(<?php echo $s['GPS']!='0, 0'?$s['GPS']:"33.595577, 119.034311"; ?>)
        });
        google.maps.event.addListener(marker, 'click', toggleBounce);

        google.maps.event.addListener(marker, 'dragend', function(event) { //当鼠标放下
            //alert(marker.getLat());
            $('.latlng').val(marker.getPosition());
            map.setCenter(marker.getPosition());
        });
        google.maps.event.addListener(map, 'zoom_changed', function() {

            $('.zoom').val(map.getZoom());
            //alert(map.getCenter());
        });
        //map.controls[google.maps.ControlPosition.CENTER].push(zhongxin);
    }
    function toggleBounce() {
        if (marker.getAnimation() != null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
    google.maps.event.addDomListener(window, 'load', initialize);

    $(function() {
        $('div#gps').height($(window).height() - $('div.top').height() - $('div.m').height() - $('div.foot').height());
        $('div.mian').height($(window).height() - $('div.top').height() - $('div.m').height() - $('div.foot').height());
        $(window).bind("resize", function() {
            $('div#gps').height($(window).height() - $('div.top').height() - $('div.m').height() - $('div.foot').height());
            $('div.mian').height($(window).height() - $('div.top').height() - $('div.m').height() - $('div.foot').height());
        });
    });
</script>
<ol>
    <form action="?s=store&i=storeEditGPS&token=<?php echo md5(rand(0, 100000000)); ?>" method="post">
        <div id="gps"></div>
        <input type="hidden" class="latlng" name="GPS" value="<?php echo $s['GPS']!='0, 0'?'('.$s['GPS'].')':"(33.595577, 119.034311)"; ?>" />
        <input type="hidden" class="zoom" name="ZOOM" value="<?php echo $s['ZOOM']!=0?$s['ZOOM']:17; ?>" />
        <button>保存</button>
    </form>
</ol>
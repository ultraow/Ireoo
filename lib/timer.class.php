<?php

class timer
{

    function __construct($time = 0) {

        date_default_timezone_set("PRC");

        $now = time();
        $ge = $now - $time;
        if($ge < 60) {
            echo $ge . '秒';
        }elseif($ge > 60 and $ge < 60*60) {
            echo floor($ge/60) . '分';
        }else
            if($ge > 60*60 and $ge < 60*60*24){
                echo floor($ge/60/60) . '时';
            }else{
                if(date('Y', $time) < date('Y')) echo date('Y', $time) . '年';
                echo floor(date('m', $time)) . '月' . floor(date('d', $time)) . '日';
            }

    }

    function __destruct() {

    }
}
?>
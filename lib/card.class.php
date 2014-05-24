<?php
/**
 * Created by PhpStorm.
 * User: ireoo
 * Date: 13-12-26
 * Time: 下午3:36
 */

function level($in) {
    $level = 0;
    $i = 0;
    while($i < $in) {
        $level++;
        $i = ($level * $level + 1) * $level * 100;
    }
    $level--;
    if($level<0) $level = 0;
    return $level;
}

?>
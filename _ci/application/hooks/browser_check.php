<?php
function b_check() {
    if(preg_match('/(iPhone|iPod|iPad|BlackBerry)/', $_SERVER['HTTP_USER_AGENT'])) {
        define('BROWSER_TYPE', 'I');
    } else if(preg_match('/(Android|IEMobile|HTC|wecwe_KO_SKT|SonyEricssonX1|SKT)/', $_SERVER['HTTP_USER_AGENT'])) {
        define('BROWSER_TYPE', 'M');
    } else {
        define('BROWSER_TYPE', 'W');
    }
}
?>

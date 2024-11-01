<?php

add_action('wp_footer','wtht_tongji_footer',99);

function wtht_tongji_footer() {
    $baidu_tongji_code = get_option('wtht_baidu_tongji');
    $google_tongji_code = get_option('wtht_google_tongji');
    echo $baidu_tongji_code;
    echo $google_tongji_code;
}

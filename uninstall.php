<?php

// 如果 uninstall.php不是被 wp 调用，则 exit
if (!defined("WP_UNINSTALL_PLUGIN")) {
    exit;
}

delete_option("wptimhbw_tools");
delete_option("wtht_domain");
delete_option("wtht_cdndomain");
delete_option("wtht_exts");
delete_option("wtht_gravatar_url");
delete_option("wtht_disable_gutenberg");
delete_option("wtht_post_revisions");
delete_option("wtht_wordpres_china_mirror");
delete_option("wtht_image_center");
delete_option("wtht_rewrite_page_permalink");
delete_option("wtht_baidu_tongji");
delete_option("wtht_google_tongji");
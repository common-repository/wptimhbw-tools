<?php

//使用经典编辑器，屏蔽Gutenberg编辑器
$wtht_disable_gutenberg  = get_option('wtht_disable_gutenberg');
if($wtht_disable_gutenberg)
{
    add_filter('use_block_editor_for_post_type', '__return_false');
}

//禁止文章修订
$wtht_post_revisions  = get_option('wtht_post_revisions');
if ($wtht_post_revisions) {
    define('WP_POST_REVISIONS', false);
    remove_action('pre_post_update', 'wp_save_post_revision');

    // 自动保存设置为1个小时
    define('AUTOSAVE_INTERVAL', 3600);
}

//中国镜像更新 wp
$wtht_wordpres_china_mirror  = get_option('wtht_wordpres_china_mirror');
if($wtht_wordpres_china_mirror)
{
    add_filter('site_transient_update_core', function($value){
        if(isset($value->updates)){
            foreach ($value->updates as &$update) {
                if($update->locale == 'zh_CN'){
                    $update->download		= 'https://app.dlcdn.timhbw.com/wordpress/wordpress-latest.zip';
                    $update->packages->full	= 'https://app.dlcdn.timhbw.com/wordpress/wordpress-latest.zip';
                }
            }
        }

        return $value;
    });

}
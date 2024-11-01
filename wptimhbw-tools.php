<?php
/*
Plugin Name: WPTimhbw Tools
Plugin URI:  https://timhbw.com/
Version: 1.1.4
Description: 设置博客静态资源使用七牛云CDN
Author: Timhbw
Author URI: https://timhbw.com/about.html
Copyright: Timhbw博客出品插件，任何个人或团体不可擅自更改版权。
*/

define('WTHT_VERSION', '1.1.4');
define('WPTIMHBW_TOOLS_PLUGIN_URL', plugins_url('', __FILE__));
define('WPTIMHBW_TOOLS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPTIMHBW_TOOLS_PLUGIN_FILE', __FILE__);

include(WPTIMHBW_TOOLS_PLUGIN_DIR . 'includes/settings/wp-tools-config.php');       //设置页面
include(WPTIMHBW_TOOLS_PLUGIN_DIR . 'includes/qiniucdn.php');                      //七牛cdn
include(WPTIMHBW_TOOLS_PLUGIN_DIR . 'includes/imgcenter.php');                     //图片插入居中优化
include(WPTIMHBW_TOOLS_PLUGIN_DIR . 'includes/pagehtml.php');                      //page页面添加html
include(WPTIMHBW_TOOLS_PLUGIN_DIR . 'includes/setgravatar.php');                      //设置默认Gravatar头像
include(WPTIMHBW_TOOLS_PLUGIN_DIR . 'includes/disable_functions.php');                      //相关禁用功能
include(WPTIMHBW_TOOLS_PLUGIN_DIR . 'includes/tongji.php');                      //底部插入统计代码

function wtht_plugin_install()
{
    update_option("wptimhbw_tools", "<p>Timhbw博客出品插件，任何个人或团体不可擅自更改版权。</p>");
    update_option("wtht_exts", "png|jpg|jpeg|gif|ico|bmp|css|js|mp4");
}

//启用插件时调用的方法
register_activation_hook(__FILE__, 'wtht_plugin_install');

if (is_admin()) {
    //侧边栏增加菜单
    add_action('admin_menu', 'wtht_add_menu');
    add_filter('plugin_action_links', 'wtht_plugin_action_links', 11, 3);
}

function wtht_plugin_action_links($links, $file)
{
    if (plugin_basename(__FILE__) !== $file) {
        return $links;
    }
    $settings_link = '<a href="admin.php?page=wptimhbw-setting">' . esc_html__('设置', 'wptimhbwtools') . '</a>';

    array_unshift($links, $settings_link);

    return $links;
}

function wtht_loadassets()
{
    wp_enqueue_style("tabs", plugins_url('/assets/css/tabs.css', __FILE__), false, WTHT_VERSION, "all");
    wp_enqueue_script('tabs', plugins_url('/assets/js/tabs.min.js', __FILE__), false, WTHT_VERSION, 'all');
}
<?php

if (!defined('ABSPATH')) {
    exit;
}

function wtht_add_menu()
{
    // 创建新的顶级菜单
    add_menu_page('Timhbw工具箱',
        'Timhbw工具箱',
        'administrator',
        'wptimhbw-setting',
        'wtht_settings_page',
        'dashicons-hammer',
        58);

    add_submenu_page('wptimhbw-setting',
        '设置',
        '设置',
        'administrator',
        'wptimhbw-setting',
        'wtht_settings_page');

    add_submenu_page('wptimhbw-setting',
        '工具介绍',
        '工具介绍',
        'administrator',
        'wptimhbw-about',
        'wtht_about_page');

    // 调用注册设置函数
    add_action('admin_init', 'wtht_register_toolsettings');
}

function wtht_register_toolsettings()
{
    // 注册设置
    register_setting('wtht-group', 'wtht_domain');
    register_setting('wtht-group', 'wtht_cdndomain');
    register_setting('wtht-group', 'wtht_exts');
    register_setting('wtht-group', 'wtht_gravatar_url');
    register_setting('wtht-group', 'wtht_disable_gutenberg');
    register_setting('wtht-group', 'wtht_post_revisions');
    register_setting('wtht-group', 'wtht_wordpres_china_mirror');
    register_setting('wtht-group', 'wtht_image_center');
    register_setting('wtht-group', 'wtht_rewrite_page_permalink');
    register_setting('wtht-group', 'wtht_baidu_tongji');
    register_setting('wtht-group', 'wtht_google_tongji');
}


function wtht_about_page()
{
    ?>

    <h2>关于Timhbw工具箱</h2>
    <div class="card" style="max-width: 640px; float: left; margin-top:20px;">
        <h2>Timhbw工具箱</h2>
        <p><strong>wptimhbw-tools</strong> 是 <strong><a href="https://timhbw.com/" target="_blank">timhbw</a></strong>
            开发的 WordPress 插件。
        </p>
        <p>为何要做这个插件：因为自己的博客需要用到，后续安装过很多插件，发现其实实现并不复杂，有时候只需要几行代码，
            导致插件安装太多了，后来就研究了下，把自己经常用到的功能都集成到这一个插件里面。后续的话还会新增更多常用必备功能。
        </p>
    </div>
    <?php

}

function wtht_settings_page()
{
    if (!empty($_REQUEST['settings-updated'])) {
        echo '<div id="message" class="updated fade"><p><strong>设置已保存</strong></p></div>';

    }
    ?>
    <div class="wrap">
        <h2>Timhbw工具箱 设置</h2>
        <p>By <a href="https://timhbw.com" target="_blank">Timhbw博客</a>
            <form method="post" action="options.php">
                <div class="responsive-tabs">
                    <?php settings_fields('wtht-group'); ?>
                    <?php do_settings_sections('wtht-group'); ?>
                    <div class="responsive-tabs">
                        <h2> 七牛CDN设置</h2>
                        <div class="section">
                            <table class="form-table">
                                <tr valign="top">
                                    <th scope="row">网站域名</th>
                                    <td><input type="text" name="wtht_domain" style="width:300px; height:40px"
                                               value="<?php echo esc_attr(get_option('wtht_domain')); ?>"/>*
        <p style="color: #FF0000; display:inline">当前网站的域名，不包含 http:// 或 https://</p></td>
        </tr>

        <tr valign="top">
            <th scope="row">CDN域名</th>
            <td><input type="text" name="wtht_cdndomain" style="width:300px; height:40px"
                       value="<?php echo esc_attr(get_option('wtht_cdndomain')); ?>"/>* <p
                        style="color: #FF0000; display:inline">静态资源的CDN域名，不包含 http:// 或 https://</p></td>
        </tr>

        <tr valign="top">
            <th scope="row">扩展名</th>
            <td><input type="text" name="wtht_exts" style="width:300px; height:40px"
                       value="<?php echo esc_attr(get_option('wtht_exts')); ?>"/>* <p
                        style="color: #FF0000; display:inline">设置要缓存静态文件的扩展名，请使用 | 分隔开，|前后都不要留空格。</p></td>
        </tr>
        </table>


    </div>


    <h2>Gravatar头像设置</h2>
    <div class="section">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">头像地址</th>
                <td><input type="text" name="wtht_gravatar_url" style="width:300px; height:40px"
                           value="<?php echo esc_attr(get_option('wtht_gravatar_url')); ?>"/>*
                    <p style="color: #FF0000; display:inline">填写头像的完整链接地址，包含 http:// 或 https://（点击保存后前往<a
                                href="options-discussion.php" target="_blank">这里</a>最底部选择改头像）</p></td>
            </tr>

        </table>
    </div>

    <h2>Footer添加统计代码</h2>
    <div class="section">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">百度统计</br><a href="https://tongji.baidu.com/" target="_blank">官网</a></th>
                <td><textarea rows="9" cols="80" maxlength='5000'
                              name="wtht_baidu_tongji"><?php echo esc_textarea(get_option('wtht_baidu_tongji')); ?></textarea></td>
            </tr>

            <tr valign="top">
                <th scope="row">谷歌统计</br><a href="https://analytics.google.com/" target="_blank">官网</a></th>
                <td><textarea rows="10" cols="80" maxlength='5000'
                              name="wtht_google_tongji"><?php echo esc_textarea(get_option('wtht_google_tongji')); ?></textarea></td>
            </tr>

        </table>
    </div>


    <h2> 其他优化设置</h2>
    <div class="section">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label for="wtht_disable_gutenberg">屏蔽Gutenberg编辑器</label>
                </th>
                <td>
                    <label for="wtht_disable_gutenberg">
                        <?php
                        $wtht_disable_gutenberg = get_option('wtht_disable_gutenberg');
                        $checkbox = empty($wtht_disable_gutenberg) ? '' : 'checked';
                        echo '<input name="wtht_disable_gutenberg" id="wtht_disable_gutenberg" type="checkbox"  value="1" ' . $checkbox . ' />';
                        ?><p style="display:inline">使用经典编辑器，屏蔽Gutenberg编辑器</p>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="wtht_post_revisions">屏蔽文章修订</label>
                </th>
                <td>
                    <label for="wtht_post_revisions">
                        <?php
                        $wtht_post_revisions = get_option('wtht_post_revisions');
                        $checkbox = empty($wtht_post_revisions) ? '' : 'checked';
                        echo '<input name="wtht_post_revisions" id="wtht_post_revisions" type="checkbox"  value="1" ' . $checkbox . ' />';
                        ?><p style="display:inline">屏蔽文章修订功能，禁止 WordPress 自动生成文章版本，减小数据库体积</p>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="wtht_wordpres_china_mirror">WordPress 国内镜像</label>
                </th>
                <td>
                    <label for="wtht_wordpres_china_mirror">
                        <?php
                        $wtht_wordpres_china_mirror = get_option('wtht_wordpres_china_mirror');
                        $checkbox = empty($wtht_wordpres_china_mirror) ? '' : 'checked';
                        echo '<input name="wtht_wordpres_china_mirror" id="wtht_wordpres_china_mirror" type="checkbox"  value="1" ' . $checkbox . ' />';
                        ?><p style="display:inline">解决 WordPress 更新 429 Too Many Requests问题，使用 WordPress 国内镜像下载更新包。</p>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="wtht_image_center">文章插入图片优化</label>
                </th>
                <td>
                    <label for="wtht_image_center">
                        <?php
                        $wtht_image_center = get_option('wtht_image_center');
                        $checkbox = empty($wtht_image_center) ? '' : 'checked';
                        echo '<input name="wtht_image_center" id="wtht_image_center" type="checkbox"  value="1" ' . $checkbox . ' />';
                        ?><p style="display:inline">文章中插入图片自动居中、链接到媒体文件、完整尺寸</p>
                    </label>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="wtht_rewrite_page_permalink">页面伪静态</label>
                </th>
                <td>
                    <label for="wtht_rewrite_page_permalink">
                        <?php
                        $wtht_rewrite_page_permalink = get_option('wtht_rewrite_page_permalink');
                        $checkbox = empty($wtht_rewrite_page_permalink) ? '' : 'checked';
                        echo '<input name="wtht_rewrite_page_permalink" id="wtht_rewrite_page_permalink" type="checkbox"  value="1" ' . $checkbox . ' />';
                        ?><p style="display:inline">后台新建的页面，访问链接后面添加.html，满足强迫症，设置后需要到<a href="options-permalink.php"
                                                                                         target="_blank">这里</a>重新保存设置
                        </p>
                    </label>
                </td>
            </tr>


        </table>
    </div>


    <?php submit_button(); ?>
    </form>


    <?php wtht_loadassets(); ?>
    <script>
        jQuery(document).ready(function ($) {
            RESPONSIVEUI.responsiveTabs();
        });
    </script>
    </div>
<?php }

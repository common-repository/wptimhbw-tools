<?php
function wtht_qiniu_cdn()
{
    function wtht_rewrite_url($html)
    {
        $domain = get_option('wtht_domain');
        $cdndomain = get_option('wtht_cdndomain');
        $exts = get_option('wtht_exts');

        $patterns[] = '/http(s|):\/\/' . str_replace('.', '\\.', $domain) . '\/wp-([^"\']*?)\.(' . $exts . ')/i';
        $replacements[] = '//' . $cdndomain . '/wp-$2.$3';
        $html = preg_replace($patterns, $replacements, $html);

        return $html;
    }

    if (!is_admin()) {
        ob_start("wtht_rewrite_url");
    }
}

add_action('init', 'wtht_qiniu_cdn');
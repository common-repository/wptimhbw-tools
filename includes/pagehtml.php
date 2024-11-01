<?php

$wtht_rewrite_page_permalink  = get_option('wtht_rewrite_page_permalink');

if($wtht_rewrite_page_permalink){
add_action('init', 'wtht_html_page_permalink', -1);
function wtht_html_page_permalink()
{
    global $wp_rewrite;
    if (!strpos($wp_rewrite->get_page_permastruct(), '.html')) {
        $wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
    }
}

}


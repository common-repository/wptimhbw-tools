<?php
add_filter('avatar_defaults', 'wtht_newgravatar');

function wtht_newgravatar($avatar_defaults)
{
    $gravatar_url = get_option('tht_gravatar_url');
    $avatar_defaults[$gravatar_url] = "网站默认头像（By timhbw工具箱）";
    return $avatar_defaults;
}

<?php


$wtht_image_center  = get_option('wtht_image_center');
if($wtht_image_center)
{

add_action('after_setup_theme', 'wtht_default_attachment_display_settings');
function wtht_default_attachment_display_settings()
{
    update_option('image_default_align', 'center');
    update_option('image_default_link_type', 'file');
    update_option('image_default_size', 'full');
}

}
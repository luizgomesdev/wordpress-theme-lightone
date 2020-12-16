<?php

function get_attachment_url_by_slug($slug)


{
    $args =  array(
        'name'           => sanitize_text_field($slug),
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'post_status'    => 'inherit',
        'posts_per_page' => 1,
    );

    $gallery = new WP_Query($args);

    if (!empty($gallery->post)) {
        return  $gallery->post->guid;
    }

    return;
}

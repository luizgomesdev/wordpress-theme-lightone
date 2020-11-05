<?php

function get_theme_post_thumbnail()
{

    if (is_singular()) {
        $content = '<figure class="post-thumbnail">';
        $content .= the_post_thumbnail('post-thumbnail', array('loading' => 'eager'));
        $content .= ' </figure>';

        return $content;
    } else {
        $content = '<figure class="post-thumbnail">';
        $content .= '<a class="post-thumbnail-anchor" href="' . the_permalink() . '" aria-hidden="true" tabindex="-1">';
        $content .= the_post_thumbnail('post-thumbnail', array('loading' => 'eager'));
        $content .= '</a>';
        $content .= '</figure>';

        return $content;
    }
}

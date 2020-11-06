<?php

function get_reading_time($post_id)
{
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $readingtime = ceil($word_count / 150);

    $totalreadingtime = $readingtime . " min";

    return $totalreadingtime;
}

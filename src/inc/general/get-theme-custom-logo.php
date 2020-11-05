<?php

function get_theme_custom_logo()
{

  if (function_exists('the_custom_logo')) {

    $content = '<figure class="custom-logo">';
    $content .=  the_custom_logo();
    $content .= ' </figure>';

    return $content;
  }
}

<?php

function register_menus()
{
  register_nav_menus(array(
    'primary' => esc_html__('Header'),
    'secondary' => esc_html__('Footer'),
  ));
}
add_action('init', 'register_menus');

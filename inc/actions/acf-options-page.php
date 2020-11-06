<?php

function my_acf_op_init()
{
    // Check function exists.
    if (function_exists('acf_add_options_page')) {

        // Register options page.
        acf_add_options_page(array(
            'page_title'    => __('Configurações do Tema'),
            'menu_title'    => __('Configurações do Tema'),
            'menu_slug'     => 'configuracoes-do-tema',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}

add_action('acf/init', 'my_acf_op_init');

<?php
function add_theme_scripts()
{
    $templateDIR  = get_template_directory_uri();

    wp_scripts();

    wp_enqueue_style('main', "{$templateDIR}/public/css/main.css", array(), '1.0', 'all');

    wp_enqueue_script("main", "{$templateDIR}/public/js/main.bundle.js", array(), 1.0, true);
    wp_script_add_data("main", "async", true);


    wp_enqueue_script("fontawesome", "https://use.fontawesome.com/releases/v5.14.0/js/all.js", array(), 1.0, true);
    wp_script_add_data("fontawesome", "async", true);
}
add_action("wp_enqueue_scripts", "add_theme_scripts");

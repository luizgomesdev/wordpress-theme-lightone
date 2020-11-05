<?php


// Desabilita widgets
function remove_widget()
{

    unregister_widget('WP_Widget_Calendar');            // Agenda
    unregister_widget('WP_Widget_Archives');            // Arquivos
    unregister_widget('WP_Widget_Links');               // Links
    unregister_widget('WP_Widget_Media_Audio');         // Audio Player Media Widget
    unregister_widget('WP_Widget_Media_Image');         // Image Media Widget
    unregister_widget('WP_Widget_Media_Video');        // Video Media Widget
    unregister_widget('WP_Widget_Media_Gallery');       // Gallery Media Widget
    unregister_widget('WP_Widget_Meta');                // Meta
    unregister_widget('WP_Widget_Pages');               // Páginas
    unregister_widget('WP_Widget_Search');              // Pesquisar
    unregister_widget('WP_Widget_Text');                // Texto
    unregister_widget('WP_Widget_Categories');          // Categorias
    unregister_widget('WP_Widget_Recent_Posts');        // Tópicos recentes
    unregister_widget('WP_Widget_Recent_Comments');     // Comentários
    unregister_widget('WP_Widget_RSS');                 // RSS
    unregister_widget('WP_Widget_Tag_Cloud');           // Nuvem de tags
    unregister_widget('WP_Nav_Menu_Widget');            // Menu personalizado
    unregister_widget('WP_Widget_Custom_HTML');         // Custom HTML Widget


}

add_action('widgets_init', 'remove_widget');

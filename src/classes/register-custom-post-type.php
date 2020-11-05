<?php

/**
 * Register custom post type
 */

class Custom_Register_Post_Type
{


    private $type_name = '';
    private $singular_name = '';
    private $args = array();
    private $labels = array();

    function __construct($type_name, $singular_name, $args = array(), $labels = array())
    {
        $this->type_name = $type_name;
        $this->singular_name = $singular_name;
        $this->args = $args;
        $this->labels = $labels;

        # Registrando o action do custom post type
        add_action('init', array($this, 'register_post_type'));
    }

    function register_post_type()
    {
        $labels = array(

            'name' => '' . $this->singular_name . 's',
            'singular_name' => '' . $this->singular_name . '',
            'menu_name' => '' . $this->singular_name . 's',
            'add_new' => 'Adicionar novo ' . strtolower($this->singular_name) . '',
            'add_new_item' => 'Adicionar novo ' . strtolower($this->singular_name) . '',
            'new_item' => 'Novo ' . strtolower($this->singular_name) . '',
            'edit_item' => 'Editar ' . strtolower($this->singular_name) . '',
            'view_item' => 'Vizualizar ' . strtolower($this->singular_name) . '',
            'all_items' => 'Todos os ' . strtolower($this->singular_name) . 's',
            'search_items' => 'Pesquisar ' . strtolower($this->singular_name) . 's',
            'not_found' => 'Nenhum ' . strtolower($this->singular_name) . ' foi encontrado',
            'not_found_in_trash' => 'Nenhum ' . strtolower($this->singular_name) . ' encontrado na lixeira',
            'featured_image' => 'Imagem destacada',
            'set_freatured_image' => 'Escolher como imagem destacada',
            'remove_featured_image' => 'Remover imagem destacada',
            'use_freatured_image' => 'Usar como imagem descatada'

        );

        $labels = array_merge($labels, $this->labels);

        $args = array(
            #parametros Básicos
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'rewrite' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability' => 'post',
            'has_archive' => false,
            'hierachical' => true,
            'menu_position' => null,
            'menu_icon' => 'dashicons-admin-generic',
            'supports' => array('title', 'editor',  'thumbnail')
        );

        $args = array_merge($args, $this->args);

        register_post_type($this->type_name, $args);
        flush_rewrite_rules();
    }
}


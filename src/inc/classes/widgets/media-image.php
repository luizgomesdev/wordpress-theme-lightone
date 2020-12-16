<?php

class Image_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct('media-image', 'Imagem', array(
            'classname' => 'custom-media-image',
            'description' => 'Imagens'
        ));
    }

    public function widget($args, $instance)
    {

        $title = null;
        $url_imagem = null;
        $url_anchor = null;

        if (!empty($instance['title'])) {
            $title = apply_filters('widget_title', $instance['title']);
        }
        if (!empty($instance['url_imagem'])) {
            $url_imagem = $instance['url_imagem'];
        }
        if (!empty($instance['url_anchor'])) {
            $url_anchor = $instance['url_anchor'];
        }


        $content = $args['before_widget'];

        // if (!empty($title)) {

        //     $content = '<div class="content">';
        //     $content .=  $args['before_title'];
        //     $content .= $title;
        //     $content .= $args['after_title'];
        //     $content .= "</div>";
        //     $content .= "<hr>";

        //     echo $content;
        // }

        $content .= " <a href='{$url_anchor}' target='_blank' rel='noopener noreferrer'>";
        $content .= "<figure class='image my-6'>";
        $content .= "<img src='{$url_imagem}' title='{$title}' alt='{$title}' style='object-fit: cover;'>";
        $content .= "</figure>";
        $content .= "</a>";

        $content .=  $args['after_widget'];

        echo $content;
    }

    public function form($instance)
    {

        $title = isset($instance['title']) ?  $instance['title'] : 'Imagem';
        $url_imagem = isset($instance['url_imagem']) ?  $instance['url_imagem'] : '#';
        $url_anchor = isset($instance['url_anchor']) ?  $instance['url_anchor'] : '#';

        $content = "<p>";
        $content .= "<label for='{$this->get_field_id('title')}'>Título:</label>";
        $content .= "<input id='{$this->get_field_id('title')}' class='widefat' type='text' name='{$this->get_field_name('title')}' value='{$title}'>";
        $content .= "</p>";

        $content .= "<p>";
        $content .= "<label for='{$this->get_field_id('url_imagem')}'>Url da imagem:</label>";
        $content .= "<input id='{$this->get_field_id('url_imagem')}' class='widefat' type='text' name='{$this->get_field_name('url_imagem')}' value='{$url_imagem}'>";
        $content .= "</p>";

        $content .= "<p>";
        $content .= "<label for='{$this->get_field_id('url_anchor')}'>Url de destino:</label>";
        $content .= "<input id='{$this->get_field_id('url_anchor')}' class='widefat' type='text' name='{$this->get_field_name('url_anchor')}' value='{$url_anchor}'>";
        $content .= "</p>";

        echo $content;
    }

    public function update($new_instance, $old_instance)
    {

        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['url_imagem'] = (!empty($new_instance['url_imagem'])) ? strip_tags($new_instance['url_imagem']) : '';
        $instance['url_anchor'] = (!empty($new_instance['url_anchor'])) ? strip_tags($new_instance['url_anchor']) : '';
        return $instance;
    }
}

function register_custom_image_widget()
{
    register_widget('Image_Widget');
}
add_action('widgets_init', 'register_custom_image_widget');

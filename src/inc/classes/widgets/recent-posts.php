<?php

class Recent_Posts_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('recent-posts', 'Posts Recentes', array(
            'classname' => 'custom-recent-posts',
            'description' => 'Posts recentes com thumbnails'
        ));
    }

    public function widget($args, $instance)
    {
        global $post;
        $currentPostID = get_the_ID();

        $title = null;

        if (!empty($instance['title'])) {
            $title = apply_filters('widget_title', $instance['title']);
        }

        $query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 6,
        ));

        echo $args['before_widget'];

        if (!empty($title)) {


            $content = '<div class="content">';
            $content .=  $args['before_title'];
            $content .= $title;
            $content .= $args['after_title'];
            $content .= "</div>";
            $content .= "<hr>";

            echo $content;
        }

        if ($query->have_posts()) {
            while ($query->have_posts()) {

                $query->the_post();

                if ($post->ID !== $currentPostID) {

                    $content = "<a href=" . get_the_permalink() . " target='_blank'>";
                    $content .= "<article class='media mb-3'>";

                    $content .= "<figure class='media-left ml-0'>";
                    $content .= "<p class='image is-64x64'>";
                    if (has_post_thumbnail()) {
                        $content .=  get_the_post_thumbnail($post->ID, 'thumbnail', array('title' => get_the_title(), 'alt'   => get_the_title(), 'style' => 'object-fit: cover;'));
                    } else {
                        $content .= " <img loading='auto' src=" . get_template_directory_uri() . '/public/img/erros/sem-imagem.webp' . " alt='Imagem vazia'>";
                    }
                    $content .= "</p>";
                    $content .= "</figure>";

                    $content .= "<div class='media-content'>";
                    $content .= "<div class='content'>";
                    $content .= "<p class='mb-0'>" . get_the_date() . "</p>";
                    $content .= "<h2 class='is-size-6 mt-0'>" . get_the_title() . "</h2>";
                    $content .= "</div>";
                    $content .= "</div>";
                    $content .= "</article>";
                    $content .= "</a>";

                    echo $content;
                }
            }
            wp_reset_postdata();
        } else {
            _e('Sorry, no posts matched your criteria.');
        }

        $content .=  $args['after_widget'];
    }


    public function form($instance)
    {
        $title = isset($instance['title']) ?  $instance['title'] : 'Últimos';

        $content = "<p>";
        $content .= "<label for='{$this->get_field_id('title')}'>Título:</label>";
        $content .= "<input id='{$this->get_field_id('title')}' class='widefat' type='text' name='{$this->get_field_name('title')}' value='{$title}'>";
        $content .= "</p>";

        echo $content;
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}


function register_custom_recent_post_widget()
{
    register_widget('Recent_Posts_Widget');
}
add_action('widgets_init', 'register_custom_recent_post_widget');

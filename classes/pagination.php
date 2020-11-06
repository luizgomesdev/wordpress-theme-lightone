<?php
/*
Class Name: bulma_pagination
Description: Custom pagination using Bulma components (tested with Bulma 0.6.2 on Wordpress 4.9.4)
Version: 0.2
Author: Domenico Majorana
*/


function pagination($query)
{

    $big = 999999999; //I trust StackOverflow.
    $total_pages = $query->max_num_pages; //you can set a custom int value to this var
    $pages = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $total_pages,
        'prev_next' => false,
        'type'  => 'array',
        'prev_next'   => true,
        'prev_text'    => __('Previous', 'text-domain'),
        'next_text'    => __('Next', 'text-domain'),
    ));

    if (is_array($pages)) {
        $content = null;

        //Get current page
        $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');

        //Disable Previous button if the current page is the first one
        if ($paged == 1) {
            $content .= '<a class="pagination-previous" disabled>Previous</a>';
        } else {
            $content .= '<a class="pagination-previous" href="' . get_previous_posts_page_link() . '">Previous</a>';
        }

        //Disable Next button if the current page is the last one
        if ($paged < $total_pages) {
            $content .= '<a class="pagination-next" href="' . get_next_posts_page_link() . '">Next</a>';
            $content .= '<ul class="pagination-list">';
        } else {
            $content .= '<a class="pagination-next" disabled>Next</a>';
            $content .= '<ul class="pagination-list">';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $paged) {
                $content .= '<li><a class="pagination-link is-current" href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
            } else {
                $content .= '<li><a class="pagination-link" href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
            }
        }

        $content .= '</ul>';

        echo $content;
    }
}

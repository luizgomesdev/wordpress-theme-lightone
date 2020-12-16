<?php

function tbdn_get_page_template()
{
    $id = get_queried_object_id();
    $template = get_page_template_slug();
    $pagename = get_query_var('pagename');

    if (!$pagename && $id) {
        // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
        $post = get_queried_object();
        if ($post)
            $pagename = $post->post_name;
    }

    $templates = array();

    if ($template && 0 === validate_file($template))
        $templates[] = $template;
    // if there's a custom template then still give that priority

    if ($pagename)
        $templates[] = "pages/$pagename.php";
    // change the default search for the page-$slug template to use our directory
    // you could also look in the theme root directory either before or after this

    if ($id)
        $templates[] = "pages/$id.php";

    $templates[] = 'page.php';

    /* Don't call get_query_template again!!!
       // return get_query_template( 'page', $templates );
       We also reproduce the key code of get_query_template() - we don't want to call it or we'll get stuck in a loop .
       We can remove lines of code that we know won't apply for pages, leaving us with...
    */

    $template = locate_template($templates);


    return $template;
}

add_filter('page_template', 'tbdn_get_page_template');

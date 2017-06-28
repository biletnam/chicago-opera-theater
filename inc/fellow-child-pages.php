<?php
/**
 * Returns a JSON array of all fellow child pages of the parent page
 *
 * @package Chicago_Opera_Theater
 */

function get_fellow_child_pages()
{
    global $post;
    $pages = get_pages(
    array(
      'parent' => $post->post_parent,
      'hierarchical' => 0
      )
    );

    $array = array();

    foreach ($pages as $page) {
        if ($page->post_status === 'publish') {
            $page_details = array(
              'title' => $page->post_title,
              'url' => get_page_link($page->ID)
            );
            array_push($array, $page_details);
        }
    }
    echo json_encode($array, JSON_HEX_APOS);
}

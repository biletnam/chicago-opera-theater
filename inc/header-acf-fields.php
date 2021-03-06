<?php
/**
 * Custom AdvancedCustomFields serializers for this theme.
 *
 * @package Chicago_Opera_Theater
 */

function get_acf_fields($id)
{
    $fields = get_fields($id);
    if (! $fields) {
        $fields = array();
    }
    echo json_encode($fields, JSON_HEX_APOS);
}

function get_acf_header_images()
{
    global $post;
    $post_id = $post->ID;

    $obj = (object) array(
      'desktop_image' => get_field('desktop_image', $post_id),
      'tablet_image' => get_field('tablet_image', $post_id),
      'mobile_image' => get_field('mobile_image', $post_id),
    );

    return $obj;
}

function get_acf_header_carousel()
{
    global $post;
    $carousel = get_field('header_carousel', $post->ID);

    echo json_encode($carousel, JSON_HEX_APOS);
}

function get_acf_header_text_color()
{
    global $post;
    $post_id = $post->ID;

    echo get_field('header_text_color', $post_id);
}

function get_acf_header_mask_color()
{
    global $post;
    $post_id = $post->ID;

    echo get_field('mask_color', $post_id);
}

function get_acf_header_titles()
{
    global $post;
    $post_id = $post->ID;

    $obj = (object) array(
      'title' => get_field('title', $post_id),
      'subtitle' => get_field('subtitle', $post_id),
      'subsubtitle' => get_field('subsubtitle', $post_id),
      'header_text' => get_field('header_text', $post_id)
    );

    echo json_encode($obj, JSON_HEX_APOS);
}

function get_acf_header_links()
{
    global $post;
    $post_id = $post->ID;

    $links = get_field('links', $post_id);

    if ($links) {
        echo json_encode($links, JSON_HEX_APOS);
    } else {
        echo json_encode(array());
    }
}

function get_acf_header_primary_link()
{
    global $post;
    $post_id = $post->ID;

    $link = get_field('primary_link', $post_id);

    echo $link;
}

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
    global $wp_query;
    $post_id = $wp_query->get_queried_object_id();

    $obj = (object) array(
      'desktop_image' => get_field('desktop_image', $post_id),
      'tablet_image' => get_field('tablet_image', $post_id),
      'mobile_image' => get_field('mobile_image', $post_id),
    );

    echo json_encode($obj, JSON_HEX_APOS);
}

function get_acf_header_titles()
{
    global $wp_query;
    $post_id = $wp_query->get_queried_object_id();

    $obj = (object) array(
      'title' => get_field('title', $post_id),
      'subtitle' => get_field('subtitle', $post_id),
      'subsubtitle' => get_field('subsubtitle', $post_id),
    );

    echo json_encode($obj, JSON_HEX_APOS);
}

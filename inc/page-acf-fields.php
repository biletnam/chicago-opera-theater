<?php
/**
 * Returns specific fields for pages
 *
 * @package Chicago_Opera_Theater
 */

 function get_acf_sidebar_title()
 {
     global $post;
     $parent = $post->post_parent;
     echo get_field('sidebar_title', $parent);
 }

 function get_acf_events()
 {
     global $post;
     $events = get_field('events', $post->ID);

     echo json_encode($events, JSON_HEX_APOS);
 }

 function get_acf_header_carousel()
 {
     global $post;
     $carousel = get_field('header_carousel', $post->ID);

     echo json_encode($carousel, JSON_HEX_APOS);
 }

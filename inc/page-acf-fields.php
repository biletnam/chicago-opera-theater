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

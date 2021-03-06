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

function get_acf_show_details()
{
    global $post;
    $obj = array();
    $obj['performances'] = get_field('performances', $post->ID);
    $obj['ticket_link'] = get_field('ticket_link', $post->ID);
    $obj['map_link'] = get_field('map_link', $post->ID);
    $obj['venue'] = get_field('venue', $post->ID);
    $obj['duration_and_language'] = get_field('duration_and_language', $post->ID);

    echo json_encode($obj, JSON_HEX_APOS);
}

function get_acf_show_content()
{
    global $post;
    $content = get_field('content_tabs', $post->ID);

    echo json_encode($content, JSON_HEX_APOS);
}

function get_acf_subscription_content()
{
    global $post;
    $obj = array();
    $obj['available'] = get_field('subscriptions_available', $post->ID);
    $obj['apology_message'] = get_field('apology_message', $post->ID);
    $obj['productions'] = get_field('productions', $post->ID);
    $obj['price_zones'] = get_field('price_zones', $post->ID);
    $obj['price_zone_images'] = get_field('price_zone_images', $post->ID);
    $obj['hear_about_options'] = get_field('hear_about', $post->ID);
    $obj['has_fee'] = get_field('has_fee', $post->ID);
    $obj['fee_amount'] = get_field('fee_amount', $post->ID);
    $obj['authorize'] = get_cot_authorize_custom_settings();
    $obj['thank_you_message'] = get_field('thank_you_message', $post->ID);

    echo json_encode($obj, JSON_HEX_APOS);
}

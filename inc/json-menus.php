<?php
/**
 * Custom menus for this theme.
 *
 * Registers both the header and footer menus, also serializes them to JSON
 * for Vue
 *
 * @package Chicago_Opera_Theater
 */

function get_json_header_menu()
{
    $locations = get_nav_menu_locations();
    echo json_encode(get_json_menu($locations['header-menu']));
}

function get_json_footer_menu()
{
    $locations = get_nav_menu_locations();
    echo json_encode(get_json_menu($locations['footer-menu']));
}

function get_json_menu($location)
{
    $wp_menu = wp_get_nav_menu_object($location);
    $menu_items = wp_get_nav_menu_items($wp_menu->term_id);
    $rev_items = array_reverse($menu_items);
    $rev_menu  = array();
    $cache     = array();
    foreach ($rev_items as $item) :
      $formatted = array(
        'ID'          => abs($item->ID),
        'order'       => (int) $item->menu_order,
        'parent'      => abs($item->menu_item_parent),
        'title'       => $item->title,
        'url'         => $item->url,
        'attr'        => $item->attr_title,
        'target'      => $item->target,
        'classes'     => implode(' ', $item->classes),
        'xfn'         => $item->xfn,
        'description' => $item->description,
        'object_id'   => abs($item->object_id),
        'object'      => $item->object,
        'type'        => $item->type,
        'type_label'  => $item->type_label,
        'children'    => array(),
      );
    if (array_key_exists($item->ID, $cache)) {
        $formatted['children'] = array_reverse($cache[ $item->ID ]);
    }
    $formatted = apply_filters('rest_menus_format_menu_item', $formatted);
    if ($item->menu_item_parent != 0) {
        if (array_key_exists($item->menu_item_parent, $cache)) {
            array_push($cache[ $item->menu_item_parent ], $formatted);
        } else {
            $cache[ $item->menu_item_parent ] = array( $formatted, );
        }
    } else {
        array_push($rev_menu, $formatted);
    }
    endforeach;
    return array_reverse($rev_menu);
}

function register_header_menu()
{
    register_nav_menu('header-menu', __('Header Menu'));
}
add_action('init', 'register_header_menu');

function register_footer_menu()
{
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'register_footer_menu');

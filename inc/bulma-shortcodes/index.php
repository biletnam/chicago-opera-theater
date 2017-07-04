<?php
/**
 * Plugin Name: Bulma Shortcodes
 * Description: Adds bulma-based shortcodes to editor
 * Author: Joshua Bartlett
*/

require dirname(__FILE__) . '/functions.php';

/**
 * Creates the tag <div class="columns"></div>
*/

function sColumns($atts, $content = null)
{
    extract(shortcode_atts(array(), $atts));
    return '<div class="columns">'.do_shortcode($content).'</div>';
}

add_shortcode('columns', 'sColumns');
add_shortcode('columns-1', 'sColumns');
add_shortcode('columns-2', 'sColumns');
add_shortcode('columns-3', 'sColumns');
add_shortcode('columns-4', 'sColumns');

/**
 * Creates the tag <div class="column"></div>
*/

function sColumn($atts, $content = null)
{
    extract(shortcode_atts(array('type' => ''), $atts));
    return '<div class="column content '.$type.'">'.do_shortcode($content).'</div>';
}

add_shortcode('column', 'sColumn');
add_shortcode('column-1', 'sColumn');
add_shortcode('column-2', 'sColumn');
add_shortcode('column-3', 'sColumn');
add_shortcode('column-4', 'sColumn');

/**
 * Creates the tag <a class="button" role="button"></a>
*/

function sButton($atts, $content = null)
{
    extract(shortcode_atts(array('link' => '#', 'class' => 'is-primary'), $atts));
    if (! empty($atts['icon'])):
     return '<a class="button ' . $class . '" href="'.$link.'" role="button"><span class="icon"><i class="fa fa-' . $atts['icon'] . '"></i></span><span>' . do_shortcode($content) . '</span></a>'; else:
     return '<a class="button ' . $class . '" href="'.$link.'" role="button"><span>' . do_shortcode($content) . '</span></a>';
    endif;
}

add_shortcode('button', 'sButton');

/**
 * Creates the tag <div class="box"></div>
*/

function sBox($atts, $content = null)
{
    return '<div class="box-custom">'.do_shortcode($content).'</div>';
}

add_shortcode('box', 'sBox');

/**
 * Creates the tag <div class="notification"></div>
*/

function sNotification($atts, $content = null)
{
    extract(shortcode_atts(array('type' => 'is-primary'), $atts));
    return '<div class="notification '.$type.'">'.do_shortcode($content).'</div>';
}

add_shortcode('notification', 'sNotification');

/**
 * Creates the tag <div class="card"></div>
*/

function sCard($atts, $content = null)
{
    return '<div class="card">'.do_shortcode($content).'</div>';
}

add_shortcode('card', 'sCard');

/**
 * Creates the tag <header class="card-header"><h4 class="card-header-title"></h4></header>
*/

function sCardHeader($atts, $content = null)
{
    extract(shortcode_atts(array(), $atts));
    return '<header class="card-header"><h4 class="card-header-title is-marginless">'.do_shortcode($content).'</h4></header>';
}

add_shortcode('card-header', 'sCardHeader');

/**
 * Creates the tag <div class="card-content"></div>
*/

function sCardContent($atts, $content = null)
{
    extract(shortcode_atts(array(), $atts));
    return '<div class="card-content content">'.do_shortcode($content).'</div>';
}

add_shortcode('card-content', 'sCardContent');

/**
 * Creates the tag <footer class="card-footer"></footer>
*/

function sCardFooter($atts, $content = null)
{
    $parsed_content = do_shortcode($content);
    extract(shortcode_atts(array(), $atts));
    if (strpos($parsed_content, '<a') !== false) {
        $atemplate = "
        <a href='$1' class='has-arrow-icon'>
          $2
          <span class='icon'>
            <i class='fa fa-arrow-right'></i>
          </span>
        </a>";

        $parsed_content = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', $atemplate, $parsed_content);
    }

    $footer_item_array = split_at_bar($parsed_content);
    $concatenated_content = '';

    foreach ($footer_item_array as $item) {
        $string = '<div class="card-footer-item">'.$item.'</div>';
        $concatenated_content .= $string;
    }

    return '<footer class="card-footer">'.$concatenated_content.'</footer>';
}

add_shortcode('card-footer', 'sCardFooter');

/**
 * Creates the tag <span class="icon"><i class="fa fa-icon"></i></span>
*/

function sIcon($atts, $content = null)
{
    extract(shortcode_atts(array('name' => '', 'type'=>''), $atts));
    return '<span class="icon '.$type.'"><i class="fa fa-'.$name.'"></i></span>';
}

add_shortcode('icon', 'sIcon');

/**
 * Creates the tag <aside class="menu"></aside>
*/

function sMenu($atts, $content = null)
{
    return '<aside class="menu">'.do_shortcode($content).'</aside>';
}

add_shortcode('menu', 'sMenu');

/**
 * Creates the tag <p class="menu-label"></p>
*/

function sMenuLabel($atts, $content = null)
{
    return '<p class="menu-label">'.do_shortcode($content).'</p>';
}

add_shortcode('menu-label', 'sMenuLabel');

/**
 * Creates the tag <footer class="card-footer"></footer>
*/

function sMenuList($atts, $content = null)
{
    $parsed_content = do_shortcode($content);
    extract(shortcode_atts(array(), $atts));

    $menu_item_array = split_at_bar($parsed_content);
    $concatenated_content = '';

    foreach ($menu_item_array as $item) {
        $string = '<li>'.$item.'</li>';
        $concatenated_content .= $string;
    }

    return '<ul class="menu-list">'.$concatenated_content.'</ul>';
}

add_shortcode('menu-list', 'sMenuList');

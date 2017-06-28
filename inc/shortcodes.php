<?php
/**
 * Registers new shortcodes
 *
 * @package Chicago_Opera_Theater
 */

 function sButton($atts, $content = null)
 {
     extract(shortcode_atts(array('link' => '#', 'class' => 'is-primary'), $atts));
     if (! empty($atts['icon'])):
       return '<a class="button ' . $class . '" href="'.$link.'"><span class="icon"><i class="fa fa-' . $atts['icon'] . '"></i></span><span>' . do_shortcode($content) . '</span></a>'; else:
       return '<a class="button ' . $class . '" href="'.$link.'"><span>' . do_shortcode($content) . '</span></a>';
     endif;
 }

 add_shortcode('button', 'sButton');

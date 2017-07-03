<?php

/**
 * Plugin Name: Visual Editor Buttons
 * Description: Adds shortcode buttons to visual editor.
 * Author: Joshua Bartlett
*/


function enqueue_plugin_scripts($plugin_array)
{
    //enqueue TinyMCE plugin script with its ID.
    $plugin_array["button_shortcode_plugin"] = get_template_directory_uri() . "/inc/visual-editor-buttons/index.js";
    return $plugin_array;
}

add_filter("mce_external_plugins", "enqueue_plugin_scripts");

function register_buttons_editor($buttons)
{
    //register buttons with their id.
    array_push($buttons, "shortcode_button");
    return $buttons;
}

add_filter("mce_buttons", "register_buttons_editor");

/**
 * Registers an editor stylesheet for the theme.
 */

 add_action('admin_head-post.php', function () {
     ?>
     <style>
     @import url('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
     .mce-ico.mce-i-fa {
         display: inline-block;
         font: normal normal normal 14px/1 FontAwesome;
         font-size: inherit;
         text-rendering: auto;
         -webkit-font-smoothing: antialiased;
         -moz-osx-font-smoothing: grayscale;
     }
     </style>
     <?php

 });

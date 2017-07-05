<?php
/**
 * Chicago Opera Theater functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Chicago_Opera_Theater
 */

if (! function_exists('chicago_opera_theater_setup')) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function chicago_opera_theater_setup()
{
    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
}
endif;

add_action('after_setup_theme', 'chicago_opera_theater_setup');

/**
 * Turn off TablePress hard-coded css
 */

add_filter('tablepress_use_default_css', '__return_false');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function chicago_opera_theater_content_width()
{
    $GLOBALS['content_width'] = apply_filters('chicago_opera_theater_content_width', 640);
}
add_action('after_setup_theme', 'chicago_opera_theater_content_width', 0);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom menu functions for this theme.
 */
require get_template_directory() . '/inc/json-menus.php';

/**
 * Custom header functions for this theme.
 */
require get_template_directory() . '/inc/header-acf-fields.php';

/**
 * Custom function to return child pages
 */
require get_template_directory() . '/inc/fellow-child-pages.php';

/**
 * Custom page ACF serializers
 */
require get_template_directory() . '/inc/page-acf-fields.php';

/**
 * Hide editor on home page
 */
require get_template_directory() . '/inc/hide-content-editor-home.php';

/**
 * Stop hardcoding image sizes
 */
require get_template_directory() . '/inc/remove-image-hardcodes.php';

/**
 * Prevent a Google Maps issue in ACF
 */
function my_acf_init()
{
    acf_update_setting('google_api_key', 'AIzaSyCGdjjfkBYuZk3gcYd1ECkkX9NO91S4lWw');
}
add_action('acf/init', 'my_acf_init');

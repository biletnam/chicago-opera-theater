<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until </header>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Chicago_Opera_Theater
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet"/>
<?php wp_head(); ?>
</head>

<body>
<nav id="navigation" data='{"links": <?php get_json_header_menu() ?>, "image": "<?php echo get_template_directory_uri() ?>/static/assets/cot-logo.png"}'></nav>
<header id="masthead" data='{"images": <?php get_acf_header_images() ?>, "titles": <?php get_acf_header_titles() ?>}'></header>

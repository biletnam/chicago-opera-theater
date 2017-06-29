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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet"/>
<?php wp_head(); ?>
</head>

<body>
<nav id="navigation" data='{"links": <?php get_json_header_menu() ?>, "image": "<?php echo get_template_directory_uri() ?>/static/assets/cot-logo.png"}'></nav>
<?php if (is_front_page()) : ?>
  <header id="header-carousel" data='{"panels": <?php get_acf_header_carousel(); ?>}'></header>
<?php
    else:
      $header_images = get_acf_header_images();
      if (! empty($header_images->desktop_image) && ! empty($header_images->tablet_image) && ! empty($header_images->mobile_image)) : ?>
        <header id="masthead" data='{"images": <?php echo json_encode($header_images, JSON_HEX_APOS); ?>, "titles": <?php get_acf_header_titles(); ?>, "text_color": "<?php get_acf_header_text_color() ?>", "mask_color": "<?php get_acf_header_mask_color() ?>"}'></header>
    <?php endif; ?>
<?php endif ?>

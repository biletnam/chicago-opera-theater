<?php
/**
 * Template Name: Show Template
 *
 * The template for displaying show pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Chicago_Opera_Theater
 */

get_header(); ?>

<main id="main" class="section" role="main">
	<div class="container">
		<div class="columns reverse-row-order">
			<?php get_template_part('template-parts/show-sidebar'); ?>
			<article id="show-content" data='{"tabs": <?php get_acf_show_content() ?>}'></article>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();

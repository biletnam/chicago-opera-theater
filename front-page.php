<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Chicago_Opera_Theater
 */

get_header(); ?>

		<main id="main" class="container" role="main">
			<div class="columns">
				<article class="column is-8"></article>
				<?php get_template_part('template-parts/links-sidebar', get_post_format()); ?>
			</div>
		</main><!-- #main -->

<?php
get_footer();

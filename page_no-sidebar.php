<?php
/**
 * Template Name: No Sidebar Template
 *
 * The template for displaying top-level pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Chicago_Opera_Theater
 */

get_header(); ?>

<main id="main" class="section" role="main">
	<div class="container">
		<div class="columns">
			<?php while (have_posts()) : the_post(); ?>
				<article class="column content">
					<?php the_content(); ?>
				</article>
			<?php endwhile ?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();

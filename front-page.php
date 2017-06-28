<?php
/**
 * The template for the home page of the site
 *
 * @package Chicago_Opera_Theater
 */

get_header(); ?>

<main id="main" class="section" role="main">
	<div class="container">
		<div class="columns">
			<article class="column is-8"></article>
			<?php get_template_part('template-parts/events-sidebar'); ?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();

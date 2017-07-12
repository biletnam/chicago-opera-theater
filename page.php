<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
				<?php if ( ! is_page('subscriptions') ): ?>
					<article class="column is-8 content">
						<?php the_content(); ?>
					</article>
				<?php else: ?>
					<article class="column is-8" id="subscriptions" data='<?php get_acf_subscription_content() ?>'></article>
				<?php endif; ?>
			<?php endwhile ?>
			<?php get_template_part('template-parts/links-sidebar'); ?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();

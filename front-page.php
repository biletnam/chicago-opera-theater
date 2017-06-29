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
			<article class="column is-8">
				<?php
          while (have_posts()) : the_post();
              $preview_sets = get_field('content_previews');
              foreach ($preview_sets as $preview_set) {
                  set_query_var("preview_set", $preview_set);
                  get_template_part('template-parts/home/'.$preview_set['acf_fc_layout']);
              }
          endwhile;
        ?>
			</article>
			<?php get_template_part('template-parts/events-sidebar'); ?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();

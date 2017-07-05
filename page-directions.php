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

<style type="text/css">

.acf-map {
	width: 100%;
	height: 400px;
	border: #ccc solid 1px;
	margin: 20px 0;
}

/* fixes potential theme css conflict */
.acf-map img {
   max-width: inherit !important;
}

</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGdjjfkBYuZk3gcYd1ECkkX9NO91S4lWw"></script>

<main id="main" class="section" role="main">
	<?php while (have_posts()) : the_post(); ?>
		<div class="section">
			<article class="content">
				<?php the_content(); ?>

			<?php
        $locations = get_field('directions');
        foreach ($locations as $location):
        ?>
				<h3><?php echo $location['name'] ?></h3>
				<div class="acf-map">
					<div class="marker" data-lat="<?php echo $location['map']['lat']; ?>" data-lng="<?php echo $location['map']['lng']; ?>">
						<h4><?php echo $location['name'] ?></h4>
						<p class="address"><?php echo $location['map']['address']; ?></p>
					</div>
				</div>
			<?php endforeach; ?>
			</article>
		</div><!-- .section -->
	<?php endwhile; ?>
</main><!-- #main -->

<?php
get_footer();

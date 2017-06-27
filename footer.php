<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Chicago_Opera_Theater
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url(__('https://wordpress.org/', 'chicago-opera-theater')); ?>"><?php printf(esc_html__('Proudly powered by %s', 'chicago-opera-theater'), 'WordPress'); ?></a>
			<span class="sep"> | </span>
			<?php printf(esc_html__('Theme: %1$s by %2$s.', 'chicago-opera-theater'), 'chicago-opera-theater', '<a href="https://automattic.com/" rel="designer">Joshua Bartlett</a>'); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/javascript/script.js"></script>
<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * The template for displaying the footer
 *
 * Contains all content after the main content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Chicago_Opera_Theater
 */

?>

<footer id="footer" data='{"links": <?php get_json_footer_menu() ?>, "image": "<?php echo get_template_directory_uri() ?>/static/assets/cot-logo.png"}'></footer>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/javascript/script.js"></script>
<!-- TODO: REMOVE THIS -->
<script src="http://localhost:35729/livereload.js"></script>
<?php wp_footer(); ?>

</body>
</html>

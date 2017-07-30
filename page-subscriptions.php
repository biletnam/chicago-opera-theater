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
        <article class="column is-8" id="subscriptions" data='<?php get_acf_subscription_content() ?>'></article>
      <?php endwhile ?>
      <?php get_template_part('template-parts/links-sidebar'); ?>
    </div>
  </div>
</main><!-- #main -->

<?php if (get_option('cot_authorize_testing')) : ?>
    <script type="text/javascript" src="https://jstest.authorize.net/v1/Accept.js" charset="utf-8"></script>
<?php else : ?>
    <script type="text/javascript" src="https://js.authorize.net/v1/Accept.js" charset="utf-8"></script>
<?php
endif;
get_footer();

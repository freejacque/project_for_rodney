<?php
/**
 * The template for displaying all pages.
 *
 * @package Kick-Punch-Block
 * @since Kick-Punch-Block 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
  <div id="content" class="site-content" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', 'page' ); ?>

      <?php comments_template( '', true ); ?>

    <?php endwhile; ?>

  </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

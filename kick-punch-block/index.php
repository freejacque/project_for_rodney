<?php
/**
 * The main template file.
 *
 * This is used to display a page when nothing more specific matches a query.
 *
 * @package Kick-Punch-Block
 * @since Kick-Punch-Block 1.0
 */
get_header(); ?>

<div id="primary" class="content-area">
  <div id="content" class="site-content" role="main">
    <?php if ( have_posts() ) : ?>
      <?php ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content' , get_post_format() ); ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

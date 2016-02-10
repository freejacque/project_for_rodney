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
    <?php /* Start the loop */ ?>
    <?php while( have_posts()) : the_post(); ?>
      <div class="entry-summary">
        <?php the_excerpt(); ?>
      </div>
        <?php /* the_content(); */ ?>
    <?php endwhile; ?>
  </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

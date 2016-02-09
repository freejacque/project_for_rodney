<?php
/**
 * The main template file.
 *
 * This is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kick-Punch-Block
 * @since Kick-Punch-Block 1.0
 */
get_header(); ?>

<div id="primary" class="content-area">
  <div id="content" class="site-content" role="main">
  </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

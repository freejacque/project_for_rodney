<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Kick-Punch-Block
 * @since Kick-Punch-Block 1.0
 */

get_header(); ?>

        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php shape_content_nav( 'nav-above' ); ?>

                <?php get_template_part( 'content', 'single' ); ?>

                <?php shape_content_nav( 'nav-below' ); ?>

                <!--  if comments are open or there is 1+ comment load the comment template -->
                <?php if ( comments_open() || '0' != get_comments_number() )
                    comments_template( '', true );
                ?>

            <?php endwhile; ?>

            </div>
        </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
/**
* The template for displaying Archive pages.
*
* @package Kick-Punch-Block
* @since Kick-Punch-Block 1.0
*/

get_header(); ?>

<section id="primary" class="content-area">
<div id="content" class="site-content" role="main">

<?php if ( have_posts() ) : ?>

<header class="page-header">
    <h1 class="page-title">
        <?php
            if ( is_category() ) {
                printf( __( 'Category Archives: %s', 'kpb' ), '<span>' . single_cat_title( '', false ) . '</span>' );

            } elseif ( is_tag() ) {
                printf( __( 'Tag Archives: %s', 'kpb' ), '<span>' . single_tag_title( '', false ) . '</span>' );

            } elseif ( is_author() ) {
                //Queue the first post
                the_post();
                printf( __( 'Author Archives: %s', 'kpb' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
                // go back to the beginning of the loop
                rewind_posts();

            } elseif ( is_day() ) {
                printf( __( 'Daily Archives: %s', 'kpb' ), '<span>' . get_the_date() . '</span>' );

            } elseif ( is_month() ) {
                printf( __( 'Monthly Archives: %s', 'kpb' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

            } elseif ( is_year() ) {
                printf( __( 'Yearly Archives: %s', 'kpb' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

            } else {
                _e( 'Archives', 'kpb' );

            }
        ?>
    </h1>
    <?php
        if ( is_category() ) {
            // show an optional category description
            $category_description = category_description();
            if ( ! empty( $category_description ) )
                echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

        } elseif ( is_tag() ) {
            // show an optional tag description
            $tag_description = tag_description();
            if ( ! empty( $tag_description ) )
                echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
        }
    ?>
</header>

<?php kpb_content_nav( 'nav-above' ); ?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
    <!-- include the post format template for the content -->
    <?php get_template_part( 'content', get_post_format() ); ?>

<?php endwhile; ?>

<?php kpb_content_nav( 'nav-below' ); ?>

<?php else : ?>

<?php get_template_part( 'no-results', 'archive' ); ?>

<?php endif; ?>

</div>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

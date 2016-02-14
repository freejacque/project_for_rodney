<?php
/*
 * Custome template tags for KPB theme.
 * some of the functionality here may be replaced by core functions
 *
 * @package Kick-Punch-Block
 * @since  Kick-Punch-Block 1.0
 */

if( ! function_exists( 'kpb_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Kick-Punch-Block 1.0
 */
function kpb_posted_on() {
  printf( __( 'Posted on <a href="%1$" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'kpb' ),
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( __( 'View all posts by %s', 'kpb' ), get_the_author() ) ),
    esc_html( get_the_author() )
  );
}
endif;

/**
 * Returns true if a blog has > 1 category
 * @since Kick-Punch-Block 1.0
 */
function kpb_categorized_blog() {
  if (false === ( $all_the_categories = get_transient( 'all_the_categories' ) ) ) {
    // create an array of all the categories attached to posts
    $all_the_categories = get_categories( array( 'hide_empty' => 1, ) );

    // count the categories
    $all_the_categories = count( $all_the_categories );
    set_transient( 'all_the_categories', $all_the_categories );
  }

  if ( '1' != $all_the_categories ) {
    //  if there is > 1 category return true
    return true;
  } else {
    return false;
  }
}

/**
 * Flush the transients used in kpb_categorized_blog
 * @since Kick-Punch-Block 1.0
 */
function kpb_category_transient_flusher() {
  delete_transient( 'all_the_categories' );
}
add_action( 'edit_category', 'kpb_category_transient_flusher' );
add_action( 'save_post', 'kpb_category_transient_flusher' );

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


if ( ! function_exits( 'kpb_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 * @since Kick-Punch-Block 1.0
 */
function kpb_content_nav( $nav_id ) {
  global $wp_query, $post;

  //  don't show on single pages if there is nowhere to navigate
  if( is_single() ) {
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next - get_adjacent_post( false, '', false );

    if( ! $next && ! $previous )
      return;
  }

  //  don't print in archives if there's only 1 page
  if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
    return;

  $nav_class = 'site-navigation paging-navigation';
  if ( is_single() )
    $nav_class = 'site-navigation post-navigation';

  ?>
  <nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
    <h1 class="assistive-text"><?php _e( 'Post navigation', 'kpb' ); ?></h1>

  <!-- nav links for single posts -->
  <?php if ( is_single() ) : ?>

    <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'kpb' ) . '</span> %title' ); ?>
    <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'kpb' ) . '</span>' ); ?>

  <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : ?>

    <?php if ( get_next_posts_link() ) : ?>
      <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'kpb' ) ); ?></div>
    <?php endif; ?>

    <?php if ( get_previous_posts_link() ) : ?>
      <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'kpb' ) ); ?></div>
    <?php endif; ?>

  <?php endif; ?>

  </nav>
  <?php
}
endif;

if ( ! function_exists( 'kpb_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Kick-Punch-Block 1.0
 */
function kpb_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
  ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'kpb' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'kpb' ), ' ' ); ?></p>
  <?php
    break;
    default :
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <footer>
        <div class="comment-author vcard">
          <?php echo get_avatar( $comment, 40 ); ?>
          <?php printf( __( '%s <span class="says">says:</span>', 'kpb' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
        </div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
          <em><?php _e( 'Your comment is awaiting moderation.', 'kpb' ); ?></em>
          <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata">
          <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
          <?php

              printf( __( '%1$s at %2$s', 'kpb' ), get_comment_date(), get_comment_time() ); ?>
          </time></a>
          <?php edit_comment_link( __( '(Edit)', 'kpb' ), ' ' );
          ?>
        </div>
      </footer>

      <div class="comment-content"><?php comment_text(); ?></div>

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div>
    </article>

  <?php
          break;
  endswitch;
}
endif;

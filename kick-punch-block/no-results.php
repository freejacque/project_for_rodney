<?php
/**
 * template partial message when there are no posts
 *
 * @package Kick-Punch-Block
 * @since  Kick-Punch-Block 1.0
 */
?>

<article id="post-0" class="post no-results not-found">
  <header class="entry-header">
    <h1 class="entry-title"><?php _e( 'Nothing Found', 'kpb' ); ?></h1>
  </header>

  <div class="entry-content">
    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'kpb' ), admin_url( 'post-new.php' ) ); ?></p>
        <?php elseif ( is_search() ) : ?>
            <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'kpb' ); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kpb' ); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
  </div>
</article>

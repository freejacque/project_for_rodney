<?php
/**
 * The template for displaying image attachments.
 *
 * @package Kick-Punch-Block
 * @since Kick-Punch-Block 1.0
 */
get_header(); ?>

<div id="primary" class="content-area image-attachment">
  <div id="content" class="site-content" role="main">

  <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>

        <div class="entry-meta">
          <?php
            $metadata = wp_get_attachment_metadata();
            printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'kpb' ),
              esc_attr( get_the_date( 'c' ) ),
              esc_html( get_the_date() ),
              wp_get_attachment_url(),
              $metadata['width'],
              $metadata['height'],
              get_permalink( $post->post_parent ),
              get_the_title( $post->post_parent )
            );
          ?>
          <?php edit_post_link( __( 'Edit', 'kpb' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
        </div>

        <nav id="image-navigation" class="site-navigation">
          <span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'kpb' ) ); ?></span>
          <span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'kpb' ) ); ?></span>
        </nav>
      </header>

      <div class="entry-content">

        <div class="entry-attachment">
          <div class="attachment">
            <?php
              /**
               * Get the IDs of image attachments in gallery to get the URL of the next adjacent image,
               * or the 1st image (if it's the last image)
               */
              $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
              foreach ( $attachments as $k => $attachment ) {
                if ( $attachment->ID == $post->ID )
                break;
              }
              $k++;

              if ( count( $attachments ) > 1 ) {
                if ( isset( $attachments[ $k ] ) )
                  // get the URL of the next image attachment
                  $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                else
                  // or get the URL of the first image attachment
                  $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
              } else {
                // or, if there's only 1 image, get the URL of the image
                $next_attachment_url = wp_get_attachment_url();
              }

            ?>

            <a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
              $attachment_size = apply_filters( 'kpb_attachment_size', array( 1200, 1200 ) );
              echo wp_get_attachment_image( $post->ID, $attachment_size );
            ?></a>
          </div>

          <?php if ( ! empty( $post->post_excerpt ) ) : ?>
          <div class="entry-caption">
            <?php the_excerpt(); ?>
          </div>
          <?php endif; ?>
        </div>

        <?php the_content(); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'kpb' ), 'after' => '</div>' ) ); ?>

      </div>

        <footer class="entry-meta">
          <!-- comments & trackbacks open -->
          <?php if ( comments_open() && pings_open() ) : ?>
            <?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'kpb' ), get_trackback_url() ); ?>
          <!-- only trackbacks open -->
          <?php elseif ( ! comments_open() && pings_open() ) : ?>
            <?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'kpb' ), get_trackback_url() ); ?>
          <!-- only comments open -->
          <?php elseif ( comments_open() && ! pings_open() ) : ?>
            <?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'kpb' ); ?>
          <!-- comments & trackbacks closed -->
          <?php elseif ( ! comments_open() && ! pings_open() ) : ?>
            <?php _e( 'Both comments and trackbacks are currently closed.', 'kpb' ); ?>
          <?php endif; ?>
          <?php edit_post_link( __( 'Edit', 'kpb' ), ' <span class="edit-link">', '</span>' ); ?>
        </footer>
    </article>

    <?php comments_template(); ?>

  <?php endwhile; ?>

  </div>
</div>

<?php get_footer(); ?>

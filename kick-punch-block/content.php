<?php
/**
 * @package Kick-Punch-Block
 * @since Kick-Punch-Block 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <h1 class="entry-title">
      <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'kpb' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h1>

    <?php if ( 'post' == get_post_type() ) : ?>
    <div class="entry-meta">
      <?php kpb_posted_on(); ?>
    </div>
    <?php endif; ?>
  </header>

  <?php if( is_search() ) : ?>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
  <?php else : ?>
  <div class="entry-content">
    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'kpb' ) ); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'kpb' ), 'after' => '</div>' ) ); ?>
  </div>
  <?php endif; ?>

  <footer class="entry-meta">
    <?php if( 'post' == get_post_type() ) : ?>
      <?php $categories_list = get_the_category_list( __( ', ', 'kpb' ) ); if( $categories_list && kpb_categorized_blog() ) : ?>
        <span class="cat-links">
          <?php printf( __( 'Posted in %1$s', 'kpb' ), $categories_list ); ?>
        </span>
      <?php endif; ?>
      <?php $tags_list = get_the_tag_list( '', __( ',', 'kpb' ) ); if( $tags_list ) : ?>
        <span class="sep"> | </span>
        <span class="tag-links">
          <?php printf( __( 'Tagged %1$s', 'kpb' ), $tags_list ); ?>
        </span>
      <?php endif; ?>
    <?php endif; ?>

    <?php if( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
    <span class="sep"> | </span>
    <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'kpb' ), __( '1 Comment', 'kpb' ), __( '% Comments', 'kpb' ) ); ?></span>
    <?php endif; ?>

    <?php edit_post_link( __( 'Edit', 'kpb' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
  </footer>
</article>

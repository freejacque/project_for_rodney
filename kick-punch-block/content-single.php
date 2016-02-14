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

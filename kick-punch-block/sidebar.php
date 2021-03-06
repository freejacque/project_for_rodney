<?php
/**
* The Sidebar containing the main widget areas.
*
* @package Kick-Punch-Block
* @since Kick-Punch-Block 1.0
*/
?>
<div id="secondary" class="widget-area" role="complementary">
  <?php do_action( 'before_sidebar' ); ?>
  <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

    <aside id="search" class="widget widget_search">
      <?php get_search_form(); ?>
    </aside>

    <aside id="archives" class="widget">
      <h1 class="widget-title"><?php _e( 'Archives', 'kpb' ); ?></h1>
      <ul>
        <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
      </ul>
    </aside>

    <aside id="meta" class="widget">
      <h1 class="widget-title"><?php _e( 'Meta', 'kpb' ); ?></h1>
      <ul>
        <?php wp_register(); ?>
        <li><?php wp_loginout(); ?></li>
        <?php wp_meta(); ?>
      </ul>
    </aside>

  <?php endif; ?>
</div>

<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>

  <div id="tertiary" class="widget-area" role="supplementary">
    <?php dynamic_sidebar( 'sidebar-2' ); ?>
  </div>

<?php endif; ?>

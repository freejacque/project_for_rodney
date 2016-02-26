<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the id=main div and all content after
*
* @package Kick-Punch-Block
* @since Kick-Punch-Block 1.0
*/
?>

</div><!-- #main .site-main -->

<footer id="colophon" class="site-footer" role="contentinfo">
  <div class="site-info">
    <?php do_action( 'kpb_credits' ); ?>
    <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'kpb' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'kpb' ), 'WordPress' ); ?></a>
    <span class="sep"> | </span>
    <?php printf( __( 'Theme: %1$s by %2$s.', 'kpb' ), 'Kick-Punch-Block!', '<a href="http://www.k-p-b.com" rel="designer">Kick-Punch-Block!</a>' ); ?>
  </div>
</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>

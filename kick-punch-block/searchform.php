<?php
/**
 * The template for displaying search forms
 *
 * @package Kick-Punch-Block
 * @since Kick-Punch-Block 1.0
 */
?>
  <form method="get" id="searchForm" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
    <label for="s" class="assistive-text"><?php _e( 'Search', 'kpb' ); ?></label>
    <input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'kpb' ); ?>" />
    <input type="submit" class="submit" name="submit" id="searchSubmit" value="<?php esc_attr_e( 'Search', 'kpb' ); ?>" />
  </form>

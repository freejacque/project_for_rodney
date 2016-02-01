<?
/** KPB functions and definitions
 *
 * @package Kick-Punch-Block
 * @since  Kick-Punch-Block 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Kick-Punch-Block 1.0
 */
if(! isset( $content_width ) )
  $content_width = 654; /* pixels */

if( ! function_exists( 'kpb_setup' ) ):
  /*
   * Sets up theme defaults and registers support for various wordpress features.
   *
   * Note: this function is hooked into the after_setup_theme hook
   * which runs before the init hook. The init hook runs too late for some features
   *
   * @since Kick-Punch-Block 1.0
   */
  function kpb_setup() {
    require( get_template_directory() ) . '/inc/template-tags.php' );
    require( get_template_directory() ) . '/inc/tweaks.php' );

    load_theme_textdomain( 'Kick-Punch-Block', get_template_directory() . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'aside' ) );
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'Kick-Punch-Block' ),
    ));
  }
endif;
add_action( 'after_setup_theme', 'kpb_setup' );

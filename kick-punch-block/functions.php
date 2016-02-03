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
  /* *
   * Sets up theme defaults and registers support for various wordpress features.
   *
   * Note: this function is hooked into the after_setup_theme hook
   * which runs before the init hook. The init hook runs too late for some features
   *
   * @since Kick-Punch-Block 1.0
   */
  function kpb_setup() {
    // Custom template tags
    require( get_template_directory() ) . '/inc/template-tags.php' );
    // Custom independently acting functions
    require( get_template_directory() ) . '/inc/tweaks.php' );
    //  make the theme available for translation
    load_theme_textdomain( 'Kick-Punch-Block', get_template_directory() . '/languages' );
    //  add default posts & rss feed links to head
    add_theme_support( 'automatic-feed-links' );
    // Enable support for the Aside Post Format
    add_theme_support( 'post-formats', array( 'aside' ) );
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'Kick-Punch-Block' ),
    ));
  }
endif;
// telling wordpres to run kpb_setup when it runs after_setup_theme
add_action( 'after_setup_theme', 'kpb_setup' );

// when a file is all php it's safer to omit the closing tag,, to avoid trailing white space errors

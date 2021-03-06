<?
/** KPB functions and definitions
 *
 * @package Kick-Punch-Block
 * @since  Kick-Punch-Block 1.0
 */

define("THEME_DIR", get_template_directory_uri());
/* Remove generator meta tag */
remove_action('wp_head', 'wp_generator');

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
    require( get_template_directory() . '/inc/template-tags.php' );
    // Custom independently acting functions
    require( get_template_directory() . '/inc/tweaks.php' );
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

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Kick-Punch-Block 1.0
 */
function kpb_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Primary Widget Area', 'kpb' ),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );

    register_sidebar( array(
        'name' => __( 'Secondary Widget Area', 'kpb' ),
        'id' => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );
}
add_action( 'widgets_init', 'kpb_widgets_init' );

/**
 * Enqueue scripts and styles
 */
// TODO add other scripts
function kpb_scripts() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );

  if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
  // navigation.js creates a mobile-friendly menu on smaller screens
  wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
  // key-board-image-navigation.js can navigate through images using left & right arrows, jquery is also loaded
  if(is_singular() && wp_attachment_is_image() ) {
    wp_enqueue_script( 'Keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
  }
  // Register HTML5 shim
  wp_register_script('html5-shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js', array( 'jquery' ), '1', true
);
  wp_enqueue_script( 'html5-shim' );
  // Register HTML5 OtherScript.js
  wp_register_script( 'custom-script', THEME_DIR . '/js/customscript.js', array( 'jquery' ), '1', true );
  wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'kpb_scripts');

/**
 * Setup the WordPress core custom background feature.
 *
 * Hooks into the after_setup_theme action.
 *
 */
function kpb_register_custom_background() {
    $args = array(
        'default-color' => 'fffff',
    );

    $args = apply_filters( 'kpb_custom_background_args', $args );

    if ( function_exists( 'wp_get_theme' ) ) {
        add_theme_support( 'custom-background', $args );
    } else {
        define( 'BACKGROUND_COLOR', $args['default-color'] );
        define( 'BACKGROUND_IMAGE', $args['default-image'] );
        add_custom_background();
    }
}
add_action( 'after_setup_theme', 'kpb_register_custom_background' );

/**
* Enqueue Styles
*/
function kpb_styles() {

  /** Register css/screen.css **/
  wp_register_style( 'screen-style', THEME_DIR . '/stylesheets/screen.css', array(), '1', 'all' );
  wp_enqueue_style( 'screen-style' );

  wp_register_style( 'topbar-style', THEME_DIR . '/stylesheets/topbar.css', array(), '1', 'all' );
  wp_enqueue_style( 'topbar-style' );

  wp_register_style( 'content-sidebar-sidebar-style', THEME_DIR . '/stylesheets/content-sidebar-sidebar.css', array(), '1', 'all' );
  wp_enqueue_style( 'content-sidebar-sidebar-style' );
}
add_action( 'wp_enqueue_scripts', 'kpb_styles' );

// when a file is all php it's safer to omit the closing tag, to avoid trailing white space errors

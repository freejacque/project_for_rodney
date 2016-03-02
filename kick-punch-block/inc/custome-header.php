<?php
/*
 * @package Kick-Punch-Block
 * @since Kick-Punch-Block 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses kpb_header_style()
 * @uses kpb_admin_header_style()
 * @uses kpb_admin_header_image()
 *
 * @package Kick-Punch-Block
 */
function kpb_custom_header_setup() {
    $args = array(
        'default-image'          => '',
        'default-text-color'     => 'e9e0e1',
        'width'                  => 1050,
        'height'                 => 250,
        'flex-height'            => true,
        'wp-head-callback'       => 'kpb_header_style',
        'admin-head-callback'    => 'kpb_admin_header_style',
        'admin-preview-callback' => 'kpb_admin_header_image',
    );

    $args = apply_filters( 'kpb_custom_header_args', $args );

    if ( function_exists( 'wp_get_theme' ) ) {
        add_theme_support( 'custom-header', $args );
    } else {
        // Compat: Versions of WordPress prior to 3.4.
        define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
        define( 'HEADER_IMAGE',        $args['default-image'] );
        define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
        define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
        add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
    }
}
add_action( 'after_setup_theme', 'kpb_custom_header_setup' );


if ( ! function_exists( 'kpb_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see kpb_custom_header_setup().
 * @since Kick-Punch-Block 1.0
 */
function kpb_header_style() {

    if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
        return;
    ?>
    <style type="text/css">
    <?php
        // is there a custom header image?
        if ( '' != get_header_image() ) :
    ?>
        .site-header img {
            display: block;
            margin: 1.5em auto 0;
        }
    <?php endif;
        // is the text hidden?
        if ( 'blank' == get_header_textcolor() ) :
    ?>
        .site-title,
        .site-description {
            position: absolute !important;
            clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
            clip: rect(1px, 1px, 1px, 1px);
        }
        .site-header hgroup {
            background: none;
            padding: 0;
        }
    <?php
        else :
    ?>
        .site-title a,
        .site-description {
            color: #<?php echo get_header_textcolor(); ?> !important;
        }
    <?php endif; ?>
    </style>
    <?php
}
endif;

if ( ! function_exists( 'kpb_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see kpb_custom_header_setup().
 * @since Kick-Punch-Block 1.0
 */
function kpb_admin_header_style() {
?>
    <style type="text/css">
    .appearance_page_custom-header #headimg {
        background: #33605a;
        border: none;
        min-height: 0 !important
    }
    #headimg h1 { /* site preview title display */
        font-size: 45px;
        font-family: Georgia, 'Times New Roman', serif;
        font-style: italic;
        font-weight: normal;
        padding: 0.8em 0.5em 0;
    }
    #desc {
        padding: 0 2em 2em;
    }
    #headimg h1 a,
    #desc {
        color: #e9e0d1;
        text-decoration: none;
    }
    </style>
<?php
}
endif;

if ( ! function_exists( 'kpb_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see kpb_custom_header_setup().
 * @since Kick-Punch-Block 1.0
 */
function kpb_admin_header_image() { ?>
    <div id="headimg">
        <?php
        if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
            $style = ' style="display:none;"';
        else
            $style = ' style="color:#' . get_header_textcolor() . ';"';
        ?>
        <h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
        <?php $header_image = get_header_image();
        if ( ! empty( $header_image ) ) : ?>
            <img src="<?php echo esc_url( $header_image ); ?>" alt="" />
        <?php endif; ?>
    </div>
<?php }
endif;

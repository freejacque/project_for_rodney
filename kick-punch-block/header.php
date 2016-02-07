<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Kick-Punch-Block
 * @since Kick-Punch-Block 1.0
 */
?><!DOCTYPE html>
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width" />
  <title><?php
  /*
   * Print the <title> tag based on what is being viewed.
   */
  global $page, $paged;

  wp_title( '|', true, 'right' );

  // add the blog name
  bloginfo( 'name' );

  // Add the blog description for the home/ front page
  $site_description = get_bloginfo( 'description', 'display' );
  if($site_description && (is_home() || is_front_page() ) )
  echo " | $site_description";

  //  add a page number if necessary
  if( $paged >= 2 || $page >= 2 )
  echo ' | '. sprintf( __( 'Page %s', 'Kick-Punch-Block'), max( $paged, $page ) );

  ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
  <![endif]-->
  <?php wp_head(); ?> <!-- a required hook -->
</head>

<!-- body_class() adds CSS classes for different types of pages -->
<body <?php body_class(); ?>>

  <div id="page" class="hfeed site">
    <header id="masthead" class="site-header" role="banner">
      <hgroup>
        <h1 class="site-title">
          <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
        </h1>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
      </hgroup>
      <nav role="navigation" class="site-navigation main-navigation">
        <h1 class="assistive-text"><?php _e( 'Menu', 'kpb' ); ?></h1>
      </nav>
    </header>
  </div>
  <div id="main" class="site-main">

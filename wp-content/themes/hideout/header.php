<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Hideout
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>



<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'hideout' ); ?></a>

	<header id="masthead" class="site-header " role="banner">
		<nav class="navbar navbar-default navbar-inverse container" role="navigation"> 
		<!-- Brand and toggle get grouped for better mobile display --> 
		  <div class="navbar-header"> 
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
		      <span class="sr-only">Toggle navigation</span> 
		      <span class="icon-bar">2</span> 
		      <span class="icon-bar"></span> 
		      <span class="icon-bar"></span> 
		    </button>
		    <a class="navbar-brand" href="<?php bloginfo('url') ?>"><h2><?php bloginfo('name') ?></h2></a>
		  </div> 
		  <!-- Collect the nav links, forms, and other content for toggling --> 
		  <div class="collapse navbar-collapse navbar-ex1-collapse pull-right"> 

		  	<?php /* Primary navigation */
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
        		'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
			?>

		  </div>
		</nav>
	</header><!-- #masthead -->

	<!-- <div id="content" class="site-content"> -->

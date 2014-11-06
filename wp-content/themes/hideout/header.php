<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Hideout
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> ng-app="theHideoutApp">
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

  
  <div class="container-fluid">
    <div class='row'>
      
   
      

    <header id="masthead" class="site-header " role="banner">

      <?php 
      if (is_page_template( 'my-templates/home-page.php' )) {
        get_template_part( 'templates/content', 'front-page-top-background' );
      }
      // else get the a template part for something else
    ?>
        <div class="navbar-container navbar-fixed-top">
          <nav class="navbar navbar-default  col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1" role="navigation"> 
          <!-- Brand and toggle get grouped for better mobile display --> 
            <div class="navbar-header"> 

              <a class="navbar-brand" href="<?php bloginfo('url') ?>"><h2><?php bloginfo('name') ?> Bar</h2></a>
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
                <span class="sr-only">Toggle navigation</span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span> 
              </button>

            </div> 
            <!-- Collect the nav links, forms, and other content for toggling --> 



            <div class="collapse navbar-collapse navbar-left"> 
              <?php /* Primary navigation */
                wp_nav_menu( array(
                  'menu'              => 'primary',
                  'theme_location'    => 'primary',
                  'depth'             => 2,
                  'container'         => 'div',
                  'container_class'   => 'collapse navbar-collapse',
                  'container_id'      => '',
                  'menu_class'        => 'nav navbar-nav',
                  'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                  'walker'            => new wp_bootstrap_navwalker())
                );
              ?>
            </div>

            <div class="collapse navbar-collapse navbar-right"> 
              <?php /* Primary navigation */
                wp_nav_menu( array(
                  'menu'              => 'secondary',
                  'theme_location'    => 'secondary',
                  'depth'             => 2,
                  'container'         => 'div',
                  'container_class'   => 'collapse navbar-collapse',
                  'container_id'      => '',
                  'menu_class'        => 'nav navbar-nav',
                  'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                  'walker'            => new wp_bootstrap_navwalker())
                );
              ?>
            </div>


          </nav>


        </div>

        <!-- Import the message div for the spash screen -->
        <?php 
          if (is_page_template( 'my-templates/home-page.php' )) {
            get_template_part( 'templates/content', 'front-page-message' );
          }
          
        ?>
       

        


      </div> <!-- .content-banner -->  
    </header><!-- #masthead -->

   </div> <!-- row -->

 </div> <!-- container -->



  <div id="content" class="site-content">

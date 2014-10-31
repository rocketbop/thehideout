<?php
/*
Template Name: Home Page
*/

get_header(); ?>

<?php get_template_part( 'templates/content', 'banner' ); ?>

  <div id="primary" class="content-area ">

  <!--  -->
    <div class="container">
      <div class="row"> <!-- main content and sidebar row -->
          <div class="col-md-6"> <!-- main content -->
            <main id="main" class="site-main" role="main">
              <div class="row">
                <div class="">
                  <?php 
                      echo do_shortcode("[metaslider id=21]"); 
                  ?>
                </div>
  
  
              </div>
              <div class="row">
  
                  <?php while ( have_posts() ) : the_post(); ?>
  
                    <?php get_template_part( 'content', 'cleanpage' ); ?>
  
                    <?php hideout_post_nav(); ?>
  
  
                  <?php endwhile; // end of the loop. ?>
  
              </div>
  
            </main><!-- #main -->
          </div>
          <div class="col-md-6"> <!-- sidebar -->
            <?php get_sidebar('home') ?>
          </div>
        </div>  

  </div>

  <div class="row">
      <?php get_template_part( 'templates/content', 'newsmodule' ); ?>
  </div>

  <div class="row">
      <?php get_template_part( 'templates/content', 'musicmodule' ); ?>
  </div>

  <div class="row">
      <?php get_template_part( 'templates/content', 'foodmodule' ); ?>
  </div>
      
  </div><!-- #primary -->


<?php get_footer(); ?>
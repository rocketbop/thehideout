<?php
/*
Template Name: Contact Page
*/

get_header();  ?>

<div id="primary" class="content-area secondary-page  contact-page visible-links visible-links-aqua">
  <div class="container-fluid">
    <div class="row">
        <div class="background-container col-xs-12 col-sm-12" data-my-div-height="navbar" minus-header="false">
        </div>
      </div>
  </div>
  <div class="container-fluid">
    <div class="row page-header page-header-top">
      <div class="page-inner col-md-10 col-lg-10 col-md-offset-1">
        <div class="row">
          <div class="title col-md-7 col-lg-7 col-md-offset-2">
            <h1>Contact Us</h1>
          </div>
        </div>
      </div>  
    </div> <!-- row -->
  </div> <!-- fluid container -->

    <!-- page header bottom -->
    <div class="container-fluid">
      <div class="row page-header page-header-bottom">
        <div class="page-inner col-md-10 col-md-offset-1">
          <div class="row">
            <div class="col-md-7 col-lg-7 col-md-offset-2">
              <h4>Get in touch with us.</h4>
            </div>
          </div>
        </div> 
      </div> <!-- row -->
    </div> <!-- fluid container -->



<div class="container-fluid">
  <div class="row module-body">
    <div class="module-body-inner col-md-10 col-md-offset-1">
      <div class="row">
        <div class="col-md-12 col-lg-9">
          
        
          <?php if ( have_posts() ) : ?>
            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <?php
                get_template_part( 'content', 'cleanpage' );
              ?>
            <?php endwhile; ?>
          <?php else : ?>
            <?php get_template_part( 'content', 'none' ); ?>
          <?php endif; ?>
        </div>
         <div class="visible-lg col-lg-3">
          <?php get_sidebar(); ?>
        </div>

      </div>
    </div>
  </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php get_footer(); ?>
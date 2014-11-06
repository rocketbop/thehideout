<?php
/*
Template Name: Blog Page
*/

get_header(); ?>

  <div id="primary" class="content-area ">

    <div ng-controller="blogCtrl">

<div class="container">
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1>News</h1>
      </div>
    </div>

      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-3">
           <?php get_template_part( 'templates/content', 'blogsection' ); ?>
        </div>
      </div> <!-- row -->
</div>
    

    </div> <!-- ng controller -->
       
  </div><!-- #primary -->


<?php get_footer(); ?>
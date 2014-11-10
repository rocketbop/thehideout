<?php
/*
Template Name: Blog Page
*/

get_header(); ?>

  <div id="primary" class="content-area blog-page" ng-controller="blogCtrl">

  <!-- page header top -->
    <div class="container-fluid">
      <div class="row page-header page-header-top">
        <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
        <div class="row">
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-md-offset-2">
            <h1>The Blog</h1>
            <h3>Recent news, and thoughts from your friends at The Hideout</h3>
            </div>
        </div>

        </div>  
      </div> <!-- row -->
    </div> <!-- fluid container -->

    <!-- page header bottom -->
    <div class="container-fluid">
      <div class="row page-header page-header-bottom">
        <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
        <div class="row">
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-md-offset-2">
            <h5>YOLO Vice tilde, craft beer cornhole shabby chic roof party typewriter tote bag fixie lomo slow-carb. Street art church-key normcore farm-to-table, 8-bit flannel bespoke ennui Shoreditch. Tousled vinyl plaid fingerstache street art. Cred literally pickled bespoke craft beer ennui, fashion axe kogi cardigan sriracha Tonx twee Schlitz Truffaut 3 wolf moon. Vice drinking vinegar twee tousled direct trade. VHS DIY umami pop-up tote bag meggings slow-carb you probably haven't heard of them retro chambray. Tattooed literally XOXO, hella four loko chambray Thundercats gluten-free pickled squid stumptown post-ironic.</h5>
          </div>
        </div>
          
        

        </div> 
      </div> <!-- row -->
    </div> <!-- fluid container -->


    <!-- The main body -->
    <div class="container-fluid">
      <div class="row page-body">
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">

          <div class="row">
            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-md-offset-2">
               <?php get_template_part( 'templates/content', 'blogsection' ); ?>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
              <?php get_sidebar(); ?>
            </div>
          </div> <!-- row -->

        </div>  <!-- page body -->
      </div> <!-- row -->
    </div> <!-- fluid container -->


  </div><!-- #primary -->


<?php get_footer(); ?>
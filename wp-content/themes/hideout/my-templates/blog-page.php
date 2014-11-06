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

            <h1>The Blog</h1>
            <h3>Recent news, and thoughts from your friends at The Hideout</h3>

        </div>  
      </div> <!-- row -->
    </div> <!-- fluid container -->

    <!-- page header bottom -->
    <div class="container-fluid">
      <div class="row page-header page-header-bottom">
        <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">

           <p>YOLO Vice tilde, craft beer cornhole shabby chic roof party typewriter tote bag fixie lomo slow-carb. Street art church-key normcore farm-to-table, 8-bit flannel bespoke ennui Shoreditch. Tousled vinyl plaid fingerstache street art. Cred literally pickled bespoke craft beer ennui, fashion axe kogi cardigan sriracha Tonx twee Schlitz Truffaut 3 wolf moon. Vice drinking vinegar twee tousled direct trade. VHS DIY umami pop-up tote bag meggings slow-carb you probably haven't heard of them retro chambray. Tattooed literally XOXO, hella four loko chambray Thundercats gluten-free pickled squid stumptown post-ironic.</p>
           <p>Vice drinking vinegar twee tousled direct trade. VHS DIY umami pop-up tote bag meggings slow-carb you probably haven't heard of them retro chambray. Tattooed literally XOXO, hella four loko chambray Thundercats gluten-free pickled squid stumptown post-ironic.</p>

        </div> 
      </div> <!-- row -->
    </div> <!-- fluid container -->


    <!-- The main body -->
    <div class="container-fluid">
      <div class="row page-body">
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">

          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-3">
               <?php get_template_part( 'templates/content', 'blogsection' ); ?>
            </div>
          </div> <!-- row -->

        </div>  <!-- page body -->
      </div> <!-- row -->
    </div> <!-- fluid container -->


  </div><!-- #primary -->


<?php get_footer(); ?>
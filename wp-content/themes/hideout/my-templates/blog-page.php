<?php
/*
Template Name: Blog Page
*/

get_header(); ?>


  <div id="primary" class="content-area blog-page" ng-controller="blogCtrl">

  <!-- page header top -->
    <div class="container-fluid">
      <div class="row">
        <div class="background-container col-xs-12 col-sm-12 col-md-12 col-lg-12" data-my-div-height="full" minus-header="true">
          <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
              <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  Images Go here
                </div>
                <div id="blurb" class="blurb col-xs-6 col-sm-6 col-md-6 col-lg-6" data-my-vertical-center ext-function="getPanelMargin()">
                  <h2>News from the Hideout</h2>
                  <p>Some blurb about news at the Hideout</p>
                 
                  
              
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div  class="row page-header page-header-top">
        <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
        <div class="row">
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-md-offset-2">
            <h1>The Blog</h1>
            <h3><!-- Recent news, and thoughts from your friends at The Hideout --></h3>
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
            <h4>Recent news, and thoughts from your friends at The Hideout</h4>
 <!--              <p>YOLO Vice tilde, craft beer cornhole shabby chic roof party typewriter tote bag fixie lomo slow-carb. Street art church-key normcore farm-to-table, 8-bit flannel bespoke ennui Shoreditch. Meggings plaid Tonx readymade actually direct trade. Pitchfork High Life umami DIY, quinoa freegan ugh Bushwick sustainable Thundercats irony kogi locavore church-key. Distillery bitters Thundercats meggings paleo semiotics pop-up. Pug crucifix YOLO letterpress, trust fund Blue Bottle Banksy Vice disrupt plaid semiotics before they sold out pop-up skateboard mustache.</p> -->
          </div>
        </div>
          
        

        </div> 
      </div> <!-- row -->
    </div> <!-- fluid container -->


    <!-- The main body -->
    <div class="container-fluid">
      <div class="row page-body">
         <div class=" body-outer col-xs-1 col-sm-1 col-md-1 col-lg-1">
        
        </div>
        <div class="body-inner col-xs-10 col-sm-10 col-md-10 col-lg-10">

          <div  class="row">
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
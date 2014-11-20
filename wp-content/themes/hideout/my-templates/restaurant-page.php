<?php
/*
Template Name: Restaurant Page
*/

get_header(); ?>

<div id="primary" class="content-area restaurant-page">
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
                <h2>The Restauarant</h2>
                <p>Some blurb about food the Hideout</p>
               
                
            
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    <div class="row page-header page-header-top">
      <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
          <div class="row">
            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-md-offset-2">
              <h1>The Restaurant</h1>
              <!-- <h3>Get the details on all upcoming music, poetry, and gettogethers at The Hideout.</h3> -->
            </div>
          </div>
      </div>  <!-- page header -->
    </div> <!-- row -->
  </div> <!-- fluid container -->

  <div class="container-fluid">
    <div class="row page-header page-header-bottom">
      <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
                  <div class="row">
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-md-offset-2">

          <h4>Food at the Hideout</h4>

          </div>
          </div>
      </div>  <!-- page header -->
    </div> <!-- row -->
  </div> <!-- fluid container -->

  <div id ="entries" class="container-fluid">
    <div class="row page-body ">

      <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
        <div class="row">
          <div class="sidebar-1">
            <div class="col-md-2">
         
              <h4 class="text-center">Sidebar</h4>
     
            </div>

          </div>

          <div class="column-main">
            <div class="col-md-7">
            <h3>The Restaurant</h3>
             </div>
            <!-- </div>  -->

            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
              <?php get_sidebar(); ?>
            </div>
         </div> <!-- row -->
       </div> <!-- page body -->
    </div> <!-- row -->
  </div> <!-- container fluid -->

</div> <!-- ng controller -->

<?php get_footer(); ?>
<?php
/*
Template Name: Restaurant Page
*/

get_header(); ?>

<div id="primary" class="content-area secondary-page restaurant-page">
  <div class="container-fluid">
    <div class="row">
        <div class="background-container col-xs-12 col-sm-12 col-md-12 col-lg-12" data-my-div-height="full" minus-header="true">

        <div class="row">
          <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
            <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                Images Go here
              </div>
              <div id="blurb" class="blurb hidden-xs col-xs-6 col-sm-6 col-md-6 col-lg-6" data-my-vertical-center ext-function="getPanelMargin()">
                <h2>We love great food</h2>
                <p>See what's new in the Hideout Restaurant</p>
               
                
            
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
      <div class=" body-outer col-xs-1 col-sm-1 col-md-1 col-lg-1">
        
      </div>
      <div class=" body-inner col-xs-10 col-sm-10 col-md-10 col-lg-10">
        <div class="row">
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
           
              
                <img ng-src="{{templateDirectory}}images/food/steak.jpg">
            
       
            

          </div>
          <div class="col-xs-1 col-sm-8 col-md-8 col-lg-8">
            <h2>Food at the Hideout</h2>
            <p>Information about the food and the chef and the so on</p>
          </div>
        </div>
       </div> <!-- page body -->
    </div> <!-- row -->
  </div> <!-- container fluid -->

</div> <!-- ng controller -->

<?php get_footer(); ?>
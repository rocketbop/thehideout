<?php
/*
Template Name: Events Page
*/

get_header(); ?>

<div id="primary" class="content-area secondary-page events events-page visible-links visible-links-cherry" ng-controller="eventCtrl">
  <div class="container-fluid">
    <div class="row">
        <div class="background-container col-xs-12 col-sm-12 col-md-12 col-lg-12" data-my-div-height="full" minus-header="true">

        <div class="row">
          <div class="col-sm-10 col-md-10 col-lg-10 col-sm-offset-1">
            <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                
              </div>
              <div id="blurb" class="blurb col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-6 col-md-6" data-my-vertical-center ext-function="getPanelMargin()">
                <h2>We Love Music</h2>
                <p>We care about music at The Hideout.</p>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    <div class="row page-header page-header-top">
      <div class="page-inner col-md-10 col-lg-10 col-md-offset-1">
          <div class="row">
            <div class="col-md-7 col-lg-7 col-md-offset-2">
              <h1>The Hideout Events</h1>
              
            </div>
          </div>
      </div>  <!-- page header -->
    </div> <!-- row -->
  </div> <!-- fluid container -->

  <div class="container-fluid">
    <div class="row page-header page-header-bottom">
      <div class="page-inner col-md-10 col-md-offset-1">
                  <div class="row">
          <div class="col-md-7 col-lg-7 col-md-offset-2">

          <h4>Get the details on all upcoming music and events at The Hideout.</h4>

          </div>
          </div>
      </div>  <!-- page header -->
    </div> <!-- row -->
  </div> <!-- fluid container -->

  <div id ="entries" class="container-fluid">
    <div class="row page-body ">
       <div class=" body-outer col-xs-1 col-sm-1 col-md-1 col-lg-1">
        
      </div>

      <div class="body-inner col-xs-10 col-sm-10 col-md-10 col-lg-10">
          <div class="column-main">
            <div class="col-md-9 col-lg-9">
              <div ng-include src="htmlTemplatesDirectory + 'events_section_template.html'"></div>

             </div>
            <!-- </div>  -->

            <div class="hidden-xs hidden-sm col-md-3 no-padding-left">
            <div ng-include src="htmlTemplatesDirectory + 'event_filter_template.html'"></div>

              <?php get_sidebar(); ?>
            </div>
         </div> <!-- row -->
       </div> <!-- page body -->
    </div> <!-- row -->
  </div> <!-- container fluid -->

</div> <!-- ng controller -->

<?php get_footer(); ?>
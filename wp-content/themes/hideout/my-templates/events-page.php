<?php
/*
Template Name: Events Page
*/

get_header(); ?>

<div id="primary" class="content-area events-page" ng-controller="eventCtrl">
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
                <h2>We Love Live Music</h2>
                <p>Some blurb about why there is music at the Hideout</p>
                <p>Some more information about why you should come to the Hideout to see the live bands.</p>
                <p>Some more information about why you should come to the Hideout to see the live bands.</p>

            
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
              <h1>Upcoming Events</h1>
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

          <h4>Get the details on all upcoming music, poetry, and gettogethers at The Hideout.</h4>

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
        <div class="row">
          <div class="column-filter">
            <div class="col-md-2">
         
              <h4 class="text-center">Filter</h4>
              <a ng-click="selectCategory()"
                class="btn btn-block btn-default btn-lg">All</a>
                <!-- The unique filter will mean categories with more than one event will not be generated in duplicate -->
              <a ng-click="selectCategory(event.category)" ng-repeat="event in data.events | orderBy:'category' | unique:'category'"  class=" btn btn-block btn-default btn-lg" ng-class="getCategoryClass(event.category)">{{event.category}}</a>  

            </div>
          </div>
          <div class="column-main">
            <div class="col-md-7">
              
                <!-- <h3>{{selectedCategory}} Events</h3> -->
                <div ng-repeat="event in data.events | orderBy: '-date_of_event' | filter:categoryFilterFn | range:selectedPage:pageSize">
                  <div class="row ">
                    <div class="col-sm-6 col-md-6 col-lg-6 no-padding-right">
                      <div class="board left-board">
                        <h3>{{event.event_name}}</h3>
                      </div>  
                    </div>
                    <div class=" col-sm-6 col-md-6 col-lg-6 no-padding-left">
                      <div class=" board right-board no-padding-left">
                         <h3>{{event.date_of_event | date: 'EEEE, d MMMM'}}</h3>
                       </div>
                    </div>
                  </div>

                  
                 

                  
                  <img src="{{event.event_image.url}}">

                  <div class="board board-block"><h4>{{event.date_of_event | date: 'h:mma, EEEE, d MMMM yyyy'}}, {{event.category}}.</h4></div>
                  <!-- <p>{{event.content}}</p> -->
                  <!-- Save to use below for content entered through WP backend -->
                  <div ng-bind-html="event.event_description"></div>

                </div>

                <div class="pull-right btn-group">
                    <a ng-repeat=
                       "page in data.events | filter:categoryFilterFn | pageCount:pageSize"
                       ng-click="selectPage($index + 1)" class="btn btn-default"
                       ng-class="getPageClass($index + 1)">
                        {{$index + 1}}
                    </a>
                </div>
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
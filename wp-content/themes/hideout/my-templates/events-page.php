<?php
/*
Template Name: Events Page
*/

get_header(); ?>

<div id="primary" class="content-area events-page" ng-controller="eventCtrl">
  <div class="container-fluid">
    <div class="row page-header page-header-top">
      <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">

          <h1>Upcoming Events</h1>
          <h3>Get the details on all upcoming music, poetry, and gettogethers at The Hideout.</h3>

      </div>  <!-- page header -->
    </div> <!-- row -->
  </div> <!-- fluid container -->

  <div class="container-fluid">
    <div class="row page-header page-header-bottom">
      <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">

          <p>Chia selfies artisan Austin. Craft beer YOLO flannel, chillwave lomo gluten-free bespoke ugh fashion axe. Banksy mumblecore meggings gluten-free Shoreditch semiotics. Meggings plaid Tonx readymade actually direct trade. Pitchfork High Life umami DIY, quinoa freegan ugh Bushwick sustainable Thundercats irony kogi locavore church-key. Distillery bitters Thundercats meggings paleo semiotics pop-up. Pug crucifix YOLO letterpress, trust fund Blue Bottle Banksy Vice disrupt plaid semiotics before they sold out pop-up skateboard mustache.</p>

      </div>  <!-- page header -->
    </div> <!-- row -->
  </div> <!-- fluid container -->

  <div class="container-fluid">
    <div class="row page-body ">

      <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
        <div class="row">
          <div class="col-md-3">
         
            <h1 class="text-center">Category</h1>
            <a ng-click="selectCategory()"
              class="btn btn-block btn-default btn-lg">All</a>
              <!-- The unique filter will mean categories with more than one event will not be generated in duplicate -->
            <a ng-click="selectCategory(event.category)" ng-repeat="event in data.events | orderBy:'category' | unique:'category'"  class=" btn btn-block btn-default btn-lg" ng-class="getCategoryClass(event.category)">{{event.category}}</a>  

          </div>
          <div class="col-md-7">
            
              <h1>{{selectedCategory}} Events</h1>
              <div ng-repeat="event in data.events | orderBy: '-date_of_event' | filter:categoryFilterFn | range:selectedPage:pageSize">

                <!-- <p><strong>Date Created </strong>{{event.date | date:'EEEE, dd MM yyyy, h:mm'}}</p> -->
                <p><strong>Date of Event: </strong>{{event.date_of_event | date: 'medium'}}</p>
                <p><strong>Name of Event: </strong>{{event.event_name}}</p>
                <p><strong>Category: </strong>{{event.category}}</p>
                <img src="{{event.event_image.url}}">
                <p>{{event.content}}</p>
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
         </div> <!-- row -->
       </div> <!-- page body -->
    </div> <!-- row -->
  </div> <!-- container fluid -->

</div> <!-- ng controller -->
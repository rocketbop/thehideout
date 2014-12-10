<?php
/*
Template Name: Gallery Page
*/

get_header(); ?>

<div id="primary" class="content-area secondary-page gallery-page visible-links visible-links-blue" ng-controller="galleryCtrl">
  <div class="container-fluid">
<!--     <div class="row">
        <div class="background-container col-xs-12 col-sm-12 col-md-12 col-lg-12" data-my-div-height="full" minus-header="true">

        <div class="row">
          <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
            <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                Images Go here
              </div>
              <div id="blurb" class="blurb col-xs-6 col-sm-6 col-md-6 col-lg-6" data-my-vertical-center ext-function="getPanelMargin()">
                <strong><h2>We Love Music</h2></strong>
                <p>We care about music at <strong>The Hideout</strong>.</p>
                <p>That's why we have great equipment, great bands and singers, and great audiences.</p>
                <strong><p>5 Nights a Week.</p></strong>
               
            
              </div>
            </div>
          </div>
        </div>
        </div>
      </div> -->









    <div class="row page-header page-header-top">
      <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
          <div class="row">
            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-md-offset-2">
              <h1>Upcoming Events</h1>
              
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
        <div class="row">
          <div class="column-filter">
            <div class="col-md-3 no-padding-right">
         
              <h3 class="text-center">Albums</h3>
                <!-- The unique filter will mean categories with more than one event will not be generated in duplicate -->
              <a ng-click="selectAlbum(photoset.id)" ng-repeat="photoset in data.photosetList.photosets.photoset"  class=" btn btn-block btn-default btn-lg" ng-class="getCategoryClass(event.category)"><h4>{{photoset.title._content}}</h4></a>  

            </div>
          </div>
          <div class="column-main">
            <div class="col-md-9">
              
                

                <div class="row" ng-repeat="photos in data.selectedAlbumPhotos.photoset.photo | groupBy:3">
                <div class=" flickr col-md-4" ng-repeat="photo in photos" >
                  <div class="item">
                    <a ng-click="openLightboxModal($index)">
                       <img class="item-image img-thumbnail" ng-src="https://farm{{photo.farm}}.staticflickr.com/{{photo.server}}/{{photo.id}}_{{photo.secret}}_n.jpg" alt="">
                     </a>
                  </div>
                  <div class="info">
                    <h5>{{photo.title}}</h5>
                  </div>
                </div>
              </div>
                           

                <div class="pagination pull-left btn-group">
                    <a ng-repeat=
                       "page in data.events | filter:categoryFilterFn | pageCount:pageSize"
                       ng-click="selectPage($index + 1)" class="btn btn-default"
                       ng-class="getPageClass($index + 1)">
                        {{$index + 1}}
                    </a>
                </div>
             </div>
            <!-- </div>  -->


         </div> <!-- row -->
       </div> <!-- page body -->
    </div> <!-- row -->
  </div> <!-- container fluid -->








</div> <!-- ng controller -->


<?php get_footer(); ?>
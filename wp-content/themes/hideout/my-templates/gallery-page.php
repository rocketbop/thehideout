<?php
/*
Template Name: Gallery Page
*/

get_header(); ?>

<div id="primary" class="content-area secondary-page  gallery-page visible-links visible-links-aqua" ng-controller="galleryCtrl">
  <div class="container-fluid">
    <div class="row">
        <div class="background-container col-xs-12 col-sm-12" data-my-div-height="navbar" minus-header="false">
        </div>
      </div>
  </div>
      <div class="container-fluid">
      <div class="row page-header page-header-top">
        <div class="page-inner col-md-10 col-lg-10 col-md-offset-1">
          <div class="row">
            <div class="title col-md-7 col-lg-7 col-md-offset-2">
              <h1>Gallery</h1>
            </div>
          </div>
        </div>  
      </div> <!-- row -->
    </div> <!-- fluid container -->

    <!-- page header bottom -->
    <div class="container-fluid">
      <div class="row page-header page-header-bottom">
        <div class="page-inner col-md-10 col-md-offset-1">
          <div class="row">
            <div class="col-md-7 col-lg-7 col-md-offset-2">
              <a href="https://www.flickr.com/photos/129749000@N03/"> <h4>Follow us on Flickr</h4></a>
            </div>
          </div>
        </div> 
      </div> <!-- row -->
    </div> <!-- fluid container -->


  <div id ="entries" class="container-fluid">
    <div class="row module-body ">
      <div class="module-body-inner col-md-10 col-md-offset-1">
        <div class="row">
         <div class="col-md-3  no-padding-right">
          <div class="filter">

              <a ng-click="selectAlbum(photoset.id)" ng-repeat="photoset in data.photosetList.photosets.photoset" class=" btn btn-block btn-default btn-lg" ng-class="getAlbumClass(photoset.id)"><h4>{{photoset.title._content}}</h4></a>
            </div> <!-- filter -->
            <div class="hidden-xs hidden-sm">
              <?php get_sidebar(); ?>
            </div>
          </div>
          <div class="column-main">
            <div class="col-md-9">
              <div class="album-meta-data row">
                <div class="inner col-md-12">
                  <div class="description">
                    <h4>{{selectedAlbum.description._content}}</h4>
                  </div>
                  <div class="date">
                    <h5>Created on: {{selectedAlbum.date_create * 1000 | date: 'h:mma, EEEE, d MMMM yyyy'}}</h5>
                  </div>
                </div>   
              </div>
              <div class="flickr row">
                <div class="item col-sm-6 col-md-6" ng-repeat="photo in data.selectedAlbumPhotos.photoset.photo">
                  <a ng-click="openLightboxModal($index)">
                    <div class="item-description">
                      <div class="item-image-wrapper">
                        <img class="item-image img-thumbnail" ng-src="https://farm{{photo.farm}}.staticflickr.com/{{photo.server}}/{{photo.id}}_{{photo.secret}}_n.jpg" alt="">
                      </div>
                      <h5>{{photo.title}}</h5>
                    </div>
                  </a>
                </div>
              </div>
<!--                            
                <div class="pagination pull-left btn-group">
                    <a ng-repeat=
                       "page in data.events | filter:categoryFilterFn | pageCount:pageSize"
                       ng-click="selectPage($index + 1)" class="btn btn-default"
                       ng-class="getPageClass($index + 1)">
                        {{$index + 1}}
                    </a>
                </div> -->
             </div>
            <!-- </div>  -->
         </div> <!-- row -->
       </div> <!-- page body -->
    </div> <!-- row -->
  </div> <!-- container fluid -->
</div> <!-- ng controller -->


<?php get_footer(); ?>
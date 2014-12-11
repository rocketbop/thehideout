<div class="single-post secondary-page events events-single-page visible-links visible-links-red" ng-controller="eventCtrl">
  
  <div class="container-fluid">
    <div class="row">
      <div class="background-container col-xs-12 col-sm-12 col-md-12 col-lg-12" data-my-div-height="navbar" minus-header="false">
      </div>
    </div>

    <div class="row page-header page-header-top">
      <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
          <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-9 col-lg-9">
              <div class="row">
                <div class="col-xs-1 col-sm-1 col-md-9 col-lg-9 col-md-offset-3">
                  <h1>{{singlePost.event_name}}</h1>
                </div>
              </div>  
            </div>
          </div> <!-- row -->
      </div>  <!-- page header -->
    </div> <!-- row -->
  </div> <!-- fluid container -->
    <div class="container-fluid">
    <div class="row page-header page-header-bottom">
      <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
          <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-9 col-lg-9">
              <div class="row">
                <div class="col-xs-1 col-sm-1 col-md-9 col-lg-9 col-md-offset-3">
                  <h4>{{singlePost.date_of_event | date: 'EEEE, d MMMM'}}</h4>
                </div>
              </div>  
            </div>
          </div> <!-- row -->
      </div>  <!-- page header -->
    </div> <!-- row -->
  </div> <!-- fluid container -->

  <div class="container-fluid">
    <div class="row">
      <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <img class="featured-image" src="{{singlePost.featured_image.attachment_meta.sizes.eventboard.url}}">

            <div class="row">
              <div class="col-xs-1 col-sm-1 col-md-3 col-lg-3">
                <!-- Below used as test while on local host
                Substitute with singlepost.link when moving onto live server. -->
                <div class="fb-like" data-href="{{data.myTestURL}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
              </div>
              <div class="col-xs-1 col-sm-1 col-md-9 col-lg-9">
                <div ng-bind-html="singlePost.event_description"></div>
                <img class="separator" ng-src="{{templateDirectory}}images/design/guitar-separator.png">
              </div>
            </div>
          </div>

          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 no-padding-left">
            <div ng-include="sidebarUrl"></div>
          </div>
        </div> <!-- row -->
      </div>
    </div>

  </div> <!-- fluid container -->
</div> <!-- end event controller -->
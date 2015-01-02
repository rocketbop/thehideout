<div class="single-post secondary-page news news-single-page visible-links visible-links-aqua" ng-controller="newsCtrl">
  
  <div class="container-fluid">
    <div class="row">
      <div class="background-container col-xs-12 col-sm-12" data-my-div-height="navbar" minus-header="false">
      </div>
    </div>

    <div class="row page-header page-header-top">
      <div class="page-inner col-md-10 col-md-offset-1">
          <div class="row">
            <div class="col-xs-12 col-md-9">
              <div class="row">
                <div class="col-md-9 col-md-offset-3">
                  <h1>{{singlePost.title}}</h1>
                </div>
              </div>  
            </div>
          </div> <!-- row -->
      </div>  <!-- page header -->
    </div> <!-- row -->
  </div> <!-- fluid container -->
    <div class="container-fluid">
    <div class="row page-header page-header-bottom">
      <div class="page-inner col-md-10 col-md-offset-1">
          <div class="row">
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-9 col-md-offset-3">
                  <h4>Posted: {{singlePost.date | date: 'h:mma, EEEE, d MMMM yyyy'}}</h4>
                </div>
              </div>  
            </div>
          </div> <!-- row -->
      </div>  <!-- page header -->
    </div> <!-- row -->
  </div> <!-- fluid container -->

  <div class="container-fluid">
    <div class="row module-body">
      <div class="module-body-inner col-md-10 col-md-offset-1">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-9">
            <img class="featured-image" src="{{singlePost.featured_image.attachment_meta.sizes.eventboard.url}}">
            <div class="row">
              <div class="col-md-3 col-lg-3">
                <div class="social-buttons">
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6">
                   <!-- Below used as test while on local host
                  Substitute with singlepost.link when moving onto live server. -->
                    <div class="fb-like" data-href="{{data.myTestURL}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-via="paulbyrne">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                  </div>
                </div>
                 
                </div>
<!--                 <div class="date-published">
                  <h6>Posted: {{singlePost.date | date: 'EEEE, d MMMM yyyy, h:mm' }}</h6>
                </div>  -->         
              </div>
              <div class="col-md-9 col-lg-9">
                <div ng-bind-html="singlePost.content"></div>
                <img class="separator" ng-src="{{templateDirectory}}images/design/pint-separator.png">
              </div>
            </div>
          </div>
          <div class="hidden-xs hidden-sm col-md-3 col-lg-3 no-padding-left">
            <div ng-include="sidebarUrl"></div>
          </div>
        </div> <!-- row -->
      </div>
    </div>

  </div> <!-- fluid container -->
</div> <!-- end event controller -->

<div ng-include src="htmlTemplatesDirectory + 'module_header_inner_template.html'"></div>

<div class="container-fluid">
  <div class="row module-body">
    <div class="module-body-inner col-md-10 col-md-offset-1">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-offset-0 col-md-4 col-lg-5">

          <div class="events-sidebar">
            
            <div ng-if="numberOfFutureEvents > 1" class="item-header upcoming">
              <h3>Coming Up:</h3>
            </div>

            <div class="item-upcoming-sidebar">
              <div ng-repeat="event in data.events | orderBy:'date' | filter: futureEvents | limitTo: 3 " ng-if="$index != 0" class="item">
                <!-- <div ng-include src="templateDirectory + 'angular/templates/music_module_sidebar_template.html'"></div> -->
                <div ng-include src="htmlTemplatesDirectory + 'music_module_sidebar_template.html'"></div>
              </div>
            </div>

            <div ng-if="numberOfFutureEvents < 4" class="item-header previous">
             <h3>Previous:</h3>
            </div>
            <div class="item-previous-sidebar">
              <div ng-repeat="event in data.events | orderBy:'date' | filter: pastEvents | limitTo:previousLimit " class="item">
                <div ng-include src="htmlTemplatesDirectory + 'music_module_sidebar_template.html'"></div>
              </div>
            </div>
          </div> <!-- events sidebar -->


          <div class="social-buttons">
            <h3>Follow Our Social Networks:</h3>
            <div class="row">
              <div class="col-xs-2 col-xs-offset-3 col-md-4 col-md-offset-0 col-lg-2 col-lg-offset-3">
                  <div class="social-icons">
                    <img ng-src="{{templateDirectory}}images/social-icons/twitter-2.png" alt="Twitter">
                  </div>
              </div>
              <div class="col-xs-2 col-md-4 col-lg-2">
                <a href="https://www.facebook.com/pages/Joeys-Hideout/345530658898470">
                  <div class="social-icons">
                    <img ng-src="{{templateDirectory}}images/social-icons/facebook.png" alt="Facebook Page">
                  </div>
                </a>
              </div>
              <div class="col-xs-2 col-md-4 col-lg-2">
                <a href="https://www.flickr.com/photos/129749000@N03/"> 
                  <div class="social-icons">
                    <img ng-src="{{templateDirectory}}images/social-icons/flickr-3.png" alt-"Flickr Gallery">
                  </div>
                </a>
              </div>
            </div>
          </div> <!-- social buttons -->

        </div>

        <div class="col-sm-12 col-md-8 col-lg-7">
          <div ng-repeat="event in data.events | orderBy:'date' |  filter: futureEvents | limitTo: '1' ">
            <a href="{{event.link}}">
              <div class="item item-next-event">
                <div class="row">
                  <div class="col-xs-4 col-sm-5 col-md-3 col-lg-3">
                    <div class="item-description">
                      <h4>Next Event:</h4>
                      <h3>{{event.event_name}}</h3>
                      <h5>{{event.date_of_event | date: 'EEEE, d MMMM yyyy'}}</h5>
                    </div>
                  </div>
                  <div class=" col-xs-8 col-sm-7 col-md-9 col-lg-9">
                  <div class="item-image-wrapper">
                    <img class="item-image" ng-src="{{event.featured_image.attachment_meta.sizes.eventboard.url}}">
                    </div>
                  </div>
                </div> 
              </div>
            </a>
          </div>
        
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
              <div class="item-facilities-header">
                <h3>Facilities</h3>
              </div>
            </div>
          </div>

          <div class="item-facilities-items">
            <div class="row">
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <a href="{{rootDirectory}}facilities/index.php#sound">
                  <div class="item item-sound">
                    <div class="item-image-wrapper">
                      <img class="featured-image" ng-src="{{templateDirectory}}images/facilities/design-speakers-250x150.jpg">
                    </div>
                    <h4>Great Sound</h4>
                  </div>
                </a>
              </div>
               <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <a href="{{rootDirectory}}facilities/index.php#stage">
                  <div class="item item-stage">
                    <div class="item-image-wrapper">
                      <img class="featured-image" ng-src="{{templateDirectory}}images/facilities/design-stage-250x150.jpg">
                    </div>
                    <h4>Our Stage</h4>
                  </div>
                </a>
              </div>
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <a href="{{rootDirectory}}facilities/index.php#smoking-area">
                  <div class="item item-smoking">
                    <div class="item-image-wrapper">
                      <img class="featured-image" ng-src="{{templateDirectory}}images/facilities/design-smoking-area-250x150.jpg">
                    </div>
                    <h4>Refurbished Smoking Area</h4>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="contact-section item">
            <div class="row">
              <div class="contact-actions col-sm-12 col-md-6 col-lg-6">
                <h3>Event Bookings</h3>
                <a href="{{rootDirectory}}contact" class="btn btn-primary btn-lg">Contact Us</a>
                <p>The Hideout is a great location for gigs, parties, and receptions. Get in touch with us about booking the Hideout for your event.</p>
              </div>
               <div class="contact-image col-sm-12 col-md-6 col-lg-6">
                <a href="{{rootDirectory}}contact">
                  <div class="item-image-wrapper">
                    <img class="featured-image" ng-src="{{templateDirectory}}images/bar/bar-lamps-600.jpg">
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- module body inner -->
  </div> <!-- module body -->
</div> <!-- container fluid -->  


  
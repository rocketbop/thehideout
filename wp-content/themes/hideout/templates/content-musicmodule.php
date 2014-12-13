<div class="container-fluid">
  <div class="row module-header">

    <div class="module-header-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
      <h3>Music at The Hideout</h3>
    </div>
  </div>
</div> <!-- container-fluid -->

<div class="container-fluid">
  <div class="row module-body">
    <div class="module-body-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
      <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-5">

          <div class="item-upcoming-header">
            Coming Up:
          </div>
          <div class="item-upcoming-sidebar">
            <div ng-repeat="event in data.events | orderBy:'date' | filter: futureEvents " ng-if="$index != 0" class="item">

              <div class="hidden-lg">
              <a href="{{event.link}}">
                <img src="{{event.featured_image.attachment_meta.sizes.sidebarimg.url}}">
                <h4>{{event.event_name}}</h4>
                <h5>{{event.date_of_event | date: 'EEEE, d MMMM yyyy'}}</h5>
              </a>
              </div> <!-- hidden lg -->

              <div class="visible-lg">
                <div class="row">
                  <div class="col-lg-7">
                    <img src="{{event.featured_image.attachment_meta.sizes.medium.url}}">
      
                  </div>
                  <div class="description col-lg-5">
                     <h3>{{event.event_name}}</h3>
                    <h4>{{event.date_of_event | date: 'EEEE, d MMMM yyyy'}}</h4>
                    <div ng-bind-html="event.event_description | limitTo: '100' "></div>
                  </div>
                </div>
              </div> <!-- visible lg -->

            </div>
          </div>

        </div>

        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-7">

          <div ng-repeat="event in data.events | orderBy:'date' |  filter: futureEvents | limitTo: '1' " class="item-next-event">
            <div class="row">
             
              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="item-description">
                  <h4>Next Event:</h4>
                  <h3>{{event.event_name}}</h3>
                   <h5>{{event.date_of_event | date: 'EEEE, d MMMM yyyy'}}</h5>
                </div>
              </div>

               <div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
                <img class="item-image" ng-src="{{event.featured_image.attachment_meta.sizes.eventboard.url}}">
              </div>

            </div>
            
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
                <div class="item item-sound">
                  <img class="featured-image" ng-src="{{templateDirectory}}images/facilities/design-speakers-250x150.jpg">
                  <h4>Great Sound</h4>
                </div>
              </div>
               <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="item item-stage">
                  <img class="featured-image" ng-src="{{templateDirectory}}images/facilities/design-stage-250x150.jpg">
                  <h4>Our Stage</h4>
                </div>
              </div>
               <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="item item-smoking">
                  <img class="featured-image" ng-src="{{templateDirectory}}images/facilities/design-smoking-area-250x150.jpg">
                  <h4>Refurbished Smoking Area</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
          <div class="item-welcome">
             <div class="row">
               <div class="col-md-6 col-lg-6">
                 <img class="featured-image" ng-src="{{templateDirectory}}images/singer-stock-600x450.jpg">
               </div>
                <div class="col-md-6 col-lg-6">
                 <h2>The Hideout Loves Live Music</h2>
                 <h4>Find out about upcoming events, check out our social networks, or get in touch if you want to enquire about holding an gig or some other kind of event in The Hideout.</h4>
               </div>
             </div>
          </div>
         
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <div class="contact-section">
           <div class="item item-events-page">
            <h4>See our Events Page for full details</h4>
            <button>EVENTS PAGE</button>
          </div>
          <div class="item item-contact">
             <h4>Get in touch to book an event</h4>
            <button>Contact Us</button>
   
          </div>
          <div class="item social-buttons">
            <h4>Follow Us on Facebook or Twitter</h4>
          </div>
          </div> <!-- contact section -->
        </div>

      </div>
    </div> <!-- module body inner -->
  </div> <!-- module body -->
</div> <!-- container fluid -->  


  
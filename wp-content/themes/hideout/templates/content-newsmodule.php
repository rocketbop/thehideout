

<div class="container-fluid">
  <div class="row module-header">

    <div class="module-header-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
      <h3>Hideout News</h3>
    </div>
  </div>
</div> <!-- container-fluid -->

<div class="container-fluid">
  <div class="row module-body">
    <div class="module-body-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
      <div class="row">
        <div class="news-section col-xs-9 col-sm-9 col-md-9 col-lg-9">

          <div class="item item-1">
            <a class="item-link" href="{{data.newsPosts[0].link}}">
              <div class="row">
                <div class="item-text col-xs-12 col-sm-4 col-md-4 col-lg-4">
                   <div class="item-date item-box">
                     <h5>{{data.newsPosts[0].date | date: 'medium' }}</h5>
                    </div>
                    <div class="item-headline item-box">
                      <h3>{{data.newsPosts[0].title}}</h3>
                      <p><span class="content" ng-bind-html="data.newsPosts[0].content |limitTo: 80"></span><strong> READ MORE</strong></p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                  <div class="item-image-wrapper">
                    <div class="item-image" data-news-background-image="1">
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">

              <div class="item item-2">
                <a class="item-link" href="{{data.newsPosts[1].link}}">
                  <div class="item-image-wrapper">
                    <div class="item-image" data-news-background-image="2">
                    </div>
                  </div>
                  <div class="item-text row">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                      <div class="item-headline item-box">
                        <strong><h4>{{data.newsPosts[1].title}}</h4></strong>
                      </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                       <div class="item-date item-box">
                        <h5>{{data.newsPosts[1].date | date: 'medium' }}</h5>
                      </div>
                    </div>
                  </div>      
                </a>
              </div>

              <div class="item item-3">
                <a class="item-link" href="{{data.newsPosts[2].link}}">
                  <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                      <div class="item-image-wrapper">
                        <div class="item-image" data-news-background-image="3"></div>
                      </div>
                    </div>
                    <div class=" item-text col-xs-8 col-sm-8 col-md-8 col-lg-8">
                      <p><h4>{{data.newsPosts[2].title}}</h4></p>
                      
                      <h5>{{data.newsPosts[1].date | date: 'medium' }}</h5>
                    </div>
                  </div>
                </a>
              </div> <!-- end item 3 -->

        



            </div> <!-- end col8 -->

            <div class="no-padding-left col-xs-4 col-sm-4 col-md-4 col-lg-4">

              <div class="item item-4">
                <a class="item-link" href="{{data.newsPosts[3].link}}">
                  <div class="item-image-wrapper">
                    <div class="item-image" data-news-background-image="4"></div>
                  </div>
                  <div class="item-text">
                    <strong><h4>{{data.newsPosts[3].title}}</h4></strong>
                    <p><span class="content" ng-bind-html="data.newsPosts[2].content |limitTo: 80"></span><strong> READ MORE</strong></p>
                  </div>
                </a>
              </div>
              
            </div>


          </div>

        </div>




        <div class="twitter-section no-padding-left col-xs-3 col-sm-3 col-md-3 col-lg-3">
          <div class="twitter-widget">
            <a class="twitter-timeline" href="https://twitter.com/paulbyrne" height="540px" data-widget-id="527117394250964992">Tweets by @paulbyrne</a>
            <script>
              !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
            </script>
            
          </div>
        </div>
      </div> <!-- end row -->

      <div class="row image-section">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <img src="http://placehold.it/350x150">
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <img src="http://placehold.it/350x150">
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <img src="http://placehold.it/350x150">
        </div>
        
      </div>

    
    </div> <!-- end module body inner -->
  </div> <!-- end module body -->
</div> <!-- end container -->
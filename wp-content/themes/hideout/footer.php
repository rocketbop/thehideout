<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Hideout
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

				    <!-- page footer top -->
		<div class="container-fluid">
		  <div class="row">
        <div class="background-container col-xs-12" data-my-div-height="full">
          <div class="row page-footer page-footer-top">
            <div class="page-inner col-md-10 col-lg-10 col-md-offset-1">
            
              <!-- XS LAYOUT -->
              <div class="row visible-xs">
                <div class="col-xs-3 col-xs-offset-3">
                  <div class="social-icons">
                    <img ng-src="{{templateDirectory}}images/social-icons/twitter-2.png" alt="Twitter">
                  </div>
                </div>
                <div class="col-xs-3">
                  <a href="https://www.facebook.com/pages/Joeys-Hideout/345530658898470">
                    <div class="social-icons">
                      <img ng-src="{{templateDirectory}}images/social-icons/facebook.png" alt="Facebook Page">
                    </div>
                  </a>
                </div>

                <div class="col-xs-3 col-xs-offset-3">
                  <a href="https://www.flickr.com/photos/129749000@N03/" 
                    <div class="social-icons">
                      <img ng-src="{{templateDirectory}}images/social-icons/flickr-3.png" alt-"Flickr Gallery">>
                    </div>
                  </a>
                </div>
                <div class="col-xs-3">
                  <a href="{{rootDirectory}}contact">
                    <div class="social-icons"> 
                      <img ng-src="{{templateDirectory}}images/social-icons/email-1.png" alt="Contact Us">
                    </div>
                  </a>
                </div>
              </div>

              <div class="visible-xs col-xs-12">
                <a href="{{rootDirectory}}">
                  <div class="address">
                    <h2>THE HIDEOUT BAR</h2>
                    <h5>Main Street, Kilcullen, Co Kildare, Ireland</h5>
                  </div>
                </a>
              </div>

              <!-- 768PX+ LAYOUT -->

              <div class="row hidden-xs">
              	<div class="col-sm-1 col-md-1 col-lg-1 col-sm-offset-2">
                  <div class="social-icons">
                		<img ng-src="{{templateDirectory}}images/social-icons/twitter-2.png"  alt="Twitter">
                  </div>
                </div>
                <div class=" col-sm-1 col-md-1 col-lg-1">
                  <a href="https://www.facebook.com/pages/Joeys-Hideout/345530658898470">
                    <div class="social-icons">
                      <img ng-src="{{templateDirectory}}images/social-icons/facebook.png" alt="Facebook Page">
                    </div>
                  </a>
                </div>

              	<div class="col-sm-4 col-md-4">
                  <a href="{{rootDirectory}}">
                    <div class="address">
                      <h2>THE HIDEOUT BAR</h2>
                      <h5>Main Street, Kilcullen, Co Kildare, Ireland</h5>
                    </div>
                  </a>
                </div>

                <div class="col-sm-1  col-md-1 col-lg-1">
                  <a href="https://www.flickr.com/photos/129749000@N03/">
                    <div class="social-icons">
                      <img ng-src="{{templateDirectory}}images/social-icons/flickr-3.png" alt-"Flickr Gallery">>
                    </div>
                  </a>
                </div>
                <div class="col-sm-1  col-md-1 col-lg-1">
                  <a href="{{rootDirectory}}contact">
                    <div class="social-icons"> 
                      <img ng-src="{{templateDirectory}}images/social-icons/email-1.png" alt="Contact Us">
                    </div>
                  </a>
                </div>
              </div>
            </div>  <!-- page inner -->
          </div> <!-- row -->
        </div>
      </div>
		</div>	

		    <!-- page footer bottom -->
    <div class="container-fluid">
      <div class="row page-footer page-footer-bottom">
        <div class="page-inner col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
        <div class="row">
        </div>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

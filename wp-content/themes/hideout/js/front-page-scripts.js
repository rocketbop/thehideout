
jQuery(document).ready(function($) {

  // hover transformations on the News section
  $('.news-section div.item').hover(
    function() {
      $(this).addClass('hovered');
    },
    function() {
      $(this).removeClass('hovered');
    });

  // set the height of the welcome spash to the inner height of the window
  setSplashHeight(); // Set the initial size of the splash
  $(window).resize(setSplashHeight); //Resize the splash on window resize

  function setSplashHeight () {
    var windowHeight = $(window).get(0).innerHeight;
    $('.front-page-top-background').css('height', windowHeight);
    // alert("Hello");
  };

});

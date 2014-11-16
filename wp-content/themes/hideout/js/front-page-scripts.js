

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
  // setTopBackgroundHeight("full", ".front-page-top-background"); // Set the initial size of the splash
  setMessagePosition();
  setFoodModule();

  // $(window).resize(setTopBackgroundHeight("full", ".front-page-top-background")); //Resize the splash on window resize
  $(window).resize(setFoodModule); //Resize the splash on window resize


  function setMessagePosition () {
    var windowHeight = $(window).get(0).innerHeight;
    $(".front-page-top-message").css('padding-top', (windowHeight / 3)); 
  }

  function setFoodModule () { 
    var windowHeight = $(window).get(0).innerHeight;
    $('.food-module').css('height', windowHeight);     
  };

  $(window).scroll(function(i){
    $('.front-page-top-message').css({'opacity':( 200-$(window).scrollTop() )/200});
  })
});



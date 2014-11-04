
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
  setSplash(); // Set the initial size of the splash
  $(window).resize(setSplash); //Resize the splash on window resize

  function setSplash () {
    var windowHeight = $(window).get(0).innerHeight;
    $('.front-page-top-background').css('height', windowHeight)
      .find('.front-page-top-message').css('margin-top', (windowHeight / 4));     
  };

  $(window).scroll(function(i){
    $('.front-page-top-message').css({'opacity':( 200-$(window).scrollTop() )/200});
  })
});



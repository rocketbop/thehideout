
jQuery( document ).ready(function( $ ) {
  // Code using $ as usual goes here.
  $(window).scroll(function() {
    if ($(document).scrollTop() > 100) {
      $('.navbar-container').addClass('opaque-thin');
    } else {
      $('.navbar-container').removeClass('opaque-thin');
    }
  });
});

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

function setTopBackgroundHeight (screenProportion, backgroundDiv) {

  var heightModifier,
      windowHeight;

  // check how much of the screen should take up
  switch (screenProportion) {
    case "full":
    heightModifier = 1;
    break;
    case "half":
    heightModifier = 0.5;
    break
    default:
    heightModifier = 1;
  }

 windowHeight = jQuery(window).get(0).innerHeight * heightModifier;
  jQuery(backgroundDiv).css('height', windowHeight);    
};
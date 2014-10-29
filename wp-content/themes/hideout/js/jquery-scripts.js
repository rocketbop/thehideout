
jQuery(document).ready(function($) {
  $('.news-section div.item').hover(
    function() {
      $(this).find('img').addClass('hovered');
    },
    function() {
      $(this).find('img').removeClass('hovered');
    });
});



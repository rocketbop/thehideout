angular.module("theHideoutApp", [, "customFilters", "ui.unique", "angular.filter", "ngSanitize", "angularUtils.directives.dirPagination", "bootstrapLightbox"])
  .constant('templateDirectory', "http://localhost:8888/wp-content/themes/hideout/")
  .config(function(FlickrProvider) {
    FlickrProvider.setApiKey('a731f843f7585f4100829dd08d796574');
    FlickrProvider.setUserID('129749000@N03');
  })
  .config(function (templateDirectory, LightboxProvider) {

    // set a custom template
    LightboxProvider.templateUrl = templateDirectory + 'angular/templates/lightbox_template.html';

    LightboxProvider.getImageUrl = function (image) {
    // return '/base/dir/' + image.getName();

    // Create the url to be fetched for the lightbox: the letter at the end sets the image size, see: https://www.flickr.com/services/api/misc.urls.html
    return 'https://farm' + image.farm + '.staticflickr.com/' + image.server + '/' + image.id + '_' + image.secret + '_b.jpg';
    }
  });

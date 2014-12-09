angular.module("theHideoutApp", [, "customFilters", "ui.unique", "ngSanitize", "angularUtils.directives.dirPagination"])
  .constant('templateDirectory', "http://localhost:8888/wp-content/themes/hideout/")
  .config(function(FlickrProvider) {
  FlickrProvider.setApiKey('a731f843f7585f4100829dd08d796574');
  FlickrProvider.setUserID('129749000@N03');
});

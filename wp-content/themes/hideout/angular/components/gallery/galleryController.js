angular.module('theHideoutApp')
  .controller('galleryCtrl', ['$scope', 'Flickr', function ($scope, Flickr) {

   Flickr.getPhotosetList()
    .success(function (data) {
      $scope.photosetList = data;
      console.log($scope.photosetList);
    })
    .error(function (error) {
      console.log("That did not work.");
    });
    

  }])
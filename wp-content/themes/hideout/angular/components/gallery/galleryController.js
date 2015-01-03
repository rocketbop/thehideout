angular.module('theHideoutApp')
  .constant("albumActiveClass", "btn-secondary")
  .controller('galleryCtrl', ['$scope', '$timeout', 'Flickr', 'Lightbox', 'albumActiveClass', function ($scope, $timeout, Flickr, Lightbox, albumActiveClass) {

    // $scope.data = {}; This is now created in the MainCtrl
    $scope.selectedAlbumID = '';

    $scope.dataPromise = Flickr.getPhotosetList()
      .success(function (data) {
        $scope.data.photosetList = data;

        // Select most recent gallery as init
        $scope.selectedAlbumID = $scope.data.photosetList.photosets.photoset[0].id;

        $scope.getPhotosetPhotos = function (selectedAlbumID) {
          Flickr.getPhotosetPhotos(selectedAlbumID)
            .success(function (data) {
              $scope.data.selectedAlbumPhotos = data;
              console.log($scope.data.selectedAlbumPhotos);
            })
            .error(function (error) {
              console.log(error);
            }) 
          }

        $scope.getPhotosetPhotos($scope.selectedAlbumID);
        console.log($scope.data.photosetList);

      })
      .error(function (error) {
        console.log(error);
      });


      //$scope.sliderSets = $scope.getSliderSets();

      $scope.getSliderSets = function ($filter) {
        
        numberEvents = $filter('limitTo')($scope.data.photosetList, 3);
        return numberEvents;
      }

      $scope.openLightboxModal = function (index) {
        console.log($scope.data.selectedAlbumPhotos.photoset.photo);
        Lightbox.openModal($scope.data.selectedAlbumPhotos.photoset.photo, index);
      };

      $scope.selectAlbum = function (albumID) {
        // if the album id doesn't match refetch the data
        if ($scope.selectedAlbumID != albumID) {
          $scope.selectedAlbumID = albumID;
          $scope.getPhotosetPhotos($scope.selectedAlbumID);
        } 
      }

      $scope.getAlbumClass = function (albumID) {
        return ($scope.selectedAlbumID == albumID) ? albumActiveClass : ''; 
      }

    }])



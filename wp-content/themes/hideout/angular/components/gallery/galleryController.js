angular.module('theHideoutApp')
  .constant("albumActiveClass", "btn-secondary")
  .controller('galleryCtrl', ['$scope', '$timeout', 'Flickr', 'Lightbox', 'albumActiveClass', function ($scope, $timeout, Flickr, Lightbox, albumActiveClass) {

    $scope.selectedAlbumID = '';

    $scope.dataPromise = Flickr.getPhotosetList()
      .success(function (data) {
        $scope.data.photosetList = data;
        $scope.albumList = $scope.data.photosetList.photosets.photoset;

        // Select most recent gallery as init
        $scope.selectedAlbum = $scope.albumList[0];
        $scope.selectedAlbumID = $scope.selectedAlbum.id;

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
      })
      .error(function (error) {
        console.log(error);
      });

    $scope.getSelectedAlbum = function (albumID, albumList) {
      var album = [];
      for (var i = 0; i < albumList.length; i++) {
        console.log(albumList[i]);
        if (albumList[i].id == albumID) {
          album = albumList[i];
          break;
        }
      };
      return album;
    }
    $scope.openLightboxModal = function (index) {
      Lightbox.openModal($scope.data.selectedAlbumPhotos.photoset.photo, index);
    }
    $scope.selectAlbum = function (albumID) {
        $scope.selectedAlbumID = albumID;
        $scope.selectedAlbum = $scope.getSelectedAlbum($scope.selectedAlbumID, $scope.albumList);
        $scope.getPhotosetPhotos($scope.selectedAlbumID);
    }
    $scope.getAlbumClass = function (albumID) {
      return ($scope.selectedAlbumID == albumID) ? albumActiveClass : ''; 
    }
  }]);



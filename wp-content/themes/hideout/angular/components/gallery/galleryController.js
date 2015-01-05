angular.module('theHideoutApp')
  .constant("albumActiveClass", "btn-secondary")
  .controller('galleryCtrl', ['$scope', '$timeout', 'Flickr', 'Lightbox', 'albumActiveClass', function ($scope, $timeout, Flickr, Lightbox, albumActiveClass) {

    // $scope.data = {}; This is now created in the MainCtrl
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
              // console.log($scope.data.selectedAlbumPhotos);

            })
            .error(function (error) {
              console.log(error);
            }) 
          }

        $scope.getPhotosetPhotos($scope.selectedAlbumID);
        // console.log($scope.data.photosetList);

      })
      .error(function (error) {
        console.log(error);
      });


      $scope.getSelectedAlbum = function (albumID, albumList) {
        console.log("Hi");
        var album = [];

        for (var i = 0; i < albumList.length; i++) {
          console.log(albumList[i]);
          if (albumList[i].id == albumID) {
            console.log("got it");
            album = albumList[i];
            break;
          }
        };
        console.log(album);
        return album;
      }

      $scope.getSliderSets = function ($filter) {
        
        numberEvents = $filter('limitTo')($scope.data.photosetList, 3);
        return numberEvents;
      }

      $scope.openLightboxModal = function (index) {
        // console.log($scope.data.selectedAlbumPhotos.photoset.photo);
        Lightbox.openModal($scope.data.selectedAlbumPhotos.photoset.photo, index);
      };{}

      $scope.selectAlbum = function (albumID) {
        // if the album id doesn't match refetch the data
        if ($scope.selectedAlbumID != albumID) {
          $scope.selectedAlbumID = albumID;
        } 
          $scope.selectedAlbum = $scope.getSelectedAlbum($scope.selectedAlbumID, $scope.albumList);
          $scope.getPhotosetPhotos($scope.selectedAlbumID);

      }

      $scope.getAlbumClass = function (albumID) {
        return ($scope.selectedAlbumID == albumID) ? albumActiveClass : ''; 
      }

    }])



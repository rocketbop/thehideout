angular.module('theHideoutApp')
  .provider('Flickr', function() {
    var base = 'https://api.flickr.com/services',
        api_key = '',
        user_id = '';

    // Set our API key from the .config section of our app
    this.setApiKey = function(key) {
      api_key = key || api_key;
    }

    this.setUserID = function (ID) {
      user_id = ID || user_id;
    }

    // Service interface
    this.$get = function($http) {
      var service = {
        // Define our service API here
        getPhotosetList: function () {
          return $http( {
            method: 'GET',
            url: base + '/rest/',
            params: {
              'method': 'flickr.photosets.getList',
              'api_key': api_key,
              'user_id': user_id,
              'format': 'json',
              'nojsoncallback': 1
            }
          });
        },
        getPhotosetPhotos: function (photosetID) {
          return $http( {
            method: 'GET',
            url: base + '/rest/',
            params: {
              'method': 'flickr.photosets.getPhotos',
              'api_key': api_key,
              'photoset_id': photosetID,
              'format': 'json',
              'nojsoncallback': 1
            }
          })
        }
        
      };

      return service;
    }
  });
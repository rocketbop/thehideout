angular.module("theHideoutApp")
  .factory("globalService", function () {

    return {
      checkConsole: function () {
        console.log("Check 1");
      },

      // Takes full or half for screenProprtion, and the css specifier for its second
      setTopBackgroundHeight: function (screenProportion, targetDiv) {

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
        console.log(windowHeight);
        jQuery(targetDiv).css('height', windowHeight);    
      }
    };
  })
  .provider('Flickr', function() {
  var base = 'https://api.flickr.com/services',
      api_key = '',
      user_id = '';

  // Set our API key from the .config section
  // of our app
  this.setApiKey = function(key) {
    api_key = key || api_key;
  }

  this.setUserID = function (ID) {
    user_id = ID || user_id;
    console.log ("user_id" + user_id);
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

  // return $http.get('https://api.flickr.com/services/rest/?api_key=a731f843f7585f4100829dd08d796574&format=json&method=flickr.photosets.getList&nojsoncallback=1&user_id=129749000@N03');
      }
    };

    return service;
  }
});



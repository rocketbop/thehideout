angular.module("theHideoutApp")
  .constant("eventUrl", "http://localhost:8888/wp-json/posts?filter[category_name]=events")
  .constant("newsUrl", "http://localhost:8888/wp-json/posts?filter[category_name]=news")
  .factory("apiService", function ( $http, eventUrl, newsUrl) {
   
    return {
        getAllEvents: function() {
          return $http.get(eventUrl);
        },

        getAllNewsPosts: function() {
          return $http.get(newsUrl);
        }

   };

  });
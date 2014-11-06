angular.module("theHideoutApp")
  .constant("eventUrl", "http://localhost:8888/wp-json/posts?filter[category_name]=events")
  .constant("blogUrl", "http://localhost:8888/wp-json/posts?filter[category_name]=blog")
  .factory("apiService", function ( $http, eventUrl, blogUrl) {
   
    return {
        getAllEvents: function() {
          return $http.get(eventUrl);
        },

        getAllBlogPosts: function() {
          return $http.get(blogUrl);
        }

   };

  });
angular.module("theHideoutApp")
  .constant("eventUrl", "http://localhost:8888/thehideout/wp-json/posts?filter[category_name]=events")
  .factory("eventService", function ( $http, eventUrl) {
   
  return {
      getAllEvents: function() {
        this.doSomething();
        return $http.get(eventUrl);
      },

      doSomething: function() {
        console.log("Do Something");
      }

 };

  });
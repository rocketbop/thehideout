angular.module("customFilters", [])
  .filter("range", function ($filter) {
    return function (data, page, size) {
      if (angular.isArray(data) && angular.isNumber(page) && angular.isNumber(size)) {
        var start_index = (page - 1) * size;
        if (data.length < start_index) {
          return [];
        } else {
          return $filter("limitTo")(data.splice(start_index), size);
        }
        } else {
          return data;
        } 
      }
  })
  .filter("pageCount", function () {
    return function (data, size) {
      if (angular.isArray(data)) {
        var result = [];
          for (var i = 0; i < Math.ceil(data.length / size) ; i++) {
            result.push(i);
          }
          return result;
      } else {
        return data;
      }
    }
  })
  .filter("stringToDate", function () {
    return function (string) {
      var date = new Date(string);
      return date;
    }
  })
  .filter('omitEndedEvents', function () {

    // check if the date of the item is earlier than today, and omit it if so
    return function (data) {
      var today = new Date().getTime();
      if (angular.isArray(data)) {
        for (var i = 0; i < data.length; i++) {
          if (today > data[i].date_of_event) {
            data.splice([i], 1);
          }
        }        
      }      
      return data;
    }
  });
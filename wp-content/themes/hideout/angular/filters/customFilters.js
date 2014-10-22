angular.module("customFilters", [])
    .filter("unique", function () {
        return function (data, propertyName) {
            if (angular.isArray(data) && angular.isString(propertyName)) {
                var results = [];
                var keys = {};
                for (var i = 0; i < data.length; i++) {
                    var val = data[i][propertyName];
                    // console.log(keys[val]);
                    if (angular.isUndefined(keys[val])) {
                        keys[val] = true;
                        results.push(val);
                        console.log(results);
                    }
            }   
                return results;
            } else {
                return data;
            }
  }
});
angular.module("theHideoutApp")
  .directive("myDivHeight", function () {
    return function (scope, element, attrs) {
      
      var screenProportion = attrs["myDivHeight"];
      var windowHeight;
      
      switch (screenProportion) {
        case "fullScreen":
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
      element.css('height', windowHeight + "px");

    }
  });
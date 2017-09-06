var devArt;
(function (devArt) {
    var sidebar;
    (function (sidebar_1) {
        'use strict';
        var CategoryButtonDirective = (function () {
            function CategoryButtonDirective() {
                this.restrict = 'A';
            }
            CategoryButtonDirective.instance = function () {
                return new CategoryButtonDirective;
            };
            CategoryButtonDirective.prototype.link = function (scope, element, attr) {
                var sidebar = $('#sidebar');
                setTimeout(function () {
                    new Waypoint({
                        element: element[0],
                        handler: function (direction) {
                            if (direction == 'down') {
                                addClass(element, 'fixed_category');
                                addClass(sidebar, 'fixed_sidbar_navigation');
                                setTimeout(function () {
                                    addClass(element, 'show_fixed_category');
                                }, 500);
                            }
                            else {
                                removeClass(element, 'fixed_category show_fixed_category');
                                removeClass(sidebar, 'fixed_sidbar_navigation');
                            }
                        },
                        offset: -100
                    });
                }, 1);
                function addClass(element, className) {
                    element.addClass(className);
                }
                function removeClass(element, className) {
                    element.removeClass(className);
                }
            };
            return CategoryButtonDirective;
        })();
        angular.module('devArt').directive('categoryButton', CategoryButtonDirective.instance);
    })(sidebar = devArt.sidebar || (devArt.sidebar = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=categorybutton.directive.js.map
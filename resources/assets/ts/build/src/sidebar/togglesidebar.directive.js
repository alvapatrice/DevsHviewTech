var devArt;
(function (devArt) {
    var sidebar;
    (function (sidebar) {
        'use strict';
        var ToggleSidebar = (function () {
            function ToggleSidebar() {
                this.restrict = 'A';
            }
            ToggleSidebar.instance = function () {
                return new ToggleSidebar;
            };
            ToggleSidebar.prototype.link = function (scope, element, attr) {
                var elementId = element.attr('id');
                function toggleElements(newValue, class1, class2) {
                    if (newValue) {
                        element.addClass(class1)
                            .removeClass(class2);
                    }
                    else {
                        element.addClass(class2)
                            .removeClass(class1);
                    }
                }
                scope.$watch(attr.toggleSidebar, function (newValue, oldValue) {
                    if (elementId == 'sidebarRight') {
                        //element is right side bar ( bookmarks )
                        toggleElements(newValue, 'sidebar-right-show', 'sidebar-right-hide');
                    }
                    else {
                        //element is left side bar ( category )
                        toggleElements(newValue, 'sidebar-show', 'sidebar-hide');
                    }
                });
            };
            return ToggleSidebar;
        })();
        angular.module('devArt').directive('toggleSidebar', ToggleSidebar.instance);
    })(sidebar = devArt.sidebar || (devArt.sidebar = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=togglesidebar.directive.js.map
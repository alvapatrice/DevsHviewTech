module devArt.sidebar {
    'use strict';

    interface ISidebarAttrs extends ng.IAttributes {
        toggleSidebar : string;
    }
    class ToggleSidebar implements ng.IDirective {
        static instance() : ng.IDirective {
            return new ToggleSidebar;
        }

        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ISidebarAttrs) {
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
                } else {
                    //element is left side bar ( category )
                    toggleElements(newValue, 'sidebar-show', 'sidebar-hide');
                }
            });
        }
    }

    angular.module('devArt').directive('toggleSidebar', ToggleSidebar.instance);
}
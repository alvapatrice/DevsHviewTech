module devArt.sidebar {
    'use strict';

    class CategoryButtonDirective implements ng.IDirective {
        
        static instance() : ng.IDirective {
            return new CategoryButtonDirective;
        }
        
        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes) {

            var sidebar : ng.IAugmentedJQuery = <ng.IAugmentedJQuery>$('#sidebar');

            setTimeout(function() {
                new Waypoint({
                    element : element[0],
                    handler : function(direction) {
                        if(direction == 'down') {
                            addClass(element, 'fixed_category');
                            addClass(sidebar, 'fixed_sidbar_navigation');
                            setTimeout(function() {
                                addClass(element, 'show_fixed_category')
                            }, 500);
                        }
                        else {
                            removeClass(element, 'fixed_category show_fixed_category');
                            removeClass(sidebar, 'fixed_sidbar_navigation');
                        }
                    },
                    offset : -100
                })
            }, 1);

            function addClass(element : ng.IAugmentedJQuery, className: string) {
                element.addClass(className);
            }

            function removeClass(element : ng.IAugmentedJQuery, className : string) {
                element.removeClass(className)
            }
        }
    }

    angular.module('devArt').directive('categoryButton', CategoryButtonDirective.instance);
}

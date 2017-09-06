module devArt.navigation {
    'use strict';

    class NavbarHoverDirective implements ng.IDirective {

        static instance() : ng.IDirective {
            return new NavbarHoverDirective;
        }

        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes) {

            var $pin = $('#pin span');

            element.hover(function() {

                element.removeClass('shrink');

            }, function() {

                if($pin.hasClass('active')) { return; }

                if($(document).scrollTop() > 100) {
                    element.addClass('shrink');
                }

            });

        }

    }

    angular.module('devArt').directive('navbarHover', NavbarHoverDirective.instance);
}
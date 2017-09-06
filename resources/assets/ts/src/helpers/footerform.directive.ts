module devArt.helpers {
    'use strict';

    class FooterFormDirective implements ng.IDirective {
        static instance() : ng.IDirective {
            return new FooterFormDirective;
        }

        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes) {
            element.find('input').on('focus', function() {
                element.addClass('blue-focus');
            });
            element.find('input').blur(function() {
                element.removeClass('blue-focus');
            });
        }
    }

    angular.module('devArt').directive('footeFormDirective', FooterFormDirective.instance);
}
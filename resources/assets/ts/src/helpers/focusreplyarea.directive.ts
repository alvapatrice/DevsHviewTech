module devArt.helpers {
    'use strict';

    class FocusReplyTextAreaDirective implements ng.IDirective {
        static instance() : ng.IDirective {
            return new FocusReplyTextAreaDirective;
        }

        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes) {
            element.on('click', function() {
                $('html, body').animate({
                    scrollTop: $(".cke_contents").offset().top-200
                }, 500);
            })
        }
    }

    angular.module('devArt').directive('focusReplyareaDirective', FocusReplyTextAreaDirective.instance);
}
module devArt.helpers {
    'use strict';

    class AttachBlankToAncher implements ng.IDirective {
        static instance() : ng.IDirective {
            return new AttachBlankToAncher;
        }

        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes) {
                element.find('a').attr('target', '_blank');
        }
    }
    angular.module('devArt').directive('attachBlanktargetAncherDirective', AttachBlankToAncher.instance);
}
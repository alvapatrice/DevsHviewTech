module devArt.bookmark {
    'use strict';

    class ButtonTextDirective implements ng.IDirective {
        static instance() : ng.IDirective {
            return new ButtonTextDirective;
        }

        restrict = 'AE';
        link(scope: ng.IScope, element : ng.IAugmentedJQuery, attr : IBookmarkAttributes) {
            scope.$watch(attr.bookmarkDirective, function (newValue : boolean, oldValue : boolean) {
                if (newValue) {
                    element.text('Remove from Bookmark')
                }
                else {
                    element.text('Add to Bookmark');
                }
            })
        }
    }

    angular.module('devArt').directive('btntextDirective', ButtonTextDirective.instance);
}

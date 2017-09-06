module devArt.bookmark {
    'use strict';


    class BookmarkNotice implements ng.IDirective {

        static instance() : ng.IDirective {
            return new BookmarkNotice;
        }

        restrict = 'AE';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr: IBookmarkAttributes) {
            scope.$watch(attr.bookmarkDirective, function(newValue : boolean, oldValue : boolean) {
                if (newValue) {
                    element.removeClass('hide')
                } else {
                    element.addClass('hide');
                }
            });
        }

    }

    angular.module('devArt').directive('bookmarkNotice', BookmarkNotice.instance);
}

module devArt.bookmark {
    'use strict';

    class BookmarkToggle implements ng.IDirective {

        static instance() : ng.IDirective {
            return new BookmarkToggle;
        }

        restrict = 'AE';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : IBookmarkAttributes) {
            scope.$watch(attr.bookmarkDirective, function(newValue : boolean, oldValue : boolean) {
                if (newValue) {
                    element.addClass('fa-star').removeClass('fa-star-o');
                    element.parent().find('h4').text('Favorited');
                }
                else {
                    element.addClass('fa-star-o').removeClass('fa-star');
                    element.parent().find('h4').text('Favorite');
                }
            });
        }

    }
    angular.module('devArt').directive('bookmarkToggle', BookmarkToggle.instance);
}

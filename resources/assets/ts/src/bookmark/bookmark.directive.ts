module devArt.bookmark {
    'use strict';

    export interface IBookmarkAttributes extends ng.IAttributes {
        bookmarkDirective : string
    }
    class BookmarkDirective implements ng.IDirective {

        static instance() : ng.IDirective {
            return new BookmarkDirective;
        }


        restrict = 'AE';
        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : IBookmarkAttributes) {
            scope.$watch(attr.bookmarkDirective, function( newVal : string, oldVal : string) {

                if(newVal) {
                    element.addClass('active');
                }
                else {
                    element.removeClass('active')
                }

            });
        }
    }

    angular.module('devArt').directive('bookmarkDirective', BookmarkDirective.instance);

}
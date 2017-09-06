var devArt;
(function (devArt) {
    var bookmark;
    (function (bookmark) {
        'use strict';
        var BookmarkToggle = (function () {
            function BookmarkToggle() {
                this.restrict = 'AE';
            }
            BookmarkToggle.instance = function () {
                return new BookmarkToggle;
            };
            BookmarkToggle.prototype.link = function (scope, element, attr) {
                scope.$watch(attr.bookmarkDirective, function (newValue, oldValue) {
                    if (newValue) {
                        element.addClass('fa-star').removeClass('fa-star-o');
                        element.parent().find('h4').text('Favorited');
                    }
                    else {
                        element.addClass('fa-star-o').removeClass('fa-star');
                        element.parent().find('h4').text('Favorite');
                    }
                });
            };
            return BookmarkToggle;
        })();
        angular.module('devArt').directive('bookmarkToggle', BookmarkToggle.instance);
    })(bookmark = devArt.bookmark || (devArt.bookmark = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=bookmarktoggle.directive.js.map
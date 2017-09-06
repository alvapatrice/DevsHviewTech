var devArt;
(function (devArt) {
    var bookmark;
    (function (bookmark) {
        'use strict';
        var BookmarkDirective = (function () {
            function BookmarkDirective() {
                this.restrict = 'AE';
            }
            BookmarkDirective.instance = function () {
                return new BookmarkDirective;
            };
            BookmarkDirective.prototype.link = function (scope, element, attr) {
                scope.$watch(attr.bookmarkDirective, function (newVal, oldVal) {
                    if (newVal) {
                        element.addClass('active');
                    }
                    else {
                        element.removeClass('active');
                    }
                });
            };
            return BookmarkDirective;
        })();
        angular.module('devArt').directive('bookmarkDirective', BookmarkDirective.instance);
    })(bookmark = devArt.bookmark || (devArt.bookmark = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=bookmark.directive.js.map
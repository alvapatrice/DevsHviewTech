var devArt;
(function (devArt) {
    var bookmark;
    (function (bookmark) {
        'use strict';
        var BookmarkNotice = (function () {
            function BookmarkNotice() {
                this.restrict = 'AE';
            }
            BookmarkNotice.instance = function () {
                return new BookmarkNotice;
            };
            BookmarkNotice.prototype.link = function (scope, element, attr) {
                scope.$watch(attr.bookmarkDirective, function (newValue, oldValue) {
                    if (newValue) {
                        element.removeClass('hide');
                    }
                    else {
                        element.addClass('hide');
                    }
                });
            };
            return BookmarkNotice;
        })();
        angular.module('devArt').directive('bookmarkNotice', BookmarkNotice.instance);
    })(bookmark = devArt.bookmark || (devArt.bookmark = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=bookmarknotice.directive.js.map
var devArt;
(function (devArt) {
    var bookmark;
    (function (bookmark) {
        'use strict';
        var ButtonTextDirective = (function () {
            function ButtonTextDirective() {
                this.restrict = 'AE';
            }
            ButtonTextDirective.instance = function () {
                return new ButtonTextDirective;
            };
            ButtonTextDirective.prototype.link = function (scope, element, attr) {
                scope.$watch(attr.bookmarkDirective, function (newValue, oldValue) {
                    if (newValue) {
                        element.text('Remove from Bookmark');
                    }
                    else {
                        element.text('Add to Bookmark');
                    }
                });
            };
            return ButtonTextDirective;
        })();
        angular.module('devArt').directive('btntextDirective', ButtonTextDirective.instance);
    })(bookmark = devArt.bookmark || (devArt.bookmark = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=buttontext.directive.js.map
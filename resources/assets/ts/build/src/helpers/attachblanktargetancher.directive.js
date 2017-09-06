var devArt;
(function (devArt) {
    var helpers;
    (function (helpers) {
        'use strict';
        var AttachBlankToAncher = (function () {
            function AttachBlankToAncher() {
                this.restrict = 'A';
            }
            AttachBlankToAncher.instance = function () {
                return new AttachBlankToAncher;
            };
            AttachBlankToAncher.prototype.link = function (scope, element, attr) {
                element.find('a').attr('target', '_blank');
            };
            return AttachBlankToAncher;
        })();
        angular.module('devArt').directive('attachBlanktargetAncherDirective', AttachBlankToAncher.instance);
    })(helpers = devArt.helpers || (devArt.helpers = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=attachblanktargetancher.directive.js.map
var devArt;
(function (devArt) {
    var helpers;
    (function (helpers) {
        'use strict';
        var FooterFormDirective = (function () {
            function FooterFormDirective() {
                this.restrict = 'A';
            }
            FooterFormDirective.instance = function () {
                return new FooterFormDirective;
            };
            FooterFormDirective.prototype.link = function (scope, element, attr) {
                element.find('input').on('focus', function () {
                    element.addClass('blue-focus');
                });
                element.find('input').blur(function () {
                    element.removeClass('blue-focus');
                });
            };
            return FooterFormDirective;
        })();
        angular.module('devArt').directive('footeFormDirective', FooterFormDirective.instance);
    })(helpers = devArt.helpers || (devArt.helpers = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=footerform.directive.js.map
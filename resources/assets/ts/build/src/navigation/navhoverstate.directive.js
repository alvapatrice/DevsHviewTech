var devArt;
(function (devArt) {
    var navigation;
    (function (navigation) {
        'use strict';
        var NavbarHoverDirective = (function () {
            function NavbarHoverDirective() {
                this.restrict = 'A';
            }
            NavbarHoverDirective.instance = function () {
                return new NavbarHoverDirective;
            };
            NavbarHoverDirective.prototype.link = function (scope, element, attr) {
                var $pin = $('#pin span');
                element.hover(function () {
                    element.removeClass('shrink');
                }, function () {
                    if ($pin.hasClass('active')) {
                        return;
                    }
                    if ($(document).scrollTop() > 100) {
                        element.addClass('shrink');
                    }
                });
            };
            return NavbarHoverDirective;
        })();
        angular.module('devArt').directive('navbarHover', NavbarHoverDirective.instance);
    })(navigation = devArt.navigation || (devArt.navigation = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=navhoverstate.directive.js.map
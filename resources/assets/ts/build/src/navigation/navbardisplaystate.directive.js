var devArt;
(function (devArt) {
    var navigation;
    (function (navigation) {
        'use strict';
        var NavbarDisplayStateController = (function () {
            function NavbarDisplayStateController($cookieStore) {
                this.$cookieStore = $cookieStore;
            }
            NavbarDisplayStateController.prototype.getCookie = function (cookieName) {
                return this.$cookieStore.get(cookieName);
            };
            NavbarDisplayStateController.$inject = ['$cookieStore'];
            return NavbarDisplayStateController;
        })();
        var NavbarDisplayState = (function () {
            function NavbarDisplayState() {
                this.restrict = 'AE';
                this.controller = NavbarDisplayStateController;
            }
            NavbarDisplayState.instance = function () {
                return new NavbarDisplayState();
            };
            NavbarDisplayState.prototype.link = function (scope, element, attr, controller) {
                var canSlide = controller.getCookie('navbarSlide');
                if (typeof canSlide !== "undefined") {
                    if (canSlide) {
                        scope.toggleDisplayState();
                        element.toggleClass('active');
                    }
                }
                element.on('click', function () {
                    scope.toggleDisplayState();
                    element.toggleClass('active');
                });
            };
            return NavbarDisplayState;
        })();
        angular.module('devArt').directive('navbarDisplayState', NavbarDisplayState.instance);
    })(navigation = devArt.navigation || (devArt.navigation = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=navbardisplaystate.directive.js.map
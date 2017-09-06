var devArt;
(function (devArt) {
    var navigation;
    (function (navigation) {
        'use strict';
        var NavThemeChangeController = (function () {
            function NavThemeChangeController($cookieStore) {
                this.$cookieStore = $cookieStore;
            }
            NavThemeChangeController.prototype.getCookie = function (cookieName) {
                return this.$cookieStore.get(cookieName);
            };
            NavThemeChangeController.prototype.putCookie = function (cookieName, cookieValue) {
                return this.$cookieStore.put(cookieName, cookieValue);
            };
            NavThemeChangeController.$inject = ['$cookieStore'];
            return NavThemeChangeController;
        })();
        var NavThemeChange = (function () {
            function NavThemeChange() {
                this.scope = true;
                this.restrict = 'AE';
                this.controller = NavThemeChangeController;
            }
            NavThemeChange.instance = function () {
                return new NavThemeChange;
            };
            NavThemeChange.prototype.link = function (scope, element, attr, controller) {
                var category_btn = $('.category-btn h1'), options_bar_options = $('.options-bar-options'), theme = controller.getCookie('theme');
                element.addClass('show-nav');
                scope.slideNavbarState = false;
                if (typeof theme !== "undefined") {
                    element.addClass(theme);
                    category_btn.addClass(theme + '-hover');
                    options_bar_options.addClass(theme);
                }
                function navbarSlide(newVal) {
                    if (!newVal) {
                        $(window).off('scroll');
                        return;
                    }
                    $(window).on('scroll', function () {
                        if ($(document).scrollTop() > 100) {
                            element.addClass('shrink');
                        }
                        else {
                            element.removeClass('shrink');
                        }
                    });
                }
                scope.$watch('slideNavbarState', function (newVal) {
                    controller.putCookie('navbarSlide', newVal);
                    navbarSlide(newVal);
                });
                scope.changeTheme = function (color) {
                    if (color == 'yellow') {
                        element.addClass('yellowBar').removeClass('darkGrayBar darkBlueBar blueBar');
                        category_btn.addClass('yellowBar-hover').removeClass('darkGrayBar-hover darkBlueBar-hover blueBar-hover');
                        options_bar_options.addClass('yellowBar').removeClass('darkGrayBar darkBlueBar blueBar');
                        controller.putCookie('theme', 'yellowBar');
                    }
                    else if (color == 'darkGray') {
                        element.addClass('darkGrayBar').removeClass('yellowBar darkBlueBar blueBar');
                        category_btn.addClass('darkGrayBar-hover').removeClass('yellowBar-hover darkBlueBar-hover blueBar-hover');
                        options_bar_options.addClass('darkGrayBar').removeClass('yellowBar darkBlueBar blueBar');
                        controller.putCookie('theme', 'darkGrayBar');
                    }
                    else if (color == 'blue') {
                        element.addClass('blueBar').removeClass('yellowBar darkBlueBar darkGaryBar');
                        category_btn.addClass('blueBar-hover').removeClass('yellowBar-hover darkBlueBar-hover darkGaryBar-hover');
                        options_bar_options.addClass('blueBar').removeClass('yellowBar darkBlueBar darkGaryBar');
                        controller.putCookie('theme', 'blueBar');
                    }
                    else {
                        element.addClass('darkBlueBar').removeClass('yellowBar darkGrayBar blueBar');
                        category_btn.addClass('darkBlueBar-hover').removeClass('yellowBar-hover darkGrayBar-hover blueBar-hover');
                        options_bar_options.addClass('darkBlueBar').removeClass('yellowBar darkGrayBar blueBar');
                        controller.putCookie('theme', 'darkBlueBar');
                    }
                };
                scope.toggleDisplayState = function () {
                    scope.slideNavbarState = !scope.slideNavbarState;
                };
            };
            return NavThemeChange;
        })();
        angular.module('devArt').directive('navThemeChange', NavThemeChange.instance);
    })(navigation = devArt.navigation || (devArt.navigation = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=navthemechange.directive.js.map
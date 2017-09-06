module devArt.navigation {
    'use strict';

    export interface INavigationScope extends ng.IScope {
        slideNavbarState : boolean;
        toggleDisplayState() : void;
        changeTheme(color : string) : void;
    }

    interface INavThemeChangeController {
        getCookie(cookieName : string) : string;
        putCookie(cookieName : string, cookieValue : string) : void;
    }

    class NavThemeChangeController implements INavThemeChangeController {

        static $inject = ['$cookieStore'];

        constructor(private $cookieStore : ng.cookies.ICookieStoreService ) {}

        getCookie(cookieName):string {
            return this.$cookieStore.get(cookieName);
        }
        putCookie(cookieName, cookieValue) : void {
            return this.$cookieStore.put(cookieName, cookieValue);
        }


    }

    class NavThemeChange implements ng.IDirective {

        static instance() : ng.IDirective {
            return new NavThemeChange;
        }
        scope = true;
        restrict = 'AE';
        controller = NavThemeChangeController;

        link(scope : INavigationScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes, controller : NavThemeChangeController) {

            var category_btn = $('.category-btn h1'),
                options_bar_options = $('.options-bar-options'),
                theme = controller.getCookie('theme');

            element.addClass('show-nav');
            scope.slideNavbarState = false;

            if ( typeof theme !== "undefined" ) {
                element.addClass(theme);
                category_btn.addClass(theme + '-hover');
                options_bar_options.addClass(theme);
            }


            function navbarSlide(newVal) {
                if( ! newVal ) {
                    $(window).off('scroll');
                    return;
                }

                $(window).on('scroll', function () {

                    if ($(document).scrollTop() > 100) {
                        element.addClass('shrink');
                    } else {
                        element.removeClass('shrink');
                    }
                });

            }
            scope.$watch('slideNavbarState', function(newVal) {
                controller.putCookie('navbarSlide', newVal)
                navbarSlide(newVal);
            });


            scope.changeTheme = function(color) {
                if(color == 'yellow')
                {
                    element.addClass('yellowBar').removeClass('darkGrayBar darkBlueBar blueBar');
                    category_btn.addClass('yellowBar-hover').removeClass('darkGrayBar-hover darkBlueBar-hover blueBar-hover');
                    options_bar_options.addClass('yellowBar').removeClass('darkGrayBar darkBlueBar blueBar');
                    controller.putCookie('theme', 'yellowBar')
                }
                else if(color == 'darkGray') {
                    element.addClass('darkGrayBar').removeClass('yellowBar darkBlueBar blueBar');
                    category_btn.addClass('darkGrayBar-hover').removeClass('yellowBar-hover darkBlueBar-hover blueBar-hover');
                    options_bar_options.addClass('darkGrayBar').removeClass('yellowBar darkBlueBar blueBar');
                    controller.putCookie('theme', 'darkGrayBar');
                }
                else if(color == 'blue')
                {
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
            }

            scope.toggleDisplayState = function() {
                scope.slideNavbarState = !scope.slideNavbarState;
            }

        }
    }


    angular.module('devArt').directive('navThemeChange', NavThemeChange.instance);
}

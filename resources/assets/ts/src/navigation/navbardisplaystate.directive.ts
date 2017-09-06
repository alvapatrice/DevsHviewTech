module devArt.navigation {
    'use strict';

    interface INavbarDisplayStateController {
        getCookie(cookieName : string) : string;
    }

    class NavbarDisplayStateController implements INavbarDisplayStateController {

        static $inject = ['$cookieStore'];

        constructor( private $cookieStore : ng.cookies.ICookieStoreService ) {}

        getCookie(cookieName):string {
            return this.$cookieStore.get(cookieName)
        }

    }

    class NavbarDisplayState implements ng.IDirective {

        static instance() : ng.IDirective {
            return new NavbarDisplayState()
        }

        restrict = 'AE';
        controller = NavbarDisplayStateController;
        link(scope : INavigationScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes, controller : NavbarDisplayStateController) {

            var canSlide = controller.getCookie('navbarSlide');

            if ( typeof canSlide !== "undefined" )
            {

                if( canSlide )
                {
                    scope.toggleDisplayState();
                    element.toggleClass('active');
                }
            }

            element.on('click', function() {
                scope.toggleDisplayState();
                element.toggleClass('active');
            });

        }
    }

    angular.module('devArt').directive('navbarDisplayState', NavbarDisplayState.instance);
}
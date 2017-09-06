module devArt.helpers {
    'use strict';

    class ModalImageListDirective implements ng.IDirective {
        static instance() : ng.IDirective {
            return new ModalImageListDirective;
        }

        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attrs : ng.IAttributes) : void {

            element.on('click', 'img', function () {
                $('#imageurlpath').val(element.attr('src'));
            });

        }
    }

    angular.module('devArt').directive('modalImagelistDirective', ModalImageListDirective.instance);
}
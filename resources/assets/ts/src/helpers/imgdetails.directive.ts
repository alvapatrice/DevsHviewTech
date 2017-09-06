module devArt.helpers {
    'use strict';

    class ImageDetailsDirective implements ng.IDirective {
        static instance() : ng.IDirective {
            return new ImageDetailsDirective;
        }

        restrict = 'A';

        link( scope : ng.IScope, element : ng.IAugmentedJQuery, attrs : ng.IAttributes) {

            element.on('click', function() {

                var $modal : any = $('#imagemodal'),
                    $modalImage = $('#modalImage');

                $modalImage.attr('src', element.data('name'));
                $modalImage.attr('alt', element.attr('alt'));
                $modal.modal('show');
            });
        }
    }

    angular.module('devArt').directive('imgDetailsDirective', ImageDetailsDirective.instance);
}
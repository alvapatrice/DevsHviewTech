module devArt.helpers {
    'use strict';

    class ImageSelectDirective implements ng.IDirective {
        static instance() : ng.IDirective {
            return new ImageSelectDirective;
        }

        restrict = 'A';

        link( scope : ng.IScope, element : ng.IAugmentedJQuery, attrs : ng.IAttributes) : void  {

            element.on('click', function (e) {
                var $image_val = $('#imageurlpath').val();
                if ($image_val == "") {
                    alert('Please Select an Image');
                    e.stopPropagation();
                }
                else {
                    $('#image').val($image_val);
                }
            });
        }

    }

    angular.module('devArt').directive('imageSelectDirective', ImageSelectDirective.instance);
}
module devArt.viewtype {
    'use strict';

    interface IImageAttributes extends ng.IAttributes {
        imageSrc : string
    }
    class ImageDirective implements ng.IDirective {

        static instance() {
            return new ImageDirective;
        }

        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : IImageAttributes) {

            var image = attr.imageSrc;
            if(attr.imageSrc == "") {
                image = "/images/uploads/img55de079d978dd.png";
            }
            var style = "background : url('http://devartisans.com" + image + "') center center no-repeat";
            element.attr('style', style );
        }
    }

    angular.module('devArt').directive('imageDirective', ImageDirective.instance);
}
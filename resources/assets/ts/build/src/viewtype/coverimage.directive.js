var devArt;
(function (devArt) {
    var viewtype;
    (function (viewtype) {
        'use strict';
        var ImageDirective = (function () {
            function ImageDirective() {
                this.restrict = 'A';
            }
            ImageDirective.instance = function () {
                return new ImageDirective;
            };
            ImageDirective.prototype.link = function (scope, element, attr) {
                var image = attr.imageSrc;
                if (attr.imageSrc == "") {
                    image = "/images/uploads/img55de079d978dd.png";
                }
                var style = "background : url('http://devartisans.com" + image + "') center center no-repeat";
                element.attr('style', style);
            };
            return ImageDirective;
        })();
        angular.module('devArt').directive('imageDirective', ImageDirective.instance);
    })(viewtype = devArt.viewtype || (devArt.viewtype = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=coverimage.directive.js.map
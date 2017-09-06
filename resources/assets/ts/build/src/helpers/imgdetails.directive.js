var devArt;
(function (devArt) {
    var helpers;
    (function (helpers) {
        'use strict';
        var ImageDetailsDirective = (function () {
            function ImageDetailsDirective() {
                this.restrict = 'A';
            }
            ImageDetailsDirective.instance = function () {
                return new ImageDetailsDirective;
            };
            ImageDetailsDirective.prototype.link = function (scope, element, attrs) {
                element.on('click', function () {
                    var $modal = $('#imagemodal'), $modalImage = $('#modalImage');
                    $modalImage.attr('src', element.data('name'));
                    $modalImage.attr('alt', element.attr('alt'));
                    $modal.modal('show');
                });
            };
            return ImageDetailsDirective;
        })();
        angular.module('devArt').directive('imgDetailsDirective', ImageDetailsDirective.instance);
    })(helpers = devArt.helpers || (devArt.helpers = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=imgdetails.directive.js.map
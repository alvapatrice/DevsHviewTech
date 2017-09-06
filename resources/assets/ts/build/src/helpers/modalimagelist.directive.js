var devArt;
(function (devArt) {
    var helpers;
    (function (helpers) {
        'use strict';
        var ModalImageListDirective = (function () {
            function ModalImageListDirective() {
                this.restrict = 'A';
            }
            ModalImageListDirective.instance = function () {
                return new ModalImageListDirective;
            };
            ModalImageListDirective.prototype.link = function (scope, element, attrs) {
                element.on('click', 'img', function () {
                    $('#imageurlpath').val(element.attr('src'));
                });
            };
            return ModalImageListDirective;
        })();
        angular.module('devArt').directive('modalImagelistDirective', ModalImageListDirective.instance);
    })(helpers = devArt.helpers || (devArt.helpers = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=modalimagelist.directive.js.map
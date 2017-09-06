var devArt;
(function (devArt) {
    var helpers;
    (function (helpers) {
        'use strict';
        var ImageSelectDirective = (function () {
            function ImageSelectDirective() {
                this.restrict = 'A';
            }
            ImageSelectDirective.instance = function () {
                return new ImageSelectDirective;
            };
            ImageSelectDirective.prototype.link = function (scope, element, attrs) {
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
            };
            return ImageSelectDirective;
        })();
        angular.module('devArt').directive('imageSelectDirective', ImageSelectDirective.instance);
    })(helpers = devArt.helpers || (devArt.helpers = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=imageselect.directive.js.map
var devArt;
(function (devArt) {
    var helpers;
    (function (helpers) {
        'use strict';
        var BodyImageDirective = (function () {
            function BodyImageDirective() {
                this.restrict = 'A';
            }
            BodyImageDirective.instance = function () {
                return new BodyImageDirective;
            };
            BodyImageDirective.prototype.link = function (scope, element, attrs) {
                console.log('hello');
                var hidable_image = element.find('.hidable_image'), btnObj = {
                    'class': 'btn btn-default image_demo_toggle',
                    'text': 'Toggle Image'
                }, btn = $('<button></button>', btnObj);
                btn.insertBefore(hidable_image);
                btn.on('click', function () {
                    $('.hidable_image').toggle();
                });
                element.find('p > img').each(function (index, val) {
                    var ancher = $('<a></a>', {
                        'href': $(val).attr('src'),
                        'data-lighter': ''
                    });
                    $(val).wrap(ancher);
                });
            };
            return BodyImageDirective;
        })();
        angular.module('devArt').directive('bodyImageDirective', BodyImageDirective.instance);
    })(helpers = devArt.helpers || (devArt.helpers = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=bodyimage.directive.js.map
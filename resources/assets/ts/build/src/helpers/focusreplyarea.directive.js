var devArt;
(function (devArt) {
    var helpers;
    (function (helpers) {
        'use strict';
        var FocusReplyTextAreaDirective = (function () {
            function FocusReplyTextAreaDirective() {
                this.restrict = 'A';
            }
            FocusReplyTextAreaDirective.instance = function () {
                return new FocusReplyTextAreaDirective;
            };
            FocusReplyTextAreaDirective.prototype.link = function (scope, element, attr) {
                element.on('click', function () {
                    $('html, body').animate({
                        scrollTop: $(".cke_contents").offset().top - 200
                    }, 500);
                });
            };
            return FocusReplyTextAreaDirective;
        })();
        angular.module('devArt').directive('focusReplyareaDirective', FocusReplyTextAreaDirective.instance);
    })(helpers = devArt.helpers || (devArt.helpers = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=focusreplyarea.directive.js.map
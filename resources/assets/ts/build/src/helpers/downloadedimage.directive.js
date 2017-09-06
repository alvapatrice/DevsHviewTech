var devArt;
(function (devArt) {
    var helpers;
    (function (helpers) {
        'use strict';
        var DownloadedImageDirective = (function () {
            function DownloadedImageDirective() {
                this.restrict = 'A';
            }
            DownloadedImageDirective.instance = function () {
                return new DownloadedImageDirective;
            };
            DownloadedImageDirective.prototype.link = function (scope, element, attr) {
                element.on('click', function (e) {
                    e.preventDefault();
                    var $this = element, $details_img = $('#image_details #image_details_img'), $image_name_input = $('#image_details #image_name'), $thumb_name_input = $('#image_details #thumb_name'), $image_name_hidden_input = $('#image_details #image_name_original'), $thumb_name_hidden_input = $('#image_details #thumb_name_original'), $modal = $('#imagemodal'), $modalImage = $('#modalImage');
                    $modalImage.attr('src', $this.find('img').data('name'));
                    $modalImage.attr('alt', $this.find('img').attr('alt'));
                    //$modal.modal('show');
                    $details_img.attr('src', $this.find('img').data('name'));
                    $details_img.attr('alt', $this.find('img').data('alt'));
                    $image_name_input.val($this.find('img').data('name'));
                    $image_name_hidden_input.val($this.find('img').data('name'));
                    $thumb_name_input.val($this.find('img').attr('src'));
                    $thumb_name_hidden_input.val($this.find('img').attr('src'));
                });
            };
            return DownloadedImageDirective;
        })();
        angular.module('devArt').directive('downloadedImageDirective', DownloadedImageDirective.instance);
    })(helpers = devArt.helpers || (devArt.helpers = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=downloadedimage.directive.js.map
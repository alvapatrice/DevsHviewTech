module devArt.helpers {
    'use strict';

    class DownloadedImageDirective implements ng.IDirective {

        static instance() : ng.IDirective {
            return new DownloadedImageDirective;
        }

        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes) {


            element.on('click', function (e : JQueryEventObject) {

                e.preventDefault();
                var $this = element,
                    $details_img = $('#image_details #image_details_img'),
                    $image_name_input = $('#image_details #image_name'),
                    $thumb_name_input = $('#image_details #thumb_name'),
                    $image_name_hidden_input = $('#image_details #image_name_original'),
                    $thumb_name_hidden_input = $('#image_details #thumb_name_original'),
                    $modal = $('#imagemodal'),
                    $modalImage = $('#modalImage');

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
        }
    }

    angular.module('devArt').directive('downloadedImageDirective', DownloadedImageDirective.instance);
}
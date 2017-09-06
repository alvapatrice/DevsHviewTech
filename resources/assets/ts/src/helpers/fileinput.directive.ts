module devArt.helpers {
    'use strict';

    class FileInputDirective implements ng.IDirective {
        static instance () : ng.IDirective {
            return new FileInputDirective;
        }

        restrict = 'A';
        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes) {

            element.on('change', function (event) {

                var $this : any = element,
                    fileList : any = $this[0].files,
                    filesLen : number = fileList.length,
                    $el = $('#filesInfo');

                for (var x = 0; x < filesLen; x++) {
                    var $lis = $('<li></li>', {
                        'class': 'list-group-item',
                        'text': fileList[x].name + " -- " + Math.floor(fileList[x].size / 1024) + ' KB'
                    });
                    $lis.appendTo($el);
                }
            });
        }
    }

    angular.module('devArt').directive('fileInputDirective', FileInputDirective.instance);
}
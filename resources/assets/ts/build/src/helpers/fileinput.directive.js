var devArt;
(function (devArt) {
    var helpers;
    (function (helpers) {
        'use strict';
        var FileInputDirective = (function () {
            function FileInputDirective() {
                this.restrict = 'A';
            }
            FileInputDirective.instance = function () {
                return new FileInputDirective;
            };
            FileInputDirective.prototype.link = function (scope, element, attr) {
                element.on('change', function (event) {
                    var $this = element, fileList = $this[0].files, filesLen = fileList.length, $el = $('#filesInfo');
                    for (var x = 0; x < filesLen; x++) {
                        var $lis = $('<li></li>', {
                            'class': 'list-group-item',
                            'text': fileList[x].name + " -- " + Math.floor(fileList[x].size / 1024) + ' KB'
                        });
                        $lis.appendTo($el);
                    }
                });
            };
            return FileInputDirective;
        })();
        angular.module('devArt').directive('fileInputDirective', FileInputDirective.instance);
    })(helpers = devArt.helpers || (devArt.helpers = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=fileinput.directive.js.map
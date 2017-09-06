var devArt;
(function (devArt) {
    var viewtype;
    (function (viewtype) {
        'use strict';
        var ViewDirectiveController = (function () {
            function ViewDirectiveController(viewTypeService) {
                this.viewTypeService = viewTypeService;
            }
            ViewDirectiveController.prototype.getViewType = function () {
                return this.viewTypeService.view;
            };
            ViewDirectiveController.$inject = ['viewTypeService'];
            return ViewDirectiveController;
        })();
        var ViewDirective = (function () {
            function ViewDirective() {
                this.restrict = 'AE';
                this.controller = ViewDirectiveController;
            }
            ViewDirective.instance = function () {
                return new ViewDirective;
            };
            ViewDirective.prototype.link = function (scope, element, attr, controller) {
                var element = element.find('.articleContainer'), article = element.find('div.article'), parent = element.closest('div.body-width');
                element.hover(function () {
                    $(this).find('.article-header').addClass('dark-blue');
                }, function () {
                    $(this).find('.article-header').removeClass('dark-blue');
                });
                scope.$watch(function () {
                    return controller.getViewType();
                }, function (newVal, oldVal) {
                    if (newVal == 'list') {
                        article.addClass('article-list').removeClass('article-grid');
                        element.addClass('col-lg-10 col-lg-offset-1').removeClass('col-lg-3');
                        parent.addClass('container').removeClass('container-fluid body-width');
                    }
                    else {
                        article.addClass('article-grid').removeClass('article-list');
                        element.addClass('col-lg-3').removeClass('col-lg-10 col-lg-offset-1');
                        parent.removeClass('container ').addClass('container-fluid body-width');
                    }
                });
            };
            return ViewDirective;
        })();
        angular.module('devArt').directive('viewDirective', ViewDirective.instance);
    })(viewtype = devArt.viewtype || (devArt.viewtype = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=viewtype.directive.js.map
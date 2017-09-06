var devArt;
(function (devArt) {
    var pagination;
    (function (pagination_1) {
        'use strict';
        var PaginationDirective = (function () {
            function PaginationDirective() {
                this.restrict = 'EA';
                this.controller = pagination_1.PaginationController;
            }
            PaginationDirective.instance = function () {
                return new PaginationDirective;
            };
            PaginationDirective.prototype.link = function (scope, element, attrs, controller) {
                $(document).on('click', 'ul.pagination li a', function (event) {
                    event.preventDefault();
                    var articles = $(document).find('.articleContainer').not('.adsContainer'), ads = $(document).find('.adsContainer'), pagination = $(document).find('#article-pagination');
                    controller.
                        getPaginationView($(this).attr('href'))
                        .then(function (response) {
                        articles.remove();
                        response.articles.each(function (index, val) {
                            if (index < 2) {
                                $(val).insertBefore(ads[0]);
                            }
                            if (index >= 2 && index < 8) {
                                $(val).insertAfter(ads[0]);
                            }
                            if (index >= 8) {
                                $(val).insertAfter(ads[1]);
                            }
                        });
                        pagination.replaceWith(response.pagination);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    });
                });
            };
            return PaginationDirective;
        })();
        angular.module('devArt').directive('articlePaginator', PaginationDirective.instance);
    })(pagination = devArt.pagination || (devArt.pagination = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=pagination.directive.js.map
module devArt.pagination {
    'use strict';

    class PaginationDirective {

        static instance():ng.IDirective {
            return new PaginationDirective;
        }

        restrict = 'EA';
        controller = PaginationController;

        link(scope:ng.IScope, element:ng.IAugmentedJQuery, attrs:ng.IAttributes, controller:PaginationController) {

            $(document).on('click', 'ul.pagination li a', function (event:JQueryEventObject) {
                event.preventDefault();

                var articles = $(document).find('.articleContainer').not('.adsContainer'),
                    ads = $(document).find('.adsContainer'),
                    pagination = $(document).find('#article-pagination');

                controller.
                    getPaginationView($(this).attr('href'))
                    .then((response:IPaginationResult) => {

                        articles.remove();
                        response.articles.each((index, val) => {
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
                        $("html, body").animate({scrollTop: 0}, "slow");
                    });

            })
        }
    }

    angular.module('devArt').directive('articlePaginator', PaginationDirective.instance);
}
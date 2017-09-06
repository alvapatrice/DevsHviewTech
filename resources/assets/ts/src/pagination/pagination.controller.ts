module devArt.pagination {
    'use strict';
    export interface IPaginationResult {
        articles : JQuery;
        pagination : JQuery;
    }
    export class PaginationController {
        static $inject = ['paginationService', '$compile', '$scope'];

        paginationService : IPaginationService;
        $compile : ng.ICompileService;
        $scope : ng.IScope;
        constructor(paginationService : IPaginationService, $compile : ng.ICompileService, $scope : ng.IScope  ) {
            this.paginationService = paginationService;
            this.$compile = $compile;
            this.$scope = $scope;
        }

        getPaginationView(href : string) : ng.IPromise<IPaginationResult> {
                return this.paginationService
                    .getPaginationResults(href)
                    .then((response : HTMLElement) : IPaginationResult => {
                        var $articles = $(response).find('#article-view-wrapper .articleContainer').not('.adsContainer'),
                            $pagination = $(response).find('#article-pagination'),
                            paginationResult : IPaginationResult = {
                                            articles : this.$compile($articles)(this.$scope),
                                            //pagination : this.$compile($pagination)(this.$scope)
                                            pagination : $pagination
                            };
                            return paginationResult;

                    });


        }

    }
}
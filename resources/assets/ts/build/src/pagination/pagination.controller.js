var devArt;
(function (devArt) {
    var pagination;
    (function (pagination) {
        'use strict';
        var PaginationController = (function () {
            function PaginationController(paginationService, $compile, $scope) {
                this.paginationService = paginationService;
                this.$compile = $compile;
                this.$scope = $scope;
            }
            PaginationController.prototype.getPaginationView = function (href) {
                var _this = this;
                return this.paginationService
                    .getPaginationResults(href)
                    .then(function (response) {
                    var $articles = $(response).find('#article-view-wrapper .articleContainer').not('.adsContainer'), $pagination = $(response).find('#article-pagination'), paginationResult = {
                        articles: _this.$compile($articles)(_this.$scope),
                        //pagination : this.$compile($pagination)(this.$scope)
                        pagination: $pagination
                    };
                    return paginationResult;
                });
            };
            PaginationController.$inject = ['paginationService', '$compile', '$scope'];
            return PaginationController;
        })();
        pagination.PaginationController = PaginationController;
    })(pagination = devArt.pagination || (devArt.pagination = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=pagination.controller.js.map
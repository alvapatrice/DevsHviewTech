var devArt;
(function (devArt) {
    var pagination;
    (function (pagination) {
        'use strict';
        var PaginationService = (function () {
            function PaginationService($http) {
                this.$http = $http;
            }
            PaginationService.prototype.getPaginationResults = function (href) {
                return this.$http
                    .get(href)
                    .then(function (response) {
                    return response.data;
                });
            };
            PaginationService.$inject = ['$http'];
            return PaginationService;
        })();
        pagination.PaginationService = PaginationService;
        angular.module('devArt').service('paginationService', PaginationService);
    })(pagination = devArt.pagination || (devArt.pagination = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=pagination.service.js.map
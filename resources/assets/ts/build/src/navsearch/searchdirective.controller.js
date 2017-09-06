var devArt;
(function (devArt) {
    var navsearch;
    (function (navsearch) {
        'use strict';
        var SearchDirectiveController = (function () {
            function SearchDirectiveController($http, searchService) {
                this.$http = $http;
                this.searchService = searchService;
            }
            SearchDirectiveController.prototype.getSearchResults = function (newVal) {
                var _this = this;
                var promise = this.$http.get('/api/search/' + newVal);
                promise.success(function (data) {
                    _this.searchService.results = data;
                });
                return promise;
            };
            SearchDirectiveController.$inject = ['$http', 'searchService'];
            return SearchDirectiveController;
        })();
        navsearch.SearchDirectiveController = SearchDirectiveController;
    })(navsearch = devArt.navsearch || (devArt.navsearch = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=searchdirective.controller.js.map
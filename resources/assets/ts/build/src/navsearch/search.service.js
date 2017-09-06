var devArt;
(function (devArt) {
    var navsearch;
    (function (navsearch) {
        'use strict';
        var SearchService = (function () {
            function SearchService() {
                this.results = [];
                this.selectedElement = [];
            }
            return SearchService;
        })();
        navsearch.SearchService = SearchService;
        angular.module('devArt').service('searchService', SearchService);
    })(navsearch = devArt.navsearch || (devArt.navsearch = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=search.service.js.map
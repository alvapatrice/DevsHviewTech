var devArt;
(function (devArt) {
    var navsearch;
    (function (navsearch) {
        'use strict';
        var SearchDirective = (function () {
            function SearchDirective() {
                this.restrict = 'AE';
                this.controller = navsearch.SearchDirectiveController;
            }
            SearchDirective.instance = function () {
                return new SearchDirective;
            };
            SearchDirective.prototype.link = function (scope, element, attr, controller) {
                scope.$watch(attr.searchTerm, function (newVal, oldVal) {
                    if (scope.specialKeys) {
                        return;
                    }
                    if (newVal !== "" && newVal !== oldVal) {
                        controller.getSearchResults(newVal).then(function (results) {
                            scope.results = results.data;
                        });
                    }
                });
            };
            return SearchDirective;
        })();
        angular.module('devArt').directive('searchDirective', SearchDirective.instance);
    })(navsearch = devArt.navsearch || (devArt.navsearch = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=search.directive.js.map
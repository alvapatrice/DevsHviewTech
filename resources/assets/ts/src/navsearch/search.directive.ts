module devArt.navsearch {
    'use strict';

    interface ISearchAttributes extends ng.IAttributes {
        searchTerm : string;
    }

    class SearchDirective implements ng.IDirective {

        static instance() : ng.IDirective {
            return new SearchDirective;
        }
        restrict = 'AE';
        controller  = SearchDirectiveController;

        link(scope : ISearchScope, element: ng.IAugmentedJQuery, attr : ISearchAttributes, controller : ISearchDirectiveController) {
            scope.$watch(attr.searchTerm, function(newVal : string, oldVal : string) {
                if(scope.specialKeys)
                {
                    return;
                }
                if(newVal !== "" && newVal !== oldVal) {
                    controller.getSearchResults(newVal).then(function(results) {
                        scope.results = results.data;
                    });
                }
            })
        }
    }

    angular.module('devArt').directive('searchDirective', SearchDirective.instance);
}

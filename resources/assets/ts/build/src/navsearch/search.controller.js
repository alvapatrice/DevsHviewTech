var devArt;
(function (devArt) {
    var navsearch;
    (function (navsearch) {
        'use strict';
        var SearchController = (function () {
            function SearchController($scope, $http, searchService) {
                var vm = this;
                vm.$scope = $scope;
                vm.$http = $http;
                vm.searchService = searchService;
                vm.$scope.searchInput = '';
                vm.$scope.results = [];
                vm.$scope.selectedElement = false;
                vm.$scope.specialKeys = false;
                vm.$scope.showResults = false;
                vm.$scope.index = -1;
                vm.$scope.container = $('.searchResults');
                vm.$scope.inputBox = $('#searchInputBox');
                vm.hideResults(vm);
                vm.$scope.nevigateToArticle = function () {
                    vm.navigateToArticle();
                };
                vm.$scope.keyPressed = function (event) {
                    vm.keyPressed(event, vm);
                };
            }
            SearchController.prototype.hideResults = function (vm) {
                $(document).on('click', function (e) {
                    vm.$scope.$apply(function () {
                        if (!vm.$scope.container.is(e.target) // if the target of the click isn't the container...
                            && vm.$scope.container.has(e.target).length === 0 // ... nor a descendant of the container
                            && !vm.$scope.inputBox.is(e.target)) {
                            vm.$scope.showResults = false;
                            vm.$scope.results = [];
                        }
                    });
                });
            };
            SearchController.prototype.navigateToArticle = function () {
                window.location = this.searchService.selectedElement.attr('href');
            };
            SearchController.prototype.showResultsFunc = function () {
                return this.$scope.showResults;
            };
            SearchController.prototype.keyPressed = function (event, vm) {
                vm.$scope.specialKeys = false;
                if (vm.$scope.searchInput.length < 2) {
                    vm.$scope.results = [];
                    vm.$scope.showResults = false;
                    vm.searchService.results = [];
                    vm.searchService.selectedElement = [];
                    return;
                }
                vm.$scope.showResults = true;
                vm.$scope.setSelectedElement = function () {
                    vm.searchService.selectedElement = $('.searchResults').find('a').filter(function (index, val) {
                        return $(val).text() == vm.$scope.searchInput;
                    });
                    vm.$scope.selectedElement = vm.searchService.selectedElement.text();
                };
                if (event.keyCode == 40) {
                    vm.$scope.specialKeys = true;
                    //select next result
                    if (typeof vm.searchService.results[vm.$scope.index + 1] != "undefined") {
                        vm.$scope.searchInput = vm.searchService.results[vm.$scope.index + 1].title;
                        vm.$scope.setSelectedElement();
                        console.log(vm.searchService.results[vm.$scope.index + 1].title);
                        vm.$scope.index = vm.$scope.index + 1;
                    }
                    return;
                }
                if (event.keyCode == 38) {
                    vm.$scope.specialKeys = true;
                    //select next result
                    if (typeof vm.searchService.results[vm.$scope.index - 1] != "undefined") {
                        vm.$scope.searchInput = vm.searchService.results[vm.$scope.index - 1].title;
                        console.log(vm.searchService.results[vm.$scope.index - 1].title);
                        if (vm.$scope.index > 0) {
                            vm.$scope.index = vm.$scope.index - 1;
                        }
                        vm.$scope.setSelectedElement();
                    }
                    return;
                }
                if (event.keyCode == 13) {
                    vm.$scope.nevigateToArticle();
                }
            };
            SearchController.$inject = ['$scope', '$http', 'searchService'];
            return SearchController;
        })();
        angular.module('devArt').controller('SearchController', SearchController);
    })(navsearch = devArt.navsearch || (devArt.navsearch = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=search.controller.js.map
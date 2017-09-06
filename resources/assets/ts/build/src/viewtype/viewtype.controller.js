var devArt;
(function (devArt) {
    var viewtype;
    (function (viewtype) {
        var ViewTypeController = (function () {
            function ViewTypeController($scope, viewTypeService, $cookieStore) {
                this.$scope = $scope;
                this.viewTypeService = viewTypeService;
                this.$cookieStore = $cookieStore;
                this.viewTypeService = viewTypeService;
            }
            ViewTypeController.prototype.changeView = function (setView) {
                this.viewTypeService.view = setView;
                this.$cookieStore.put('viewType', setView);
            };
            ViewTypeController.prototype.isSelected = function (checkView) {
                return this.viewTypeService.view === checkView;
            };
            ViewTypeController.$inject = ['$scope', 'viewTypeService', '$cookieStore'];
            return ViewTypeController;
        })();
        angular.module('devArt').controller('ViewTypeController', ViewTypeController);
    })(viewtype = devArt.viewtype || (devArt.viewtype = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=viewtype.controller.js.map
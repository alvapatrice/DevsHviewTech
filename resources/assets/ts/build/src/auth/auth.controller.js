var devArt;
(function (devArt) {
    var auth;
    (function (auth) {
        var AuthController = (function () {
            function AuthController($scope) {
                var vm = this;
                vm.$scope = $scope;
                vm.$scope.promptAuthDialog = function (event) {
                    event.preventDefault();
                    vm.promptAuthDialog(event, vm);
                };
            }
            AuthController.prototype.promptAuthDialog = function (event, vm) {
                var loginModal = $('#loginModal');
                loginModal.modal('show');
            };
            AuthController.$inject = ['$scope'];
            return AuthController;
        })();
        angular.module('devArt').controller('AuthController', AuthController);
    })(auth = devArt.auth || (devArt.auth = {}));
})(devArt || (devArt = {}));
//
//angular.module('devArt').controller('AuthController', ['$scope', function($scope) {
//    $scope.promptAuthDialog = function(event) {
//        event.preventDefault();
//        var loginModal : any = $('#loginModal');
//        loginModal.modal('show');
//    };
//
//
//}]); 
//# sourceMappingURL=auth.controller.js.map
module devArt.auth {
    import IAngularEvent = angular.IAngularEvent;

    interface IJqueryModal extends ng.IAugmentedJQuery {
        modal(val : string) : void;
    }

    interface IAuthScope extends ng.IScope {
        promptAuthDialog(event : ng.IAngularEvent) : void;
    }

    class AuthController {
        static $inject = ['$scope'];

        private $scope : IAuthScope;

        constructor($scope : IAuthScope) {
            var vm = this;
            vm.$scope = $scope;
            vm.$scope.promptAuthDialog = function(event : IAngularEvent) {
                event.preventDefault();
                vm.promptAuthDialog(event, vm);
            }
        }

        promptAuthDialog(event, vm) {
            var loginModal : IJqueryModal = <IJqueryModal>$('#loginModal');
            loginModal.modal('show');
        }


    }
    angular.module('devArt').controller('AuthController', AuthController);
}



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